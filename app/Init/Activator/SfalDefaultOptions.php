<?php

namespace SFAL\Init\Activator;

defined('ABSPATH') || exit('no access');

class SfalDefaultOptions
{
    /**
     * task for migration database
     *  
     * @var array
     */
    private static $options = [
        'sfal_general_settings' => [
            'shareButtons' => [
                'twitter',
                'facebook',
                'linkedin',
                'google-plus',
                'pinterest',
                'mail'
            ],
            'eraseData' => 0
        ]
    ];

    /**
     * initial dependencies for work with database and migration
     */
    public static function initial()
    {
        foreach (self::$options as $key => $value) {
            add_option($key, $value);
        }
        update_option('sfal_options_init', 'true');
    }

    /**
     * check is before initialized default options
     *
     * @return boolean
     */
    public static function isBeforeInit() : bool
    {
        return (bool) get_option('sfal_options_init', false);        
    }
}
