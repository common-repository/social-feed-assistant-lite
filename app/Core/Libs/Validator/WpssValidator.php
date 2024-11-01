<?php

namespace App\Core\Libs\Validator;

defined('ABSPATH') || exit('no access');

use Rakit\Validation\Validator;

class WpssValidator extends Validator
{
    public function __construct()
    {
        parent::__construct([
            'required' => __('The :attribute is required', 'wp-ss'),
            'min'      => __('The :attribute minimum is :min', 'wp-ss'),
            'max'      => __('The :attribute maximum is :max', 'wp-ss'),
            'numeric'  => __('The :attribute must be numeric', 'wp-ss'),
            'integer'  => __('The :attribute must be integer', 'wp-ss'),
            'alpha'    => __('The :attribute only allows alphabet characters', 'wp-ss'),
            'email'    => __('The :attribute is not valid email', 'wp-ss'),
            'in'       => __('The :attribute only allows :allowed_values', 'wp-ss')
        ]);
    }
}
