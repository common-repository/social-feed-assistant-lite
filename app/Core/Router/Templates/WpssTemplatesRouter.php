<?php

namespace App\Core\Router\Templates;

defined('ABSPATH') || exit('no access');

use App\Core\Router\WpssRouter;

final class WpssTemplatesRouter
{
    private $routes;
    private static $instance;

    private function __construct()
    {
        $this->routes = apply_filters('WpssTemplateRoutes', WpssConfig('routes.social-stream'));
        $this->addRoutes();
    }

    /**
     * this will add all plugin template routes
     */
    private function addRoutes()
    {
        foreach ($this->routes as $route => $params) {
            WpssRouter::add($route, $params);
        }
    }

    /**
     *
     * this will get template with route that
     * if $echo it was true then this will print template in output
     * if $ajax it was true then this will dump template to output
     * otherwise returned template
     *
     * @param  string  $route
     * @param  bool  $echo
     * @param  bool  $ajax
     *
     * @return bool|mixed
     */
    public function getTemplate(string $route, bool $echo = false, $ajax = false)
    {
        if (false === ($template = WpssRouter::dispatch($route))) {
            $this->getTemplate('/404', $echo, $ajax);
        }

        if ($ajax) {
            wp_send_json_success($template);
        }

        if (! $echo) {
            return $template;
        }

        echo $template;
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
