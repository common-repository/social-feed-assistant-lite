<?php defined('ABSPATH') || exit('no access'); ?>

<section id="wpsf-stream-<?php echo (int) $streamID ?? 0 ?>" class="wpsf-stream-wrapper clearfix"
    data-stream-id="<?php echo (int) $streamID ?? 0 ?>" data-post-count="<?php echo (int) $postCount ?? 4 ?>"
    data-stream-options='<?php echo json_encode($options) ?>'
    data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"
    data-nonce="<?php echo wp_create_nonce('wpsf_get_stream_posts') ?>">

    <div class="wpsf-<?php echo sanitize_html_class($template ?? '') ?>-feeds-main wpsf-feeds-main">

        <?php if ($layout != 'carousel') : ?>
            <div class="wpsf-stream-wrapper-header clearfix">
                <?php if ($options->general->showSearchBar) : ?>
                    <div class="wpsf-stream-searchbox-container">
                        <p class="wpsf-stream-searchbox">
                            <input type="text" placeholder="Search">
                            <span class="wpsf-stream-searchbox-icon"><i class="lni-search"></i></span>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="wpsf-feeds-main-container clearfix">
            <div id="wpsf-row-<?php echo (int) $streamID ?? 0 ?>" class="wpsf-row">
                <?php if ($layout == 'carousel') :  ?>
                    <div id="wpsf-swiper-container-<?php echo (int) $streamID ?? 0 ?>" class="wpsf-swiper-container swiper-container" style="display:none;" >
                        <div id="wpsf-swiper-wrapper-<?php echo (int) $streamID ?? 0 ?>" class="wpsf-swiper-wrapper swiper-wrapper">
  
                        </div>
                        <?php if ($layout == 'carousel' && $options->carousel->sliderControls->arrowsControl) : ?>
                            <span id="wpsf-swiper-prev-<?php echo (int) $streamID ?>" class="wpsf-swiper-prev">
                                <i class='lni lni-chevron-left'></i>
                            </span>
                            <span id="wpsf-swiper-next-<?php echo (int) $streamID ?>" class="wpsf-swiper-next">
                                <i class='lni lni-chevron-right'></i>
                            </span>
                        <?php endif; ?>
                        <?php if ($options->carousel->sliderControls->paginationControl) : ?>
                            <div id="wpsf-swiper-pagination-<?php echo (int) $streamID ?>" class="wpsf-swiper-pagination swiper-pagination swiper-pagination-white"></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="wpsf-stream-wrapper-loader clearfix">
            <?php $loadingImage = $options->general->loadingImage ?: WpssConfig('app.assetsUrl') . 'img/user/Ripple-1.2s-74px.svg'; ?>
            <img src="<?php echo esc_url($loadingImage); ?>">
        </div>

        <?php if(($layout == 'carousel' && $options->carousel->loadMore) || $layout !== "carousel") : ?>
            <div class="wpsf-load-more clearfix">
                <div class="wpsf-load-more-button">
                    <button class="wpsf-load-more-spinner" data-page="2">
                        Load More
                    </button>
                </div>
             </div>
        <?php endif;  ?>

    </div>
</section>
