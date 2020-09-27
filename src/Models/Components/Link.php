<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components;


use Call\Models\Components\Traits\WithParameters;
use Illuminate\Support\Str;

class Link extends AbstractField
{
    use WithParameters;
    /**
     * Link constructor.
     *
     * @param $text
     */
    public function __construct($text = false)
    {
        if ($text) {
            $this->text($text);
        }
        $this->pack("feather");
        $this->size("small");
        $this->class("mr-2");
        $this->label(null);
    }

    /**
     * @param $text
     *
     * @return self
     */
    public static function make($text): self
    {
        $column = new static($text);

        return $column;
    }

    /**
     * @param $href
     *
     * @return $this
     */
    public function href($href): self
    {
        return $this->setAttribute('href', $href);
    }

    /**
     * @param $model
     *
     * @return $this
     */
    public function destroy($route): self
    {
        if(has_permission_route_name(sprintf('admin.%s.destroy', $route))) {
            $this->type='destroy';
            $this->icon('icon-trash');
            $this->color('danger');
            return $this->href(function ($model) use ($route) {
                if(!$model)
                    return [];
                return $this->destroy_route_name($model);
            });
        }
        else{
            $this->hidden_destroy();
        }
        return $this;
    }

    /**
     * @param $model
     *
     * @return $this
     */
    public function edit($route): self
    {
        if(has_permission_route_name(sprintf('admin.%s.edit', $route))) {
            $this->type='edit';
            $this->icon('icon-edit');
            $this->color('primary');
            return $this->href(function ($model) use ($route) {
                if(!$model)
                    return [];
                return $this->edit_route_name($model);
            });
        }
        else{
            $this->hidden_edit();
        }
        return $this;
    }

    /**
     * @param $href
     *
     * @return $this
     */
    public function show($route): self
    {
        if(has_permission_route_name(sprintf('admin.%s.show', $route))) {
            $this->type='show';
            $this->icon('icon-eye');
            $this->color('warning');
            return $this->href(function ($model) use ($route) {
                if(!$model)
                    return [];
                return $this->show_route_name($model);
            });
        }
        else{
            $this->hidden_show();
        }
        return $this;
    }


    public function toArray(){
        return [
            'type'                      =>$this->type,
            'text'                      =>$this->text,
            'name'                      =>$this->name,
            'hidden'                    =>$this->getHidden(),
            'formRenderFramework'       =>sprintf("FormRenderer%s", Str::title($this->type)),
            'cellRenderFramework'       =>sprintf("CellRenderer%s", Str::title($this->type)),
            'attributes'                =>$this->getAttributes()
        ];
    }


    /**
     * @return array
     */
    public function setComponent($component, $model): array
    {
        if($component->attributes):
            foreach ($component->attributes as $key => $attribute):
                if(is_callable($attribute)){
                    $component->attributes[$key] =  app()->call($attribute,[
                        'model'=>$model
                    ]);
                }
            endforeach;
        endif;
        return $component->toArray();
    }
}
