<?php

namespace SFAL\Init;

defined('ABSPATH') || exit('no access');

use SFAL\Core\Support\Assets\SfalAssetsLoader as Assets;

class SfalInitialize
{
    public static function registerScripts()
    {
        $assetsUrl = SfalConfig('app.assetsUrl');
        $distUrl = SfalConfig('app.distUrl');
        $prefix = SFAL()->getPrefix();

        // register styles
        Assets::getInstance($prefix)
            ->registerStyle('reset', $assetsUrl . 'css/reset.css')
            ->registerStyle('lineIcons', $assetsUrl . 'library/lineicons/LineIcons.min.css')
            ->registerStyle('colorpicker', $assetsUrl . 'library/color-picker/jquery.minicolors.css')
            ->registerStyle('cooltipz', $assetsUrl . 'library/cooltipz/cooltipz.min.css')
            ->registerStyle('admin', $assetsUrl . 'css/admin.css');

        // register styles(2)
        Assets::getInstance()
            ->registerStyle('animated', $assetsUrl . 'library/animate/animate.css')
            ->registerStyle('lightbox', $assetsUrl . 'library/lightbox/css/lightbox.min.css')
            ->registerStyle('swiper', $assetsUrl . 'library/swiper/swiper.min.css')
            ->registerStyle('justified', $assetsUrl . 'library/justified/justifiedGallery.min.css');

        // register scripts
        Assets::getInstance()
            ->registerScript('sweetalert', $assetsUrl . 'library/sweetalert2/sweetalert2.all.min.js', ['jquery'], false, true)
            ->registerScript('tagify', $assetsUrl . 'library/tagify/tagify.min.js', ['jquery'], false, true)
            ->registerScript('colorpicker', $assetsUrl . 'library/color-picker/jquery.minicolors.min.js', ['jquery'], false, true);

        // register scripts (2)
        Assets::getInstance()
            ->registerScript('lightbox',  $assetsUrl . 'library/lightbox/js/lightbox.min.js', ['jquery'])
            ->registerScript('swiper', $assetsUrl . 'library/swiper/swiper.min.js', ['jquery'])
            ->registerScript('justified', $assetsUrl . 'library/justified/jquery.justifiedGallery.min.js', ['jquery'])
            ->registerScript('highlight', $assetsUrl . 'library/highlight/jquery.highlight-5.closure.js', ['jquery'])
            ->registerScript('lazyLoad', $assetsUrl . 'library/lazyLoad/jquery.lazy.min.js', ['jquery'])
            ->registerScript('lazyAv', $assetsUrl . 'library/lazyLoad/plugins/jquery.lazy.av.min.js', ['jquery'])
            ->registerScript('isotope', $assetsUrl . 'library/isotope/isotope.pkgd.min.js', ['jquery']);

        Assets::getInstance()->registerScript('front-bundle', $distUrl . 'js/front-bundle.js', ['jquery', $prefix . '_isotope', $prefix . '_highlight', $prefix . '_lazyLoad', $prefix . '_lazyAv'], false, true);

        // code editor
        $aceThemeDeps = ['jquery', $prefix . '_ace'];
        $aceModeDeps = ['jquery', $prefix . '_ace-theme'];
        $jqueryAceDeps = ['jquery', $prefix . '_ace-mode'];
        Assets::getInstance()
            ->registerScript('ace', $assetsUrl . 'library/ice-editor/ace.js', ['jquery'], false, true)
            ->registerScript('ace-theme', $assetsUrl . 'library/ice-editor/theme-monokai.js', $aceThemeDeps, false, true)
            ->registerScript('ace-mode', $assetsUrl . 'library/ice-editor/mode-css.js', $aceModeDeps, false, true)
            ->registerScript('jquery-ace', $assetsUrl . 'library/ice-editor/jquery-ace.min.js' , $jqueryAceDeps, false, true);

        $deps = [
            'jquery',
            'jquery-ui-sortable',
            $prefix . '_tagify',
            $prefix . '_colorpicker',
            $prefix . '_ace',
            $prefix . '_ace-theme',
            $prefix . '_ace-mode',
            $prefix . '_jquery-ace' 
        ];

        Assets::getInstance()->registerScript('admin-bundle', $distUrl . 'js/admin-bundle.js', $deps, false, true);
    }
}
