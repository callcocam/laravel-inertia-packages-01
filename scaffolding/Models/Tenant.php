<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Models;

use Call\Models\Tenant as TenantAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends TenantAlias
{
    use HasFactory;

    protected $keyType = "string";

    public $incrementing = false;

    public function columns()
    {
       return [];
    }
}
