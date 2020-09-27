<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ControllerHelper;
use Call\Facades\Call;
use Call\Facades\Tenant;
use Call\Tenant\TenantManager;
use Illuminate\Http\Request;

class AbstractController extends Controller
{

    use ControllerHelper;

    protected $tenant;

    protected $model;

    public function __construct()
    {
        $this->tenant = Tenant::hasTenant();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Call\Response
     */
    public function index(Request $request)
    {

        if($this->model){
            $this->results = $this->tenant->pivot($this->model)->component($request);
        }
        return Call::render($this->list,$this->results,'layouts.auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Call\Response
     */
    public function create(Request $request)
    {
        return Call::render($this->create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Call\Response
     */
    public function show(Request $request, $id)
    {
        return Call::render($this->show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Call\Response
     */
    public function edit(Request $request, $id)
    {
        if($this->model){
            $this->results = $this->tenant->pivot($this->model)->editRecord($request,$id);
        }

        return Call::render($this->edit,$this->results);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
