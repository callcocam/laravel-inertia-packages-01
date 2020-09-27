<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OptionsColumn
{

    protected $options = [];
    /**
     * @return array
     */
    protected function options(): array
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function value_options($option, $key="id", $label="name"): self
    {
        if(is_string($option)){
            $value_options = app($option)->select($key, $label)->orderBy($label)->get()->toArray();
        }
        elseif ($option instanceof Builder){
            $value_options = $option->select($key, $label)->orderBy($label)->get()->toArray();
        }
        else{
            $value_options = $option;
        }
        return $this->setOption('value_options' , $value_options);
    }

    /**
     * @param $option
     * @param $value
     *
     * @return $this
     */
    public function setOption($option, $value): self
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * @param  array  $options
     *
     * @return $this
     */
    public function setOptions(array $options = []): self
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
