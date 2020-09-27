<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Models;

use Call\Models\Company as CompanyAlias;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends CompanyAlias
{
    use HasFactory;

    protected $keyType = "string";

    public $incrementing = false;
}
