<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Form\Fields;


use Illuminate\Support\Str;

class Input extends \ArrayObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var mixed
     */
    protected $value = null;

    /**
     * Input constructor.
     * @param $name
     * @param array $attributes
     */
   public function __construct($label,$name=null, array $options=[], $attributes=[])
   {
       $this->name = $name ?? Str::snake(Str::lower($label));
       $this->label($label);
       $this->placeholder($label);
       $this->id($this->name);
       $this->type('text');
       $this->class('form-control');
       if($options){
           foreach ($options as $key=>$value){
               $this->offsetSet($key, $value);
           }
       }

       if($attributes){
           foreach ($attributes as $key=>$value){
               $this->setAttribute($key, $value);
           }
       }

       parent::__construct([
           'name'=>$this->name,
           'label'=>$this->label,
           'attributes'=>$this->attributes,
       ]);
   }

    /**
     * @param $text
     * @param $name
     * @param array $options
     * @return Input
     */
    public static function make($text, $name=null, array $options=[])
    {
        return new static($text,$name,$options);
    }

    /**
     * @param $name
     * @return $this
     */
    public function name($name): self {

        $this->offsetSet('name',$name);

        return $this;
    }

    /**
     * @param $label
     * @return $this
     */
    public function label($label): self {

        $this->offsetSet('label',$label);

        return $this;
    }

    /**
     * @param $placeholder
     * @return $this
     */
    public function placeholder($placeholder): self {

        return $this->setAttribute('placeholder', $placeholder);
    }

    /**
     * @param $id
     * @return $this
     */
    public function id($id): self {

        return $this->setAttribute('id', $id);
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type): self {

        return $this->setAttribute('type', $type);
    }

    /**
     * @param $class
     * @return $this
     */
    public function class($class): self {

        return $this->setAttribute('class', $class);
    }

    public function options($options = [])
    {
        if($options){
            foreach ($options as $key=>$value){
                $this->option($key, $value);
            }
        }

        return $this;
    }

    public function option($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        $this->offsetSet('attributes',$this->attributes);

        return $this;
    }


    public function value($value)
    {
        $this->offsetSet('value',$value);

        return $this;
    }

    /**
     * @param null $value
     * @return array
     */
    public function get($value=null): array
    {
        $this->value($value);

        return $this->getArrayCopy();
    }

    public function values(){
        return $this->data;
    }
}
