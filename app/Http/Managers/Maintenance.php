<?php

namespace App\Http\Managers;

use \Validator;
use \Illuminate\Http\Request;
use App\Http\Packages\Object\ObjectParser;

class Maintenance extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        if( $request->ajax() ) {
            return datatables( $this->class->get() )->toJson();
        }

        $variable = ObjectParser::make($this->variable);
        return view( $variable->viewBasePath . 'bread.index')
                ->with('columns', $this->class->columns)
                ->with('variable', $variable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variable = ObjectParser::make($this->variable);
        return view($variable->viewBasePath . 'bread.create')
                ->with('variable', $variable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $variable = ObjectParser::make($this->variable);
        $validator = Validator::make((array)$variable->fields, $this->class->insertRules());

        if( $validator->fails() ) {
            return back()->withInput()->withErrors($validator);
        }

        foreach( $this->class->columns as $key => $value ) {
            if( $variable->columns->$key->isInsertable ) {
                $this->class->$key = $variable->fields->$key;
            }
        }

        $this->class->save();

        if( $request->ajax() ) {
            return response()->json([
                'status' => 'ok',
                'errors' => [],
                'title' => 'Success!',
                'message' => 'Item successfully created',
            ], 200);
        }

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Item successfully created',
            'type' => 'success'
        ]);

        return redirect($variable->baseUrl);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    { 
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $variable = ObjectParser::make($this->variable);
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {
            return redirect( $variable->redirectFailsUrl );
        }

        return view($variable->viewBasePath . 'bread.show')
                ->with('variable', $variable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $variable = ObjectParser::make($this->variable);
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {
            return redirect( $variable->redirectFailsUrl );
        }

        return view( $variable->viewBasePath . 'bread.edit')
                ->with('model', $this->class->where('id', '=', $id )->first())
                ->with('variable', $variable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $variable = ObjectParser::make($this->variable);
        $validator = Validator::make((array)$variable->fields, $this->class->updateRules());

        if( $validator->fails() ) {
            return back()->withInput()->withErrors($validator);
        }

        $this->class = $this->class->where('id', '=', $id )->first();
        foreach( $this->class->columns as $key => $value ) {
            if( $variable->columns->$key->isEditable ) {
                $this->class->$key = $variable->fields->$key;
            }
        }

        $this->class->save();

        if( $request->ajax() ) {
            return response()->json([
                'status' => 'ok',
                'errors' => [],
                'title' => 'Success!',
                'message' => 'Item successfully updated',
            ], 200);
        }

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Item successfully updated',
            'type' => 'success'
        ]);

        return redirect($variable->baseUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $validator = Validator::make([
            'id' => $id
        ], $this->class->checkIfIdExistsRules());

        if( $validator->fails() ) {

            if( $request->ajax() ) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                    'message' => 'Error occured while processing your request',
                    'title' => 'Error!',
                ], 500);
            }

            return back()->withInput()->withErrors($validator);
        }

        $class = $this->class->where('id', '=', $id)->first();
        $class->delete();

        if( $request->ajax() ) {
            return response()->json([
                'status' => 'ok',
                'errors' => [],
                'title' => 'Success!',
                'message' => 'Item successfully removed',
            ], 200);
        }

        session()->flash('notification', [
            'title' => 'Success!',
            'message' => 'Item successfully removed',
            'type' => 'success'
        ]);

        return redirect( $this->path['base'] );
    }
}
