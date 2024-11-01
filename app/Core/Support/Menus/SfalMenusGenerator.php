<?php

namespace SFAL\Core\Support\Menus;

defined('ABSPATH') || exit('no access');

class SfalMenusGenerator
{
    /**
     * The array of menus for registered ( add_menu_page )
     */
    private static $menus;
    /**
     * The array of submenus for registered ( add_submenu_age)
     */
    private static $submenus;
    /**
     * This will initial for each menu or submenu on generated
     */
    private static $slug;
    /**
     * This will initial for each menu or submenu page title on generated
     */
    private static $pageTitle;
    /**
     * This will initial for each menu or submenu menu title on generated
     */
    private static $menuTitle;
    /**
     * This will initial for each menu or submenu capability on generated
     */
    private static $capability;
    /**
     * This will initial for each menu or submenu function ( callback ) on generated
     */
    private static $function;
    /**
     * This will initial for each menu or submenu icon on generated
     */
    private static $icon;
    /**
     * This will initial for each menu or submenu position on generated
     */
    private static $position;
    /**
     * This will initial for each menu or submenu callback loaded on generated
     */
    private static $loaded;
    /**
     * This will initial for each menu has a submenu , then register them
     */
    private static $submenu;
    /**
     * This is prefix for all menus and submenus page link
     */
    private static $prefix;

    public static function init(string $prefix)
    {
        self::$prefix   = $prefix;
        self::$menus    = apply_filters('SfalAdminMenus', SfalConfig('pages.social-stream'));
        self::$submenus = apply_filters('SfalAdminSubmenus', SfalConfig('subpages.social-stream'));

        return new static();
    }

    /**
     * this will first validate menus and submenus
     * if was true values will added them on admin menus otherwise nothing do
     */
    public static function register()
    {
        if (self::isValid(self::$menus)) {
            self::registerMenus();
        }

        if (self::isValid(self::$submenus)) {
            self::registerSubmenus();
        }
    }

    /**
     * validate menus or submenus before registered them
     *
     * @param $arg
     *
     * @return bool
     */
    private static function isValid($arg): bool
    {
        return ! is_array($arg) || empty($arg) ? false : true; 
    }

    /**
     * this will register all menus
     */
    private static function registerMenus()
    {
        foreach (self::$menus as $slug => $menu) {
            self::$slug       = self::getSlug($slug, $menu);
            self::$pageTitle  = self::getPageTitle($menu);
            self::$menuTitle  = self::getMenuTitle($menu);
            self::$capability = self::getCapability($menu);
            self::$function   = self::getFunction($menu);
            self::$icon       = self::getIcon($menu);
            self::$position   = self::getPosition($menu);
            self::$loaded     = self::getLoaded($menu);
            self::addMenu();
        }
    }

    /**
     * this will add menu on wordpress admin menus
     */
    private static function addMenu()
    {
        $hook = add_menu_page(self::$pageTitle, self::$menuTitle, self::$capability, self::$slug, self::$function, self::$icon, self::$position);

        self::addPageHooks($hook, self::$loaded);
    }

    /**
     * if registered menus has a submenu , this will add them
     */
    private static function registerSubmenus()
    {
        foreach (self::$submenus as $slug => $submenu) {
            self::$submenu['slug']       = self::getSlug($slug, $submenu);

            self::$submenu['parent']     = self::getParentSlug($submenu);
            self::$submenu['page_title'] = self::getPageTitle($submenu);
            self::$submenu['menu_title'] = self::getMenuTitle($submenu);
            self::$submenu['capability'] = self::getCapability($submenu);
            self::$submenu['function']   = self::getFunction($submenu);
            self::$submenu['loaded']     = self::getLoaded($submenu);

            self::addSubmenu();
        }
    }

    /**
     * this will add submenu on wordpress admin menus
     */
    private static function addSubmenu()
    {
        $hook = add_submenu_page(
            self::$submenu['parent'],
            self::$submenu['page_title'],
            self::$submenu['menu_title'],
            self::$submenu['capability'],
            self::$submenu['slug'],
            self::$submenu['function']
        );

        self::addPageHooks($hook, self::$submenu['loaded']);
    }

    /**
     * add page hook for registered menu
     *
     * @param $hook
     * @param $function
     */
    private static function addPageHooks(string $hook, $function)
    {
        add_action("load-{$hook}", $function);
    }

    /**
     * @param $slug
     * @param $menu
     *
     * @return string
     */
    private static function getSlug(string $slug, array $menu): string
    {
        return self::getPrefix($menu) . '-' . $slug;
    }

    /**
     * @param $menu
     *
     * @return string
     */
    private static function getParentSlug(array $menu): string
    {
        self::requiredKey('parent', $menu);

        return self::getPrefix($menu, true) . '-' . $menu['parent'];
    }

    /**
     * this will return menu or menu slug prefix
     *
     * @param  array  $menu
     * @param  bool  $submenu
     *
     * @return string
     */
    private static function getPrefix(array $menu, bool $submenu = false): string
    {
        if ($submenu) {
            return array_key_exists('parent_prefix', $menu) ? $menu['parent_prefix'] : self::$prefix;
        }

        return array_key_exists('prefix', $menu) ? $menu['prefix'] : self::$prefix;
    }

    /**
     * @param $menu
     *
     * @return string
     */
    private static function getPageTitle(array $menu): string
    {
        self::requiredKey('page_title', $menu);

        return esc_html($menu['page_title']);
    }

    /**
     * @param $menu
     *
     * @return string
     */
    private static function getMenuTitle(array $menu): string
    {
        self::requiredKey('menu_title', $menu);

        return esc_html($menu['menu_title']);
    }

    /**
     * @param $menu
     *
     * @return mixed
     */
    private static function getCapability(array $menu): string
    {
        self::requiredKey('capability', $menu);

        return $menu['capability'];
    }

    /**
     * @param $menu
     *
     * @return array|string
     */
    private static function getFunction(array $menu)
    {
        if (! array_key_exists('function', $menu)) {
            return '';
        }

        return $menu['function'];
    }

    /**
     * @param $menu
     *
     * @return mixed|string
     */
    private static function getIcon(array $menu): string
    {
        return array_key_exists('icon', $menu) ? $menu['icon'] : '';
    }

    /**
     * @param $menu
     *
     * @return mixed|null
     */
    private static function getPosition(array $menu)
    {
        return array_key_exists('position', $menu) ? $menu['position'] : null;
    }

    /**
     * @param $menu
     *
     * @return mixed|string
     */
    private static function getLoaded(array $menu)
    {
        return array_key_exists('loaded', $menu) ? $menu['loaded'] : '';
    }

    /**
     * @param $key
     * @param $menu
     *
     * check has key on menu array
     */
    private static function requiredKey(string $key, array $menu)
    {
        if (! array_key_exists($key, $menu)) {
            wp_die(__(sprintf('the %s key is required !', $key), 'sfal'));
        }
    }
}
