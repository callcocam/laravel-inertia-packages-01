<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait EditRecord {

    public function edit(Builder $builder, $request, $id){

        $this->model = $builder->where($builder->getModel()->getKeyName(), $id)->first();
        $form = [];
        $columns = [];
        $data = $this->model->toArray();
        foreach ($this->columns() as $col) {
            if(!Arr::get($col->hidden,'edit')){
                $col->model($this->model);
                $columns[$col->name] = $col->toArray();
                if($col->value){
                    $form[$col->name] = $col->value;
                }
                else{
                    if(isset($data[$col->name])){
                        $form[$col->name] = $data[$col->name];
                    }
                    else{
                        $form[$col->name] = $col->default;
                    }
                }
            }
        }
        $this->getEditOptionsAttributes($this->model);

        return [
            'options'=>$this->options,
            'column'=>$columns,
            'form'=>$form,
        ];
    }


    /**
     * @return $this
     */
    protected function getEditOptionsAttributes($model){

        $this->options = [
            'redirect_url'          => $this->refresh($model),
            'create_url'            => $this->create_url($model),
            'store_url'             => $this->store_url($model),
            'update_url'            => $this->update_url($model),
            'show_url'              => $this->show_url($model),
            'show_route_name'       => $this->show_route_name($model),
            'create_route_name'     => $this->create_route_name($model),
            'update_route_name'     => $this->update_route_name($model),
        ];

        return $this;
    }

}
