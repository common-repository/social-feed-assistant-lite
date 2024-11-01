<?php

defined('ABSPATH') || exit('no access');

use SFAL\Core\Foundation\SfalApplication;

if (! function_exists('SFAL')) :
    function SFAL()
    {
        return SfalApplication::get();
    }
endif;

return SFAL();
