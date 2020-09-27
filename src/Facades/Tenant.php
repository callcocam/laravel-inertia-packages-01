<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Facades;

use Call\Tenant\TenantManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void hasTenantUser()
 * @method static void hasTenant()
 *
 * @see \Call\Tenant\TenantManager
 */
class Tenant extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TenantManager::class;
    }
}
