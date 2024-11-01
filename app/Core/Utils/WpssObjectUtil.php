<?php

namespace App\Core\Utils;

defined('ABSPATH') || exit('no access');
class WpssObjectUtil
{
    /**
     * convert data to object ( good for arrays )
     *
     * @param mixed $data
     * @return void
     */
    public static function toObject($data) : \stdClass
    {
        return json_decode(json_encode( (object) $data));
    }
}
