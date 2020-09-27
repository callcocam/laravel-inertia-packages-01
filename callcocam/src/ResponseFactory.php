<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Traits\Macroable;

class ResponseFactory
{
    use Macroable;

    protected $rootView = 'layouts.app';
    protected $sharedProps = [];
    protected $version = null;

    /**
     * @param $name
     * @return $this|\Call\Response
     */
    public function setRootView($name)
    {
        $this->rootView = $name;
        return $this;
    }

    public function share($key, $value = null)
    {
        if (is_array($key)) {
            $this->sharedProps = array_merge($this->sharedProps, $key);
        } else {
            Arr::set($this->sharedProps, $key, $value);
        }
    }

    public function getShared($key = null)
    {
        if ($key) {
            return Arr::get($this->sharedProps, $key);
        }

        return $this->sharedProps;
    }

    public function version($version)
    {
        $this->version = $version;
    }

    public function getVersion()
    {
        $version = $this->version instanceof \Closure
            ? App::call($this->version)
            : $this->version;

        return (string) $version;
    }

    /**
     * @param $component
     * @param array $props
     * @return Response
     */
    public function render($component, $props = [])
    {
        if ($props instanceof Arrayable) {
            $props = $props->toArray();
        }

        return new Response(
            $component,
            array_merge($this->sharedProps, $props),
            $this->rootView,
            $this->getVersion()
        );
    }
}
