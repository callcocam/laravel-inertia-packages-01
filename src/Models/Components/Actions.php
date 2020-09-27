<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Actions
{
    protected $text;
    protected $name;
    protected $icon = "TrashIcon";
    protected $message = "Nenhuma rota foi passada :(";
    protected $default;
    protected $route;

    /**
     * Actions constructor.
     * @param $text
     * @param null $name
     */
    public function __construct($text, $name=null)
    {
        $this->text = $text;
        $this->name = $name ?? Str::snake(Str::lower($text));
    }

    /**
     * @param $text
     * @param null $name
     * @return \Call\Models\Components\Actions
     */
    public static function make($text, $name=null){

        return new static($text, $name);

    }

    /**
     * @param string $name
     * @return Actions
     */
    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param mixed $text
     * @return Actions
     */
    public function text($text): self
    {
        $this->text = $text;

        return $this;
    }
    /**
     * @param mixed $message
     * @return Actions
     */
    public function message($message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param mixed $route
     * @return Actions
     */
    public function route($route, $action, $params = []): self
    {
        $route = sprintf('admin.%s.actions.%s', $route, $action);

        if(Route::has($route)){

            $this->route = route($route,$params);

        }
        return $this;
    }

    /**
     * @param mixed $route
     * @return Actions
     */
    public function action($path, $action, $controller, $route, $params = []): self
    {
        if(!Route::has($route)){

            Route::post(sprintf("/%s", $path), sprintf('%sController', $controller),$action)->name($route);

        }

        return $this->route($route, $params);
    }

    /**
     * @param mixed $default
     * @return Actions
     */
    public function default($default): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * @param mixed $icon
     * @return Actions
     */
    public function icon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function __get($name)
    {
        return $this->{$name};
    }
}
