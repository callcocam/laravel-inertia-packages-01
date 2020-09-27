<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Support\Acl\Tactics;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Call\Support\Acl\Facades\Acl;

class RevokePermissionFrom
{
    /**
     * @var array
     */
    protected $permissions;

    /**
     * Create a new GivePermissionTo instance.
     *
     * @param  array  $permissions
     */
    public function __construct(...$permissions)
    {
        $this->permissions = Arr::flatten($permissions);
    }

    public function to($roleOrUser)
    {
        if ($roleOrUser instanceof Model) {
            $instance = $roleOrUser;
        } else {
            $instance = Acl::role()->where('slug', $roleOrUser)->firstOrFail();
        }

        $instance->revokePermissionTo($this->permissions);
    }
}
