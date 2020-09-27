<?php

if (!function_exists('_call')) {
    /**
     * Inertia helper.
     *
     * @param null|string $component
     * @param array       $props
     *
     * @return \Call\ResponseFactory|\Call\Response
     */
    function _call($component = null, $props = [])
    {
        $instance = \Call\Call::getFacadeRoot();

        if ($component) {
            return $instance->render($component, $props);
        }

        return $instance;
    }
}

if(!function_exists('has_route')){

    function has_route($route, $action="index", $path = "admin"){
        if(\Illuminate\Support\Facades\Route::has(sprintf('%s.%s.%s', $path, $route, $action)))
            return true;

        return false;
    }
}

if(!function_exists('has_permission')){

    function has_permission($permission, $action="index", $path = "admin", $user=null){
        if(!\Illuminate\Support\Facades\Route::has(sprintf('%s.%s.%s', $path, $permission, $action)))
            return false;
        if(!\Illuminate\Support\Facades\Gate::denies(sprintf('%s.%s.%s', $path, $permission, $action), $user))
            return true;
        return false;
    }
}

if(!function_exists('has_permission_route_name')){

    function has_permission_route_name($action,$user=null){
        if(!\Illuminate\Support\Facades\Route::has($action))
            return false;

        if(\Illuminate\Support\Facades\Gate::allows($action, $user))
            return true;
        return false;
    }
}

