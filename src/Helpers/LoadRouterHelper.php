<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Helpers;


class LoadRouterHelper
{

    /**
     * @var array
     */
    private $ignore = ['ignition','auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile', 'roles', 'permissions'];

    /**
     * @var array
     */
    private $required = ['admin'];


    public static function make()
    {

        $make = new static();

        return $make->load();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    private function load()
    {

        //$this->permission->slug_fixed = true;

        $options = [];

        foreach (\Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :

                $data = explode(".", $route->action['as']);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :
                        //{"admin":{"uri":"admin","methods":["GET","HEAD"],"domain":null}
                        if (!in_array($route->action['as'], $options)) {
                            $options[$route->action['as']] = [
                                "uri"=>$route->uri,
                                "methods"=>$route->methods,
                                "domain"=>null,
                            ];
                        }

                   endif;

                endif;

            endif;
        }
        return [
            "namedRoutes" => $options,
            "baseUrl" => request()->getSchemeAndHttpHost(),
            "baseProtocol" => request()->getScheme(),
            "baseDomain" => request()->getHost(),
            "basePort" => false
        ];
    }


    private function getIgnore($value)
    {

        $result = true;

        foreach ($this->ignore as $item) {

            if (in_array($item, $value)) {

                $result = false;
            }
        }

        return $result;
    }


    private function getRequired($value)
    {

        $result = false;

        foreach ($this->required as $item) {

            if (in_array($item, $value)) {

                $result = true;
            }
        }

        return $result;
    }
}
