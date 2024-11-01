<?php defined('ABSPATH') || exit('no access'); ?>

<section id="sfal-stream-<?php echo (int) $streamID ?? 0 ?>" class="sfal-stream-wrapper clearfix"
    data-stream-id="<?php echo (int) $streamID ?? 0 ?>" data-post-count="<?php echo (int) $postCount ?? 4 ?>"
    data-stream-options='<?php echo json_encode($options) ?>'
    data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')) ?>"
    data-nonce="<?php echo wp_create_nonce('sfal_get_stream_posts') ?>">

    <div class="sfal-<?php echo sanitize_html_class($template ?? '') ?>-feeds-main sfal-feeds-main">

        <?php if ($layout != 'carousel') : ?>
            <div class="sfal-stream-wrapper-header clearfix">
                <?php if ($options->general->showSearchBar === 1) : ?>
                    <div class="sfal-stream-searchbox-container">
                        <p class="sfal-stream-searchbox">
                            <input type="text" placeholder="Search">
                            <span class="sfal-stream-searchbox-icon"><i class="lni-search"></i></span>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="sfal-feeds-main-container clearfix">
            <div id="sfal-row-<?php echo (int) $streamID ?? 0 ?>" class="sfal-row">
                <?php if ($layout == 'carousel') :  ?>
                    <div id="sfal-swiper-container-<?php echo (int) $streamID ?? 0 ?>" class="sfal-swiper-container swiper-container" style="display:none;" >
                        <div id="sfal-swiper-wrapper-<?php echo (int) $streamID ?? 0 ?>" class="sfal-swiper-wrapper swiper-wrapper">
  
                        </div>
                        <?php if ($layout == 'carousel' && $options->carousel->sliderControls->arrowsControl === 1) : ?>
                            <span id="sfal-swiper-prev-<?php echo (int) $streamID ?>" class="sfal-swiper-prev">
                                <i class='lni lni-chevron-left'></i>
                            </span>
                            <span id="sfal-swiper-next-<?php echo (int) $streamID ?>" class="sfal-swiper-next">
                                <i class='lni lni-chevron-right'></i>
                            </span>
                        <?php endif; ?>
                        <?php if ($options->carousel->sliderControls->paginationControl === 1) : ?>
                            <div id="sfal-swiper-pagination-<?php echo (int) $streamID ?>" class="sfal-swiper-pagination swiper-pagination swiper-pagination-white"></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="sfal-stream-wrapper-loader clearfix">
            <?php $loadingImage = $options->general->loadingImage ?: SfalConfig('app.assetsUrl') . 'img/user/Ripple-1.2s-74px.svg'; ?>
            <img src="<?php echo esc_url($loadingImage); ?>">
        </div>

        <?php if(($layout == 'carousel' && $options->carousel->loadMore === 1) || $layout !== "carousel") : ?>
            <div class="sfal-load-more clearfix">
                <div class="sfal-load-more-button">
                    <button class="sfal-load-more-spinner" data-page="2">
                        <?php _e('Load More', 'sfal') ?>
                    </button>
                </div>
             </div>
        <?php endif;  ?>

    </div>
</section>
