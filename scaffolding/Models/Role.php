<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Models;

use Call\Models\Components\AbstractField;
use Call\Support\Acl\Models\AbstractRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends AbstractRole
{
    use HasFactory;

    protected $keyType = "string";

    public $incrementing = false;
    /**
     * @return AbstractField
     */
    public function columns()
    {
        return [];
    }
}
