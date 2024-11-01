<?php

namespace SFAL\Core\Socials;

use SFAL\Core\Utils\SfalObjectUtil;

defined('ABSPATH') || exit('no access');

class SfalSocialsManager
{
    private static $instance;
    private $socials = [];

    public function __construct()
    {
        $this->socials = SfalConfig('socials');
    }

    /**
     * @return mixed
     */
    public function getSocials() : \stdClass
    {
        return SfalObjectUtil::toObject($this->socials);
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
        (null === self::$instance) && self::$instance = new static();

        return self::$instance;
    }
}
