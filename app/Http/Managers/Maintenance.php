<?php

namespace App\Http\Managers;

use \Validator;
use \Illuminate\Http\Request;

class Maintenance extends \App\Http\Controllers\Controller
{
    protected $fields = [];
    protected $class;
    protected $validatorClass;
    protected $redirectFailsUrl = '';
    protected $path = [
        'create' => '/create',
        'edit' => '/edit',
        'update' => 'update',
        'delete' => '',
        'base' => '',
        'view' => 'admin.maintenance.',
        'forms' => [
            'create',
            'save',
            'edit',
        ],
        'errors' => [
            'fails'=> '',
        ],
    ];

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

        return view( $this->path['view'] . 'bread.index')
                ->with('columns', $this->class->columns )
                ->with('data', $this->class->get() )
                ->with('path', $this->path );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( $this->path['view'] . 'bread.create')
                ->with('fields', $this->fields )
                ->with('path', $this->path );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [];

        foreach( $this->fields as $key => $args ) {
            if( isset( $args['value']) ) {
                $fields[ $key ] = $args['value']; 
            }
        }

        $validator = Validator::make( $fields, $this->class->insertRules() );

        if( $validator->fails() ) {
            return back()->withInput()->withErrors( $validator );
        }

        foreach( $this->class->columns as $key => $value ) {
            if( $value['save'] ) {
                $this->class->$key = $this->fields[ $key ]['value'];
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
        return redirect( $this->path['base'] );
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
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {
            return redirect( $this->redirectFailsUrl );
        }

        return view( $this->path['view'] . 'bread.show')
                ->with( 'data', $data);
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
        $validator = Validator::make([ 'id' => $id ], $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {
            return redirect( $this->redirectFailsUrl );
        }

        return view( $this->path['view'] . 'bread.edit')
                ->with( 'datum', $this->class->where('id', '=', $id )->first() )
                ->with('fields', $this->fields )
                ->with('path', $this->path );
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
        $fields = [];

        foreach( $this->fields as $key => $args ) {
            if( isset( $args['value']) ) {
                $fields[ $key ] = $args['value']; 
            }
        }

        $validator = Validator::make( $fields, $this->class->updateRules() );

        if( $validator->fails() ) {
            return back()->withInput()->withErrors( $validator );
        }

        $this->class = $this->class->where('id', '=', $id )->first();

        foreach( $this->class->columns as $key => $value ) {
            if( $value['update'] ) {
                $this->class->$key = $this->fields[ $key ]['value'];
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

        return redirect( $this->path['base'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = filter_var( $id, FILTER_VALIDATE_INT);
        $validator = Validator::make( $this->fields, $this->class->checkIfIdExistsRules() );

        if( $validator->fails() ) {

            if( $request->ajax() ) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                    'message' => 'Error occured while processing your request',
                    'title' => 'Error!',
                ], 500);
            }

            return back()->withInput()->withErrors( $validator );
        }

        $this->class->where( 'id', '=', $id )->first();
        $this->class->delete();

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
