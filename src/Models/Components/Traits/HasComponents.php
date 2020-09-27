<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits;


use Call\Models\Components\Link;

trait HasComponents
{
    /**
     * @var array
     */
    protected $components = [];


    public function actions($route){

        $this->components(
            [
                Link::make('Edit')->edit($route),
                Link::make('Show')->show($route),
                Link::make('Destroy')->destroy($route),
            ]
        )->hidden_edit();

        return $this;
    }
    /**
     * @param  array  $components
     * @param  bool  $hidden
     * @param  bool  $hiddenMessage
     *
     * @return $this
     */
    public function components(array $components = []): self
    {
        $this->type = "array_components";
        $this->components = $components;
        return $this;
    }

    /**
     * @param $component
     *
     * @return $this
     */
    public function addComponent($component): self
    {
        $this->components[] = $component;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasComponents(): bool
    {
        return count($this->components) > 0;
    }


    protected function component(&$component,$key, $value){

        $component[$key] = $value;

        return $component;
    }

    protected function attrs(&$attributes, $model){

        $attrs = $attributes;
        if($attrs){
            if(isset($attrs['href']) && is_callable($attributes['href'])){
                $attributes['href'] = app()->call($attributes['href'],compact('model'));
            }
        }
        return $attributes;
    }

    /**
     * @return array
     */
    public function getComponents(): array
    {
        $components = [];
        if($this->components):
            foreach ($this->components as $component):
                $components[]=$component->setComponent($component, $this->model);
            endforeach;
        endif;
        return $components;
    }
}
