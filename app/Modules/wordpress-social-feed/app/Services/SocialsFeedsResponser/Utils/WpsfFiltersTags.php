<?php

namespace WPSF\Services\SocialsFeedsResponser\Utils;

defined('ABSPATH') || exit('no access');
class WpsfFiltersTags
{
	/**
	 * Checks whether the filter is an account type
	 *
	 * @param string $tag
	 * @return boolean
	 */
	public static function isAccountTag( string $tag ) {
		return preg_match( '/^@([\w\d.]){3,}/m', $tag ) == 1 ? true : false;
	}

	/**
	 * Checks whether the filter is an url type
	 *
	 * @param string $tag
	 * @return boolean
	 */
	public static function isUrl( string $tag ) {
		return preg_match( '/^\!([\w\d-.]){3,}/m', $tag ) == 1 ? true : false;
	}

	/**
	 * @param array $tags
	 * @return void
	 */
	public static function dispatchFilterTags( array $tags ) {

		$result = [
			'account' => [],
			'word'    => [],
			'url'     => [],
		];

		foreach ( $tags as $tag ) {
			$length = (false !== strpos($tag, '!' ) || false !== strpos($tag, '@')) ? 4 : 3;

			if ( strlen( $tag ) < $length ) {
				continue;
			}
			if ( true === self::isAccountTag( $tag ) ) {
				$result['account'][] = strtok($tag, '@');
				continue;
			}
			if ( true === self::isUrl( $tag ) ) {
				$result['url'][] = strtok($tag, '!');
				continue;
			}
			$result['word'][] = $tag;
		}

		return $result;
	}
}