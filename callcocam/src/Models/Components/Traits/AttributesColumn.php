<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits;

trait AttributesColumn
{
    protected $attributes = [];

    public function help($help):self
    {
        return $this->setAttribute('help', $help);
    }
    /**
     * @param $id
     * @return $this
     */
    public function id($id){

        $this->setAttribute('id', $id);

        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function class($class){

        $this->setAttribute('class', $class);

        return $this;
    }

    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    protected function setAttribute($attribute, $value){

        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return AttributesColumn
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $key => $value){

            $this->setAttribute($key, $value);
        }

        return $this;
    }


    /**
     * @param $default
     * @return $this
     */
    public function defaults($default){

        $this->default = $default;

        return $this;
    }
}
