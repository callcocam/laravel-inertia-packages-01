<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Http\Controllers\Traits;


trait ControllerHelper
{
    protected $results = [
        'actions'=>[],
        'columns'=>[],
        'data'=>[],
        'errors'=>[],
        'options'=>[],
        'source'=>[],
    ];
    protected $list = "List";
    protected $show = "Show";
    protected $edit = "Edit";
    protected $create = "Create";
    protected $destroy = "Destroy";

    public function name(){
        if($this->model)
           return class_basename($this->model);
        return  null;
    }

}
