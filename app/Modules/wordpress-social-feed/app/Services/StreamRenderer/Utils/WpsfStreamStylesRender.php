<?php

namespace WPSF\Services\StreamRenderer\Utils;

defined('ABSPATH') || exit('no access');
class WpsfStreamStylesRender
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

        if (!file_exists($stylePath['path'])) {
            self::renderAndPutStyles($streamID, $template, $layout, $options);
        }
        return $stylePath['url'];
    }

    public static function removeCache(int $streamID)
    {
        $stylePath = self::resolveStreamStylesCachePathAndUrl($streamID);
        if (file_exists($stylePath['path'])) {
            wp_delete_file($stylePath['path']);
        }
    }

    /**
     *
     * @param integer $streamID
     * @param string $path
     * @return WpssAssetsLoader
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
        $prefix = WPSF()->getPrefix();
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
        $wpsfBase    = $wpBase['basedir'] . DIRECTORY_SEPARATOR . 'wp-sf-cache-styles';
        $wpsfBaseUrl = $wpBase['baseurl'] . '/wp-sf-cache-styles';

        if (!file_exists($wpsfBase)) {
            wp_mkdir_p($wpsfBase);
        }

        return ['dir' => $wpsfBase, 'url' => $wpsfBaseUrl];
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
        $assetsUrl = esc_url(WpssConfig('app.assetsUrl'));
        $styles = WpssViews()->get("shortcodes.wpsf.styles.{$template}", compact('assetsUrl', 'streamID', 'options'));
        return WpssViews()->get("shortcodes.wpsf.styles.main", compact('streamID', 'styles', 'assetsUrl', 'options'));
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
