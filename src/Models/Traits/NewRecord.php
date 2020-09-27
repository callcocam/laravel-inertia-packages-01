<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait NewRecord {

    public function newRecord(Builder $builder, $request){

        $results = null;

        $this->getAttrByAttribute($results);

        return $this->data;
    }
}
