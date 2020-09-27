<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components;


use Call\Models\Components\Traits\AttributesColumn;
use Call\Models\Components\Traits\HasComponents;
use Call\Models\Components\Traits\HiddenColumn;
use Call\Models\Components\Traits\Inputs\Hidden;
use Call\Models\Components\Traits\OptionsColumn;

class AbstractField
{
    use HiddenColumn, OptionsColumn, AttributesColumn, HasComponents, Hidden;

    protected $model;
    /**
     * @var
     */
    protected $type = 'text';

    /**
     * @var
     */
    protected $label;

    /**
     * @var
     */
    protected $text;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $default;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var bool
     */
    protected $searchable=true;

    /**
     * @var bool
     */
    protected $sortable=false;

    /**
     * @var bool
     */
    protected $html=false;

    /**
     * @param $model
     * @return $this
     */
    public function model($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param $text
     *
     * @return self
     */
    public function text($text): self
    {
        return $this->setAttribute('text', $text);
    }


    /**
     * @param $text
     *
     * @return self
     */
    public function placeholder($placeholder): self
    {
        return $this->setAttribute('placeholder', $placeholder);
    }


    /**
     * @param $label
     *
     * @return self
     */
    public function label($label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @param $pack
     *
     * @return self
     */
    public function pack($pack): self
    {
        return $this->setAttribute('pack', $pack);
    }

    /**
     * @param $color
     *
     * @return self
     */
    public function color($color): self
    {
        return $this->setAttribute('color', $color);
    }

    /**
     * @param $size
     *
     * @return self
     */
    public function size($size): self
    {
        return $this->setAttribute('size', $size);
    }

    /**
     * @param $class
     *
     * @return $this
     */
    public function class($class): self
    {
        return $this->setAttribute('class', $class);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function id($id): self
    {
        return $this->setAttribute('id', $id);
    }

    /**
     * @param $icon
     *
     * @return $this
     */
    public function icon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param $icon
     *
     * @return $this
     */
    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }


    public function __get($name)
    {
        return $this->{$name};
    }

    public function __set($name, $value)
    {
        return $this->{$name} = $value;
    }
}
