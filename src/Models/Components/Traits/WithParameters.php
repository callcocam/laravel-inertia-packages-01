<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits;


use Illuminate\Support\Str;

trait WithParameters
{


    public function endpoint($model){

        if($model)
            return $model->getTable();

        return $this->getTable();

    }

    public function refresh($model=null,$route=null){
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.index', $route))) {
            return route(sprintf("admin.%s.index", $route));
        }
        return null;
    }

    public function store_url($model=null,$route=null){
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.store', $route))) {
            return route(sprintf("admin.%s.store", $route));
        }
        return null;
    }

    public function show_url($model=null,$route=null){
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.show', $route))) {
            return route(sprintf("admin.%s.show", $route), $this->getUpdatesQueryParameters($model));
        }
        return null;
    }

    public function update_url($model=null,$route=null){
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.update', $route))) {
            return route(sprintf("admin.%s.update", $route), $this->getUpdatesQueryParameters($model));
        }
        return null;
    }

    public function create_url($model=null,$route=null){

        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.create', $route))) {
            return route(sprintf("admin.%s.create", $route), $this->getUpdatesQueryParametersClean());
        }
        return null;
    }

    /**
     * @param $route
     * @return array
     */
    public function edit_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.edit', $route))) {
            return [
                'name' => sprintf('admin.%s.edit', $route),
                'params' => $this->getUpdatesQueryParameters($model),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }

    /**
     * @param $route
     * @return array
     */
    public function show_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.show', $route))) {
            return [
                'name' => sprintf('admin.%s.show', $route),
                'params' => $this->getUpdatesQueryParameters($model),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }

    /**
     * @param $route
     * @return array
     */
    public function create_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.create', $route))) {
            return [
                'name' => sprintf('admin.%s.create', $route),
                'params' => $this->getUpdatesQueryParameters($model),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }

    /**
     * @param $route
     * @return array
     */
    public function store_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.store', $route))) {
            return [
                'name' => sprintf('admin.%s.store', $route),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }


    /**
     * @param $route
     * @return array
     */
    public function update_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.update', $route))) {
            return [
                'name' => sprintf('admin.%s.update', $route),
                'params' => $this->getUpdatesQueryParameters($model),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }


    /**
     * @param $route
     * @return array
     */
    public function destroy_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.destroy', $route))) {
            return [
                'name' => sprintf('admin.%s.destroy', $route),
                'params' => $this->getUpdatesQueryParameters($model),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }
    /**
     * @param $route
     * @return array
     */
    public function index_route_name($model=null,$route=null): array
    {
        if(!$route){
            $route = $this->endpoint($model);
        }
        if(has_permission_route_name(sprintf('admin.%s.index', $route))) {
            return [
                'name' => sprintf('admin.%s.index', $route),
                'query' => $this->getUpdatesQueryParametersClean(),
            ];
        }
        return [];
    }

    public function getUpdatesQueryParameters($model)
    {
        if(!$model)
            $model = $this;

        return [Str::slug(class_basename($model)) => $model->getKey()];


    }


    public function getUpdatesQueryParametersClean()
    {
        return $this->resolveQuery();
    }

    public function resolveQuery()
    {
        // The "page" query string item should only be available
        // from within the original component mount run.
        return request()->query();
    }

}
