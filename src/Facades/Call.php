<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Facades;

use Call\ResponseFactory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void setRootView($name)
 * @method static void share($key, $value = null)
 * @method static array getShared($key = null)
 * @method static void version($version)
 * @method static int|string getVersion()
 * @method static \Call\Response render($component, $props = [])
 *
 * @see \Call\ResponseFactory
 */
class Call extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ResponseFactory::class;
    }
}
