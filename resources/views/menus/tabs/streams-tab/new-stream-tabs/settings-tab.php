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
                <input type="radio" name="options[general][itemsOrder]" value="1" checked="checked">
                <div class="state p-primary-o">
                    <label>Publication date</label>
                </div>
            </div>
            <br><br>

            <div class="pretty p-default p-round">
                <input type="radio" name="options[general][itemsOrder]" value="2">
                <div class="state p-primary-o">
                    <label>source list position</label>
                </div>
            </div>
            <br><br>

            <div class="pretty p-default p-round">
                <input type="radio" name="options[general][itemsOrder]" value="3">
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
                   name="options[general][postCount]" value="12"/>
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
                   name="options[general][maxContainer]" value="0"/> px
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
                    <option value="1" disabled="disable">detailed Popup with next/prev</option>
                    <option value="3" selected="selected">only show image on popup</option>
                    <option value="4">open link in new page</option>
                    <option value="0">nothing</option>
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
                    <option value="short">Short</option>
                    <option value="classic">Classic</option>
                    <option value="wordpress">Wordpress</option>
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
                        <option value="1">On</option>
                        <option value="0">Off</option>
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
                <input type="text" name="options[general][loadingImage]"/>
            </div>
        </div>

        <div class="sfal-setting-row-header">
            <div class="sfal-setting-row-title"><?php _e('show Search Bar', 'wp-ss') ?></div>
            <div class="sfal-setting-row-description"><?php _e('show search bar on each feed top', 'wp-ss') ?>
            </div>
        </div>
        <div class="sfal-setting-row-content">
            <div class="pretty p-switch p-fill">
                <input name="options[general][showSearchBar]" type="checkbox" checked="checked"/>
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
                <input name="options[general][privateStream]" type="checkbox"/>
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
                <input name="options[general][hideStreamOnDesktop]" type="checkbox"/>
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
                <input name="options[general][hideStreamOnMobile]" type="checkbox"/>
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
                <input name="options[general][showOnlyMediaPost]" type="checkbox"/>
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
                <input name="options[general][titlesLink]" type="checkbox" checked="checked"/>
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
                <input name="options[general][openLinksInNewTab]" type="checkbox" checked="checked"/>
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
                <input name="options[general][maxImageResolution]" type="checkbox"/>
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
                <textarea class="sfal-custom-css-textarea" name="options[general][customCss]" cols="30" rows="10">/* note : prefix for prevent conflict ( #sfal-stream-<?php echo isset($afterAutoIncreament) ? esc_attr($afterAutoIncreament) : '1' ?> ) */
#sfal-stream-<?php echo isset($afterAutoIncreament) ? esc_attr($afterAutoIncreament) : '1' ?> {
    
}</textarea>
            </div>
        </div>

    </div>
</li>
