<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Form;


use Illuminate\Support\Arr;

class Form extends \ArrayObject
{

    protected $name;

    protected $form = [];

    protected $attributes = [];

    public function __construct($name,$input = array(),$attributes = array())
    {
        $this->name = $name;

        $this->form($input);

        $this->attributes($attributes);

        parent::__construct([
            $this->name=>$input,
            'form'=>$this->form,
            'attributes'=>$this->attributes,
        ], $flags = 0, $iterator_class = "ArrayIterator");
    }

    /**
     * @param $name
     * @param array $input
     * @param array $attributes
     * @return static
     */
    public static function make($name,$input = array(),$attributes = array())
    {
        return new static($name,$input,$attributes);
    }

    public function form(array  $input)
    {

        if($input){
            foreach ($input as $key=> $value ){
                $this->form[$key] = Arr::get($value, 'value');
            }
        }
        $this->offsetSet('form', $this->form);

        return $this;
    }

    public function attributes(array  $attributes)
    {
        if($attributes){
            foreach ($attributes as $key=>$value){
                $this->attribute($key, $value);
            }
        }
        return $this;
    }


    public function attribute($key, $value)
    {
        $this->attributes[$key] = $value;

        $this->offsetSet('attributes',$this->attributes);

        return $this;
    }

}
