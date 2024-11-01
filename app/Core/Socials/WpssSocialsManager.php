<?php

namespace App\Core\Socials;

use App\Core\Utils\WpssObjectUtil;

defined('ABSPATH') || exit('no access');

class WpssSocialsManager
{
    private static $instance;
    private $socials = [];

    public function __construct()
    {
        $this->socials = WpssConfig('socials');
    }

    /**
     * @return mixed
     */
    public function getSocials() : \stdClass
    {
        return WpssObjectUtil::toObject($this->socials);
    }

    /**
     * @param $ID
     *
     * @return array|object
     */
    public function getSocialByID($ID)
    {
        foreach ($this->socials as $social) {
            if ($social['id'] === $ID) {
                return (object) $social;
            }
        }

        return [];
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
