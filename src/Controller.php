<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call;


use Call\Facades\Call;
use Illuminate\Http\Request;

class Controller
{
    public function __invoke(Request $request)
    {
        return Call::render(
            $request->route()->defaults['component'],
            $request->route()->defaults['props']
        );
    }
}
