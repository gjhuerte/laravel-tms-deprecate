<?php

namespace App\Http\Managers;

use Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Packages\Object\ObjectParser;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\MaintenanceRequest\MaintenanceStoreRequest;

class Maintenance extends BaseController
{
    protected $class;
    protected $variable = [];
    protected $validatorClass;
    protected $useDefaultFunction = true;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->variable = ObjectParser::make($this->variable);
        $this->init();
    }

    /**
     * Default init function for the class. No functionality
     * on the parent class
     *
     * @return void
     */
    private function init() { }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columns = $this->class->columns;
        $variable = $this->variable;
            
        if($request->ajax()) {
            return datatables($this->class->get())->toJson();
        }

        return view($variable->viewBasePath . 'bread.index', compact('columns', 'variable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variable = $this->variable;
        return view($variable->viewBasePath . 'bread.create', compact('columns', 'variable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceStoreRequest $request)
    {      
        $this->dispatch(new CreateMaintenance($request, $this->class));
        return redirect($this->variable->baseUrl)->with('notification', [
            'title' => __('Success'),
            'message' => __('tasks.success'),
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
            return view($this->variable->viewBasePath . 'bread.show')
                    ->with('model', $this->class->findOrFail($id))
                    ->with('variable', $this->variable);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view($this->variable->viewBasePath . 'bread.edit')
                ->with('model', $this->findOrFail($id))
                ->with('variable', $this->variable);
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
        $this->class->findOrFail($id);
        $validator = Validator::make((array)$variable->fields, $this->class->updateRules());

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        foreach($this->class->columns as $key => $args) {
            $args = ObjectParser::make($args);

            if($args->update) {
                $column = $variable->fields->$key;
                $this->class->$key = setColumnValue($args, $column);
            }
        }

        $this->class->save();

        return redirect($variable->baseUrl)->with('notification', [
            'title' => 'Success!',
            'message' => 'Item successfully updated',
            'type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceDestroyRequest $request, $id)
    {
        if(isset($this->variable->isRemovable) && $this->variable->isRemovable == false) {
            return redirect($this->variable->baseUrl);
        }

        $this->class->findOrFail($id)->delete();
        return redirect( $this->path['base'] )->with('notification', [
            'title' => 'Success!',
            'message' => 'Item successfully removed',
            'type' => 'success'
        ]);
    }
}
