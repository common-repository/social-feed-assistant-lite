<?php defined('ABSPATH') || exit('no access') ?>
<?php use SFAL\Core\Socials\SfalSocialsManager; use SFAL\Services\StreamRenderer\Utils\SfalStreamPostsShareLink; ?>
<div id="feed-<?php echo esc_attr($post->type ?? '') ?>-<?php echo esc_attr($post->id ?? 0) ?>" data-id="<?php echo esc_attr($post->id ?? 0) ?>" class="sfal-classic-feed-box sfal-classic-<?php echo esc_attr(static::$layout) ?>-feed-box <?php echo esc_attr(self::getResponsiveClasses()) ?> filter_<?php echo esc_attr($post->feed_id) ?>_<?php echo esc_attr($post->feed_content) ?>" data-category="<?php echo esc_attr($post->type) ?>">
    <div class="sfal-classic-feed-box-container">

        <?php if (self::$options->general->postSettings->displayPostElements->avatar || self::$options->general->postSettings->displayPostElements->user || self::$options->general->postSettings->displayPostElements->postLink || self::$options->general->postSettings->displayPostElements->date) : ?>

            <div class="sfal-classic-feed-box-header">

                <?php if (self::$options->general->postSettings->displayPostElements->avatar) :?>

                    <div class="sfal-classic-feed-box-header-img">
                        <img src="<?php echo (self::$options->general->maxImageResolution && $post->user->profilePic->hd) ? esc_url($post->user->profilePic->hd) : esc_url($post->user->profilePic->url) ?>">
                        <?php if(self::$options->general->style->socialIconStyle == 'timestamp') : ?>
                            <div class="sfal-classic-feed-box-social-timestamp-icon">
                                <span><i class="lni-instagram"></i></span>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>

                <?php if (self::$options->general->postSettings->displayPostElements->user || self::$options->general->postSettings->displayPostElements->postLink || self::$options->general->postSettings->displayPostElements->date) : ?>

                    <div class="sfal-classic-feed-box-header-meta">

                        <?php if (self::$options->general->postSettings->displayPostElements->user) : ?>
                            <?php if (self::$options->general->titlesLink) : ?>
                                <a href="<?php echo esc_url($post->permalink) ?>" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : '' ?>><span class="sfal-classic-feed-account-title"><?php echo esc_html($post->user->fullname) ?></span></a>
                            <?php else : ?>
                                <span class="sfal-classic-feed-account-title"><?php echo esc_html($post->user->fullname) ?></span>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (self::$options->general->postSettings->displayPostElements->postLink) : ?>
                            <?php if (self::$options->general->titlesLink) : ?>
                                <a href="<?php echo esc_url($post->user->link) ?>" class="sfal-classic-feed-account-url" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?>><span class="sfal-classic-feed-account-url" >@<?php echo esc_html($post->user->username) ?></span></a>
                            <?php else : ?>
                                <span class="sfal-classic-feed-account-url">@<?php echo esc_html($post->user->username) ?></span>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (self::$options->general->postSettings->displayPostElements->date) : ?>
                            <span class="sfal-classic-feed-account-date sfal-date-<?php echo esc_attr(self::$options->general->dateFormat) ?>-format"> <?php echo esc_html($post->post_date) ?></span>
                        <?php endif; ?>

                    </div>

                <?php endif; ?>

                <?php if (self::$options->general->style->socialIconStyle == 'corner'): ?>
                    <div class="sfal-classic-feed-box-social-icon">
                        <span><i class="<?php echo esc_attr(SfalSocialsManager::getInstance()->getSocialByID($post->type)->icon) ?>"></i></span>
                    </div>
                <?php endif; ?>

            </div>

        <?php endif; ?>

        <div class="sfal-classic-feed-box-content">

            <?php if (self::$options->general->style->socialIconStyle == 'label') : ?>

                <div class="sfal-classic-feed-box-social-title">
                    <span><?php echo $post->type ?? 'Unknown' ?></span>
                </div>

            <?php endif; ?>

            <div class="sfal-classic-feed-box-media-wrapper">
                <div class="sfal-classic-feed-box-content-img">
                    <?php if(self::$options->general->actionOnImageClick == 3) : ?>
                        <a rel="noreferrer" href="<?php echo esc_url(self::$options->general->maxImageResolution ? $post->images->high : $post->images->standard) ?>" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : '' ?> data-lightbox="feedimage">
                            <img class="sfal-lazy-img sfal-lazy-img-loading" data-src="<?php echo esc_url(self::$options->general->maxImageResolution ? $post->images->high : $post->images->standard) ?>">
                        </a>
                    <?php elseif(self::$options->general->actionOnImageClick == 4) : ?>
                        <a rel="noreferrer" href="<?php echo esc_url($post->permalink) ?>" target="_blank">
                            <img class="sfal-lazy-img sfal-lazy-img-loading" data-src="<?php echo esc_url(self::$options->general->maxImageResolution ? $post->images->high : $post->images->standard) ?>">
                        </a>
                    <?php else: ?>
                        <img class="sfal-lazy-img sfal-lazy-img-loading" data-src="<?php echo esc_url(self::$options->general->maxImageResolution ? $post->images->high : $post->images->standard) ?>">
                    <?php endif; ?>
                </div>
                <?php if($post->media_type != 'image') : ?>

                    <div class="sfal-classic-feed-box-type">
                        <?php if($post->media_type == 'video') :  ?>
                            <span class="sfal-classic-feed-box-video-type">
                                <i class="lni-play"></i>
                            </span>
                        <?php else : ?>
                            <span class="sfal-classic-feed-box-sidecar-type"></span>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            </div>

            <?php if (self::$options->general->postSettings->displayPostElements->likeCount || self::$options->general->postSettings->displayPostElements->commentCount || self::$options->general->postSettings->displayPostElements->share) : ?>

                <div class="sfal-classic-feed-box-meta clearfix">

                    <?php if (self::$options->general->postSettings->displayPostElements->likeCount) : ?>

                        <span class="sfal-classic-feed-box-like-counter-meta">
                            <a rel="noreferrer" href="<?php echo esc_url($post->permalink) ?>" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : '' ?>>
                                <i class="lni-heart"></i>
                                <?php echo esc_html($post->additional->likes ?? '0') ?>
                            </a>
                        </span>

                    <?php endif; ?>

                    <?php if (self::$options->general->postSettings->displayPostElements->commentCount) : ?>

                        <span class="sfal-classic-feed-box-comment-counter-meta">
                            <a rel="noreferrer" href="<?php echo esc_url($post->permalink) ?>" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : '' ?>>
                                <i class="lni-bubble"></i>
                                <?php echo esc_html($post->additional->comments ?? 0) ?>
                            </a>
                        </span>

                    <?php endif; ?>
                
                    <?php if (self::$options->general->postSettings->displayPostElements->share) : ?>

                        <span class="sfal-classic-feed-box-share-meta">
                            <div class="sfal-classic-feed-box-share-meta-links">
                                <?php if(in_array('twitter', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" href="<?php echo esc_url(SfalStreamPostsShareLink::twitter($post->permalink)) ?>"><i class="lni-twitter-filled"></i>Twitter</a>
                                <?php endif; ?>
                                <?php if(in_array('facebook', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?> href="<?php echo esc_url(SfalStreamPostsShareLink::facebook($post->permalink)) ?>"><i class="lni-facebook-filled"></i>Facebook</a>
                                <?php endif; ?>
                                <?php if(in_array('google-plus', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?> href="<?php echo esc_url(SfalStreamPostsShareLink::googleplus($post->permalink)) ?>"><i class="lni-google-plus"></i>Google +</a>
                                <?php endif; ?>
                                <?php if(in_array('pinterest', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?> href="<?php echo esc_url(SfalStreamPostsShareLink::pinterest($post->permalink)) ?>"><i class="lni-pinterest"></i>Pinterest</a>
                                <?php endif; ?>
                                <?php if(in_array('linkedin', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?> href="<?php echo esc_url(SfalStreamPostsShareLink::linkedin($post->permalink)) ?>"><i class="lni-linkedin-original"></i>Linkedin</a>
                                <?php endif; ?>
                                <?php if(in_array('mail', self::$options->relatedOptions->shareButtons)) : ?>
                                    <a rel="noreferrer" <?php echo self::$options->general->openLinksInNewTab ? 'target="_blank"' : null ?> href="<?php echo esc_url(SfalStreamPostsShareLink::email($post->permalink)) ?>"><i class="lni-envelope"></i>Mail</a>
                                <?php endif; ?>
                            </div>
                            <i class="lni-exit-up"></i>
                        </span>

                    <?php endif; ?>

                </div>

            <?php endif; ?>

            <?php if (self::$options->general->postSettings->displayPostElements->text) : ?>

                <div class="sfal-classic-feed-box-content-text">
                    <?php echo $post->text; ?>
                </div>

            <?php endif; ?>

        </div>

    </div>
</div>
