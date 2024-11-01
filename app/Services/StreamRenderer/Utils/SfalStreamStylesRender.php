<?php

namespace SFAL\Services\StreamRenderer\Utils;

defined('ABSPATH') || exit('no access');
class SfalStreamStylesRender
{
    /**
     *
     * @param integer $streamID
     * @param \stdClass $styleOptions
     * @param \stdClass $colorOptions
     * @param string $template
     * @return bool
     */
    public static function render(int $streamID, \stdClass $options, string $template, string $layout)
    {
        $stylePath = self::resolveStreamStylesCachePathAndUrl($streamID);

        file_exists($stylePath['path']) || self::renderAndPutStyles($streamID, $template, $layout, $options);

        return $stylePath['url'];
    }

    public static function removeCache(int $streamID)
    {
        $stylePath = self::resolveStreamStylesCachePathAndUrl($streamID);

        file_exists($stylePath['path']) && wp_delete_file($stylePath['path']);
    }

    /**
     *
     * @param integer $streamID
     * @param string $path
     * @return SfalAssetsLoader
     */
    private static function getStyles(string $path)
    {
        return file_get_contents($path);
    }

    /**
     *
     * @param integer $streamID
     * @return array
     */
    private static function resolveStreamStylesCachePathAndUrl(int $streamID): array
    {
        $prefix = SFAL()->getPrefix();
        $base   = self::getUploadBaseAndUrl();
        $path   = $base['dir'] . DIRECTORY_SEPARATOR . $prefix . "-stream-{$streamID}.css";
        $url    = $base['url'] . '/' . $prefix . "-stream-{$streamID}.css";

        return ['path' => $path, 'url' => $url];
    }

    /**
     *
     * @return array
     */
    private static function getUploadBaseAndUrl(): array
    {
        $wpBase      = wp_get_upload_dir();
        $sfalBase    = $wpBase['basedir'] . DIRECTORY_SEPARATOR . 'wp-sf-cache-styles';
        $sfalBaseUrl = $wpBase['baseurl'] . '/wp-sf-cache-styles';

        file_exists($sfalBase) || wp_mkdir_p($sfalBase);

        return ['dir' => $sfalBase, 'url' => $sfalBaseUrl];
    }

    /**
     *
     * @param integer $streamID
     * @param string $template
     * @param \stdClass $styleOptions
     * @param \stdClass $colorOptions
     * @return void
     */
    private static function renderAndPutStyles(int $streamID, string $template, string $layout, \stdClass $options)
    {
        $rendered = self::renderCss($template, $streamID, $options);
        self::putAndSave($rendered, $streamID);
    }

    /**
     *
     * @param string $template
     * @param array $options
     * @return string
     */
    private static function renderCss(string $template, int $streamID, \stdClass $options): string
    {
        $assetsUrl = esc_url(SfalConfig('app.assetsUrl'));
        $styles = SfalViews()->get("shortcodes.sfal.styles.{$template}", compact('assetsUrl', 'streamID', 'options'));
        return SfalViews()->get("shortcodes.sfal.styles.main", compact('streamID', 'styles', 'assetsUrl', 'options'));
    }

    /**
     *
     * @param string $styles
     * @param integer $streamID
     * @return void
     */
    private static function putAndSave(string $styles, int $streamID)
    {
        $pathAndUrl = self::resolveStreamStylesCachePathAndUrl($streamID);
        file_put_contents($pathAndUrl['path'], $styles);
    }
}
