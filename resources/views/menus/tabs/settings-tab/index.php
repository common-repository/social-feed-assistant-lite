<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Settings', 'wp-ss'); ?></span>
    <span class="sfal-tab-content-description"><?php _e('Set your common and general settings for all streams', 'wp-ss'); ?></span>
</div>
<div class="sfal-tab-content-main clearfix">
    <form class="sfal-general-settings-form" method="get" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
        <div class="sfal-general-settings-form-content sfal-form-content clearfix">
            <div class="sfal-form-input" style="visibility: hidden">
                <input type="hidden" name="action" value="sfal_update_general_settings"/>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Share Button Socials') ?></div>
                <div class="sfal-setting-row-description"><?php _e('Check socials for show on stream share buttons.') ?></div>
            </div>
            <div class="sfal-setting-row-content sfal-share-button-settings-row-content">
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="twitter" <?php checked(in_array('twitter', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-primary">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Twitter</label>
                    </div>
                </div>
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="facebook" <?php checked(in_array('facebook', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-primary">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Facebook</label>
                    </div>
                </div>
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="linkedin" <?php checked(in_array('linkedin', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-primary">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Linkedin</label>
                    </div>
                </div>
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="google-plus" <?php checked(in_array('google-plus', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-danger">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Google+</label>
                    </div>
                </div>
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="pinterest" <?php checked(in_array('pinterest', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-danger">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Pinterest</label>
                    </div>
                </div>
                <div class="pretty p-svg p-curve">
                    <input type="checkbox" name="share-buttons[]" value="mail" <?php checked(in_array('mail', $options['shareButtons'] ?? [])) ?> />
                    <div class="state p-warning">
                        <!-- svg path -->
                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                        </svg>
                        <label>Mail</label>
                    </div>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('delete all data when plugin uninstall.', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('Check if you want erase all data that created plugin.', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="pretty p-switch p-fill">
                <input type="checkbox" name="erase-data" <?php checked($options['eraseData'] == 1) ?> />
                    <div class="state p-primary">
                        <label>ON</label>
                    </div>
                </div>
            </div>

                <?php wp_nonce_field('sfal-save-general-settings', 'save-general-settings-nonce'); ?>
            </div>
            <div class="sfal-general-settings-form-footer sfal-form-footer">
                <button type="submit" class="sfal-button sfal-button-blue"><?php _e('SAVE SETTINGS', 'wp-ss') ?></button>
                <div class="clearfix"></div>
        </div>
    </form>
</div>
