<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Support\Acl;

use App\Models\Permission;
use App\Models\Role;
use Call\Support\Acl\Tactics\AssignRoleTo;
use Call\Support\Acl\Tactics\GivePermissionTo;
use Call\Support\Acl\Tactics\RevokePermissionFrom;

class Acl
{
    /**
     * Fetch an instance of the Role model.
     *
     * @return Role
     */
    public function role()
    {
        return app()->make(config('acl.models.role'));
    }

    /**
     * Fetch an instance of the Permission model.
     *
     * @return Permission
     */
    public function permission()
    {
        return app()->make(config('acl.models.permission'));
    }

    /**
     * Assign roles to a user.
     *
     * @param  string|array  $roles
     * @return \Call\Support\Acl\Tactics\AssignRoleTo
     */
    public function assign($roles): AssignRoleTo
    {
        return new AssignRoleTo($roles);
    }

    /**
     * Give permissions to a user or role
     *
     * @param  string|array  $permissions
     * @return \Call\Support\Acl\Tactics\GivePermissionTo
     */
    public function give($permissions): GivePermissionTo
    {
        return new GivePermissionTo($permissions);
    }

    /**
     * Revoke permissions from a user or role
     *
     * @param  string|array  $permissions
     * @return \Call\Support\Acl\Tactics\RevokePermissionFrom
     */
    public function revoke($permissions): RevokePermissionFrom
    {
        return new RevokePermissionFrom($permissions);
    }
}
