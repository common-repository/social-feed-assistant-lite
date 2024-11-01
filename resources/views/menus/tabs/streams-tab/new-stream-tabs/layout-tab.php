<li tab-content="sfal-create-stream-layout-tab">

    <div class="sfal-setting-row clearfix">

        <div class="sfal-tab-content-header-heading">
            <div class="sfal-tab-content-header">
                <span class="sfal-setting-row-title"><?php _e('Stream Template', 'wp-ss') ?></span>
                <span class="sfal-setting-row-description"><?php _e('Each template offers unique design and set of styling options.', 'wp-ss') ?></span>
            </div>
        </div>

        <div class="sfal-template-selector-container">
            <ul class="sfal-create-stream-template-selector">
                <li>
                    <span data-template="tile"> <i class="skeleton-tile"></i> Tile </span>
                </li>
                <li>
                    <span class="active-template" data-template="classic"> <i class="skeleton-classic"></i> Classic </span>
                </li>
            </ul>
        </div>

    </div>

    <div class="sfal-setting-row clearfix">

        <div class="sfal-tab-content-header-heading">
            <div class="sfal-tab-content-header">
                <span class="sfal-setting-row-title"><?php _e('Stream Layout', 'wp-ss') ?></span>
                <span class="sfal-setting-row-description"><?php _e(
                            'Each layout offers unique state of show and set of styling options.',
                            'wp-ss'
                        ) ?></span>
            </div>
        </div>

        <div class="sfal-layout-selector-container">
            <ul class="sfal-create-stream-layout-selector">

                <li data-content="sfal-create-stream-masonry-layout-settings"><span class="active-layout" data-label="masonry"><i class="sprite-masonry"></i> Masonry </span></li>

                <li data-content="sfal-create-stream-grid-layout-settings" class="sfal-premium-feature-lock">
                    <span data-label="grid"><i class="sprite-grid"></i> Grid </span>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-layout">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </li>

                <li data-content="sfal-create-stream-justified-layout-settings" class="sfal-premium-feature-lock">
                    <span data-label="justified"><i class="sprite-justified"></i> Justified </span>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-layout">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </li>

                <li data-content="sfal-create-stream-wall-layout-settings" class="sfal-premium-feature-lock">
                    <span data-label="wall"><i class="sprite-wall"></i> Wall </span>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-layout">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </li>

                <li data-content="sfal-create-stream-carousel-layout-settings" class="sfal-premium-feature-lock">
                    <span data-label="carousel"><i class="sprite-carousel"></i> Carousel </span>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-layout">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </li>

            </ul>
        </div>

    </div>

    <div class="sfal-setting-row sfal-border-btm-none clearfix">
        <div class="sfal-layout-content">
            <ul class="sfal-create-stream-layout-settings">

                <li data-content="sfal-create-stream-masonry-layout-settings" class="active-layout-content clearfix">

                    <div class="sfal-setting-row-header">

                        <div class="sfal-setting-row-title"><?php _e('Responsive settings', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('Set number of columns
                            and gaps between stream posts for various screen sizes. Keep in
                            mind
                            that size depends on container which can have not full width of
                            screen.', 'wp-ss') ?>
                        </div>

                    </div>
                    <div class="sfal-setting-row-content sfal-device-list">

                        <div>

                            <img class="sfal-device-image sfal-device-desktop-image"
                                 src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/admin/desktop.png') ?>" alt="desktop size">

                            <div class="range-slider">
                                <input class="range-slider__range" type="range" value="4" min="1" max="12"
                                       name="options[masonry][responsive][desktop][column]">
                                <span class="range-slider__value">0</span>
                            </div>

                            columns with <input class="sfal-extra-small" type="number" min="0" value="30"
                                                name="options[masonry][responsive][desktop][gap]"/>
                            px gaps

                        </div>

                        <div>

                            <img class="sfal-device-image sfal-device-tablet-image"
                                 src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/admin/tablet.png') ?>" alt="tablet size">

                            <div class="range-slider">
                                <input class="range-slider__range" type="range" value="2" min="1" max="12"
                                       name="options[masonry][responsive][tablet][column]">
                                <span class="range-slider__value">0</span>
                            </div>

                            columns with <input class="sfal-extra-small" type="number"
                                                min="0"
                                                value="15"
                                                name="options[masonry][responsive][tablet][gap]"/>
                            px gaps

                        </div>

                        <div>
                            <img class="sfal-device-image sfal-device-mobile-image"
                                 src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/admin/mobile.png') ?>" alt="mobile size">

                            <div class="range-slider">
                                <input class="range-slider__range" type="range" value="1" min="1" max="12"
                                       name="options[masonry][responsive][mobile][column]">
                                <span class="range-slider__value">0</span>
                            </div>

                            columns with <input class="sfal-extra-small" type="number"
                                                min="0"
                                                value="15"
                                                name="options[masonry][responsive][mobile][gap]"/>
                            px gaps

                        </div>

                    </div>

                </li>

            </ul>
        </div>
    </div>

    <br><br><br><br><br><br><br>
</li>