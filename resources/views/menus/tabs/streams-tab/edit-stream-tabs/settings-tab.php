<li tab-content="sfal-create-stream-settings-tab">
    <div class="sfal-tab-content-header">
        <span class="sfal-create-stream-tab-content-title"><?php _e('Stream general settings', 'wp-ss') ?></span>
        <span class="sfal-create-stream-tab-content-description"><?php _e('Here you can set stream general settings for all layouts.', 'wp-ss') ?></span>
    </div>

    <div class="sfal-tab-content-main clearfix">

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Items order', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('Choose rule how stream sorts posts.
				Proportional sorting guarantees that all networks are always present on first
				load.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">

            <div class="pretty p-default p-round">
                <input name="options[general][itemsOrder]" type="radio"
                       value="1" <?php checked(esc_attr($stream->options->general->itemsOrder) == 1) ?>>
                <div class="state p-primary-o">
                    <label>Publication date</label>
                </div>
            </div>
            <br><br>

            <div class="pretty p-default p-round">
                <input name="options[general][itemsOrder]" type="radio"
                       value="2" <?php checked(esc_attr($stream->options->general->itemsOrder) == 2) ?>>
                <div class="state p-primary-o">
                    <label>source list position</label>
                </div>
            </div>
            <br><br>

            <div class="pretty p-default p-round">
                <input name="options[general][itemsOrder]" type="radio"
                       value="3" <?php checked(esc_attr($stream->options->general->itemsOrder) == 3) ?>>
                <div class="state p-primary-o">
                    <label>Random</label>
                </div>
            </div>

        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Post Count', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('post count show on each page , we
				recommended you select even number', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <input class="sfal-small"
                   type="number"
                   min="1"
                    name="options[general][postCount]" value="<?php echo esc_attr($stream->options->general->postCount) ?>"/>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Max Container Width ', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('Leave empty for responsiveness, will fill container.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <input class="sfal-small"
                   type="number"
                   min="0"
                   name="options[general][maxContainer]" value="<?php echo esc_attr($stream->options->general->maxContainer) ?>"/> px
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('action On Image Click', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description">
				<?php _e('choose action for click on post image', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="sfal-form-input">
                <select name="options[general][actionOnImageClick]">
                    <option value="1" disabled="disabled">detailed Popup with next/prev</option>
                    <option value="3" <?php selected(esc_attr($stream->options->general->actionOnImageClick) == '3') ?>>only show image on popup</option>
                    <option value="4" <?php selected(esc_attr($stream->options->general->actionOnImageClick) == '4') ?>>open link in new page</option>
                    <option value="0" <?php selected(esc_attr($stream->options->general->actionOnImageClick) == '0') ?>>nothing</option>
                </select>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Date Format', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description">
				<?php _e('format date for show on each post', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="sfal-form-input">
                <select name="options[general][dateFormat]">
                    <option value="short" <?php selected(esc_attr($stream->options->general->dateFormat) == 'short') ?> >Short</option>
                    <option value="classic" <?php selected(esc_attr($stream->options->general->dateFormat) == 'classic') ?> >Classic</option>
                    <option value="wordpress" <?php selected(esc_attr($stream->options->general->dateFormat) == 'wordpress') ?> >Wordpress</option>
                </select>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Feed Load With Animation', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description">
				<?php _e('are the feeds loaded with animation ?', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="sfal-form-input">
                <select name="options[general][feedLoadWithAnimation]">
                        <option <?php selected(esc_attr($stream->options->general->feedLoadWithAnimation) == 1) ?> value="1">On</option>
                        <option <?php selected(esc_attr($stream->options->general->feedLoadWithAnimation) == 0) ?> value="0">Off</option>
                </select>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Feed Loading Image', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description">
				<?php _e('loading image for each feed ( type feed loading image url )', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="sfal-form-input">
                <input type="text" name="options[general][loadingImage]" value="<?php echo esc_attr($stream->options->general->loadingImage) ?>"/>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('show Search Bar', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('show search bar on each feed top', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][showSearchBar]" type="checkbox" <?php checked($stream->options->general->showSearchBar == 1) ?>/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('private Stream', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('show only for logged in users !', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][privateStream]" <?php checked($stream->options->general->privateStream == 1) ?> type="checkbox"/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Hide stream on a desktop', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('If you want to create mobiles specific
				stream only.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][hideStreamOnDesktop]" <?php checked($stream->options->general->hideStreamOnDesktop == 1) ?>type="checkbox"/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Hide stream on a mobile device', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('If you want to show stream content only on
				desktops.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][hideStreamOnMobile]" <?php checked($stream->options->general->hideStreamOnMobile == 1) ?> type="checkbox"/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Show only media posts', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('Display posts with images/video only.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][showOnlyMediaPost]" <?php checked($stream->options->general->showOnlyMediaPost == 1) ?> type="checkbox"/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Titles link', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('Visit original post URL by clicking on
				post title, even if lightbox is enabled.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][titlesLink]" type="checkbox" <?php checked($stream->options->general->titlesLink == 1) ?>/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('open Links In New Tab', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('open link in new tab when click on titles
				link', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][openLinksInNewTab]" type="checkbox" <?php checked($stream->options->general->openLinksInNewTab == 1) ?>
                       checked="checked"/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Max image resolution', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('Use only for streams with large-sized
				posts. Not recommended for default stream design.', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][maxImageResolution]" type="checkbox" <?php checked($stream->options->general->maxImageResolution == 1) ?>/>
                <div class="state p-primary">
                    <label>ON</label>
                </div>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('Custom Css', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description">
				<?php _e('you can type here custom css for each stream', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="sfal-form-input">
                    <textarea class="sfal-custom-css-textarea" name="options[general][customCss]" cols="30" rows="10"><?php echo esc_textarea($stream->options->general->customCss) ?></textarea>
            </div>
        </div>

    </div>
</li>
