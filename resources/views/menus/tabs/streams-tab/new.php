<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Create Stream', 'wp-ss') ?></span>
    <span class="sfal-tab-content-description"><?php _e('Create your Stream and use on frontend with special shortcode', 'wp-ss') ?></span>
    <a class="sfal-back-page" sfal-get-back><i class="lni-arrow-left"></i>
		<?php _e('STREAMS LIST', 'wp-ss') ?></a>
</div>
<div class="sfal-tab-content-main">
    <form class="sfal-create-stream-form" method="get" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
        <div class="sfal-create-stream-form-content sfal-form-content">

            <div class="sfal-form-input sfal-visible-hidden">
                <input type="hidden" name="action" value="sfal_new_stream"/>
            </div>

            <div class="sfal-form-input sfal-create-stream-form-name">

                <label for="sfal-create-stream-name-input"><?php _e('Stream Name', 'sfal') ?></label>
                <input id="sfal-create-stream-name-input" type="text" placeholder="<?php _e('Choose a name', 'sfal') ?>"
                       name="options[name]"/>
            </div>

            <div class="sfal-tabs sfal-create-stream-tabs">

                <div class="sfal-tabs-navigation">
                    <nav class="sfal-tabs-navbar">
                        <ul class="sfal-tabs-list" nav-tab="sfal-create-stream-tabs">
                            <li>
                                <a class="selected" tab-content="sfal-create-stream-source-tab"><?php _e('Source', 'wp-ss') ?></a>
                            </li>
                            <li>
                                <a tab-content="sfal-create-stream-layout-tab"><?php _e('Layout', 'wp-ss') ?></a>
                            </li>
                            <li class="sfal-premium-feature-lock">
                                <a>
                                    <span><?php _e('Filters', 'wp-ss') ?></span>
                                </a>
                                <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-tab">
                                    <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                                    <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                                    <br>
                                    <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                                </div>
                            </li>
                            <li>
                                <a tab-content="sfal-create-stream-style-color-tab"><?php _e('Style and Color', 'wp-ss') ?></a>
                            </li>
                            <li>
                                <a tab-content="sfal-create-stream-settings-tab"><?php _e('Settings', 'wp-ss') ?></a>
                            </li>
                            <li>
                                <a tab-content="sfal-create-stream-shortcode-tab"><?php _e('Shortcode', 'wp-ss') ?></a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="sfal-tabs-content">
                    <ul class="sfal-tabs-list-content" nav-tab-content="sfal-create-stream-tabs">
						<?php SfalViews("menus.tabs.streams-tab.new-stream-tabs.source-tab", compact('feeds')) ?>
						<?php SfalViews("menus.tabs.streams-tab.new-stream-tabs.layout-tab") ?>
						<?php SfalViews("menus.tabs.streams-tab.new-stream-tabs.style-color-tab") ?>
						<?php SfalViews("menus.tabs.streams-tab.new-stream-tabs.settings-tab", compact('afterAutoIncreament')) ?>
						<?php SfalViews("menus.tabs.streams-tab.new-stream-tabs.shortcode-tab", compact('afterAutoIncreament')) ?>
                    </ul>
                </div>

            </div>

			<?php wp_nonce_field('sfal-new-stream', 'save-stream-nonce'); ?>
        </div>
        <div class="sfal-create-stream-form-footer sfal-form-footer">
            <button type="submit" class="sfal-button sfal-button-blue"><?php _e('SAVE STREAM', 'wp-ss') ?></button>
            <div class="clearfix"></div>
        </div>
    </form>
</div>
