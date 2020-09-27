<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call;
use Call\Facades\Call;
use Closure;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\RedirectResponse as Redirect;

class Middleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$request->header('X-Call')) {
            return $response;
        }

        if ($request->method() === 'GET' && $request->header('X-Call-Version', '') !== Call::getVersion()) {
            if ($request->hasSession()) {
                $request->session()->reflash();
            }

            return Response::make('', 409, ['X-Call-Location' => $request->fullUrl()]);
        }

        if ($response instanceof Redirect && $response->getStatusCode() === 302 && in_array($request->method(), ['PUT', 'PATCH', 'DELETE'])) {
            $response->setStatusCode(303);
        }

        return $response;
    }
}
