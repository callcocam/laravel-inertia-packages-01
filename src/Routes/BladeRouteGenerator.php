<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Routes;

class BladeRouteGenerator
{
    public static $generated;

    public function generate($group = false, $nonce = false)
    {
        $payload = (new Route($group))->toJson();
        $nonce = $nonce ? ' nonce="' . $nonce . '"' : '';

        if (static::$generated) {
            return $this->generateMergeJavascript($payload, $nonce);
        }

        $routeFunction = $this->getRouteFunction();

        static::$generated = true;

        return <<<HTML
<script type="text/javascript"{$nonce}>
    var Ziggy = {$payload};
    $routeFunction
</script>
HTML;
    }

    private function generateMergeJavascript($json, $nonce)
    {
        return <<<HTML
<script type="text/javascript"{$nonce}>
    (function() {
        var routes = {$json};
        for (var name in routes) {
            Ziggy.namedRoutes[name] = routes[name];
        }
    })();
</script>
HTML;
    }

    private function getRouteFilePath()
    {
        return __DIR__ . './resources/js/route.js';
    }

    private function getRouteFunction()
    {
        if (config()->get('call.skip-route-function')) {
            return '';
        }

        return file_get_contents($this->getRouteFilePath());
    }
}
