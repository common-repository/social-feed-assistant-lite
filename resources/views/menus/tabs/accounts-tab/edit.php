<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Update Account', 'wp-ss'); ?></span>
    <span class="sfal-tab-content-description"><?php _e('Update your social account and use on all modules on Social Assistant plugin', 'wp-ss') ?></span>
    <a class="sfal-back-page" sfal-get-back><i class="lni-arrow-left"></i>
		<?php _e('ACCOUNT LIST', 'wp-ss') ?></a>
</div>
<?php if (isset($account)) : ?>
    <div class="sfal-tab-content-main">
        <form class="sfal-create-account-form" method="get" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>">
            <div class="sfal-create-account-form-content sfal-form-content clearfix">
                <div class="sfal-form-input" style="visibility: hidden">
                    <input type="hidden" name="action" value="sfal_update_account"/>
                </div>
                <div class="sfal-form-input" style="visibility: hidden">
                    <input type="hidden" name="account-id" , value="<?php echo esc_attr($account->id) ?>">
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Account
                    Name', 'wp-ss') ?>
                    </div>
                    <div class="sfal-setting-row-description"><?php _e('select a name for this account', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input id="sfal-create-account-name-input" name="account-name" type="text"
                               placeholder="<?php _e('Choose a name', 'wp-ss') ?>" value="<?php echo esc_attr($account->title) ?>"/></div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Account
                    Type', 'wp-ss') ?>
                    </div>
                    <div class="sfal-setting-row-description"><?php _e('select account type', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <select id="sfal-create-account-type-select" name="account-type">
							<?php if (isset($socials)) : ?>
								<?php foreach ($socials as $social) : ?>
                                    <option value="<?php echo esc_attr($social->id) ?>"
                                            id="sfal-create-account-type-option-<?php echo esc_attr($social->id) ?>" <?php selected($account->social->id == $social->id) ?>><?php echo esc_html($social->title) ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="sfal-instagram-account-settings">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Instagram login', 'sfal') ?>
                        </div>
                        <div class="sfal-setting-row-description"><?php _e('type instagram login username', 'sfal') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="sfal-form-input">
                            <input class="sfal-create-account-auth-settings" name="auth-settings[instagram][username]" type="text"
                                placeholder="<?php _e('ENTER Username', 'sfal') ?>" value="<?php echo esc_attr($account->options['instagram']['username'] ?? null) ?>"/>
                        </div>
                    </div>
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Instagram password', 'sfal') ?>
                        </div>
                        <div class="sfal-setting-row-description"><?php _e('type instagram login password', 'sfal') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="sfal-form-input">
                            <input class="sfal-create-account-auth-settings" name="auth-settings[instagram][password]" type="password"
                                placeholder="<?php _e('ENTER Password', 'sfal') ?>" value="<?php echo esc_attr($account->options['instagram']['password'] ?? null) ?>"/>
                        </div>
                    </div>
                </div>

				<?php wp_nonce_field('sfal-update-account', 'update-account-nonce'); ?>
            </div>
            <div class="sfal-create-account-form-footer sfal-form-footer">
                <button type="submit" class="sfal-button sfal-button-blue"><?php _e('SAVE ACCOUNT', 'wp-ss') ?></button>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
<?php else : ?>
<?php endif; ?>