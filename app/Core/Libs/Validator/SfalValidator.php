<?php

namespace SFAL\Core\Libs\Validator;

defined('ABSPATH') || exit('no access');

use Rakit\Validation\Validator;

class SfalValidator extends Validator
{
    public function __construct()
    {
        parent::__construct([
            'required' => __('The :attribute is required', 'sfal'),
            'min'      => __('The :attribute minimum is :min', 'sfal'),
            'max'      => __('The :attribute maximum is :max', 'sfal'),
            'numeric'  => __('The :attribute must be numeric', 'sfal'),
            'integer'  => __('The :attribute must be integer', 'sfal'),
            'alpha'    => __('The :attribute only allows alphabet characters', 'sfal'),
            'email'    => __('The :attribute is not valid email', 'sfal'),
            'in'       => __('The :attribute only allows :allowed_values', 'sfal')
        ]);
    }
}
