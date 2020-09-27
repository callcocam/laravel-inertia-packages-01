<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Scopes;

use Ramsey\Uuid\Uuid;

trait UuidGenerate
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->id = Uuid::uuid4();
        });
    }
}
