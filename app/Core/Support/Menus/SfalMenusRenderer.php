<?php

namespace SFAL\Core\Support\Menus;

defined('ABSPATH') || exit('no access');

class SfalMenusRenderer
{
    private static $instance = null;
    /**
     *
     * this will use for get menu tabs classes ,
     * you should be fill this with tabs handler class ( every class will be one tab on frontend )
     *
     * @var array
     */
    protected $tabs = [];

    /**
     * @param  array  $tabs
     *
     * @return \SFAL\Core\Support\Menus\SfalMenusRenderer
     */
    public function setTabs(array $tabs): self
    {
        $this->tabs = $tabs;

        return $this;
    }

    /**
     * @return array
     */
    private function getTabs(): array
    {
        return $this->tabs;
    }

    /**
     * @param  string  $title
     * @param  string  $description
     */
    public function load(string $title, string $description, array $icon = [])
    {
        $tabs = $this->getTabs();
        SfalViews('menus.menus-tabs', compact('tabs', 'title', 'description', 'icon'));
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        (null == self::$instance) && self::$instance = new static();

        return self::$instance;
    }
}
