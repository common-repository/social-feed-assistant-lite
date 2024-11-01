<?php

namespace SFAL\Core\Router;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Router\SfalRouter;

final class SfalTemplatesRouter
{
    private $routes;
    private static $instance;

    private function __construct()
    {
        $this->routes = apply_filters('SfalTemplateRoutes', SfalConfig('routes.social-stream'));
        $this->addRoutes();
    }

    /**
     * this will add all plugin template routes
     */
    private function addRoutes()
    {
        foreach ($this->routes as $route => $params) {
            SfalRouter::add($route, $params);
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
        if (false === ($template = SfalRouter::dispatch($route))) {
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
        (null === self::$instance) && self::$instance = new self();

        return self::$instance;
    }
}
