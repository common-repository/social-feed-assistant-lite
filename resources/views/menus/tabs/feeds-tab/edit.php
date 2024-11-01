<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Update Feed', 'wp-ss') ?></span>
    <span class="sfal-tab-content-description"><?php _e('Update exist feed and use on stream widgets', 'wp-ss') ?></span>
    <a class="sfal-back-page" sfal-get-back><i class="lni-arrow-left"></i>
		<?php _e('Feeds List', 'wp-ss') ?></a>
</div>
<div class="sfal-tab-content-main">
    <form class="sfal-update-feed-form" method="get" action="<?php echo esc_url(admin_url('admin-ajax.php')) ?>" data-feed='<?php echo json_encode([
        'contents' => $feed->contents,
        'includes' => esc_attr($feed->includes) ?? '',
        'excludes' => esc_attr($feed->excludes) ?? '',
    ]) ?>'>
        <div class="sfal-update-feed-form-content sfal-form-content clearfix">
            <div class="sfal-form-input sfal-visible-hidden">
                <input type="hidden" name="action" value="sfal_update_feed"/>
            </div>
            <div class="sfal-form-input" style="visibility: hidden">
                <input type="hidden" name="feed-id" value="<?php echo esc_attr($feed->id ?? null) ?>">
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Title', 'wp-ss'); ?></div>
                <div class="sfal-setting-row-description"><?php _e('Set your title for feed', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <input type="text" name="name" placeholder="<?php _e('Choose a name', 'wp-ss') ?>" value="<?php echo esc_attr($feed->name ?? 'Untitled') ?>"/>
                </div>
            </div>
            <?php if(isset($socials) && count($socials) > 0) : ?>
                <?php if (count($socials) > 1) : ?>
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Social Type', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('please select social type for this feed', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <?php foreach ($socials as $social) : ?>
                            <div class="pretty p-default p-round">
                                <input name="social-type" class="sfal-create-feed-stype-input" type="radio"
                                    value="<?php echo esc_attr($social->id) ?>" <?php checked($feed->social_type == $social->id) ?>>
                                <div class="state p-primary-o">
                                    <label><?php echo esc_attr(ucfirst($social->title)) ?></label>
                                </div>
                            </div>
                            <br><br>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <input name="social-type" class="sfal-create-feed-stype-input" type="hidden" value="<?php echo esc_attr(reset($socials)->id) ?>">
                <?php endif; ?>
            <?php endif; ?>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Feed Type', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('here you should select this feed posts type', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="pretty p-default p-round">
                    <input name="feed-type" class="sfal-create-feed-ftype-input" type="radio"
                           value="username" <?php checked($feed->type == 'username') ?>>
                    <div class="state p-primary-o">
                        <label><?php _e('Username', 'wp-ss') ?></label>
                    </div>
                </div>
                <div class="pretty p-svg p-plain p-toggle sfal-premium-feature-lock">
                    <input class="sfal-create-feed-ftype-input" type="radio" disabled="disabled" />
                    <div class="state">
                        <img class="svg" src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/svg/lock-alt.svg') ?>">
                        <label><?php _e('Location', 'wp-ss') ?></label>
                    </div>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-centerize">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </div>
                <div class="pretty p-svg p-plain p-toggle sfal-premium-feature-lock">
                    <input class="sfal-create-feed-ftype-input" type="radio" disabled="disabled" />
                    <div class="state">
                        <img class="svg" src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/svg/lock-alt.svg') ?>">
                        <label><?php _e('Hashtag', 'wp-ss') ?></label>
                    </div>
                    <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-centerize">
                        <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                        <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                        <br>
                        <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                    </div>
                </div>
            </div>

            <?php if (isset($accounts) && count($accounts) > 0) : ?>
                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Account', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('here you should select account for used in this social', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <select name="account" id="sfal-create-feed-account-input">
                                <?php foreach ($accounts as $account) : ?>
                                    <option data-social="<?php echo esc_attr($account->social_type) ?>"
                                            value="<?php echo esc_attr($account->id) ?>"
                                            id="sfal-create-feed-account-option-<?php echo esc_attr($account->id) ?>"
                                            <?php selected($feed->account_id == $account->id) ?>>
                                            <?php echo esc_html($account->title) ?>
                                    </option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Content', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description">natgeo (username), programming (tag), 44961364 (location id)</div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <input disabled type="text" name="contents" placeholder="<?php _e('Type And Hit Enter', 'sfal') ?>"/>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title">
                    <img class="svg sfal-premium-feature-lock-icon" src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/svg/lock-alt.svg') ?>">
                    <?php _e('Exclude All', 'wp-ss') ?>
                </div>
                <div class="sfal-setting-row-description">@username, #tag, !strtourl, word</div>
            </div>
            <div class="sfal-setting-row-content sfal-premium-feature-lock">
                <div class="sfal-form-input">
                    <input disabled="disabled" id="sfal-create-feed-excludes-input" type="text"
                           placeholder="<?php _e('Type And Hit Enter', 'wp-ss') ?>"/>
                </div>
                <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-centerize">
                    <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                    <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                    <br>
                    <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title">
                    <img class="svg sfal-premium-feature-lock-icon" src="<?php echo esc_url(SfalConfig('app.assetsUrl') . 'img/svg/lock-alt.svg') ?>">
                    <?php _e('Include All', 'wp-ss') ?>
                </div>
                <div class="sfal-setting-row-description">@username, #tag, !strtourl, word</div>
            </div>
            <div class="sfal-setting-row-content sfal-premium-feature-lock">
                <div class="sfal-form-input">
                    <input disabled="disabled" id="sfal-create-feed-includes-input" type="text"
                           placeholder="<?php _e('Type And Hit Enter', 'wp-ss'); ?>"/>
                </div>
                <div class="sfal-premium-feature-tooltip sfal-premium-feature-tooltip-centerize">
                    <h2 class="sfal-premium-feature-tooltip-title">PREMIUM FEATURE</h2>
                    <span class="sfal-premium-feature-tooltip-desc">To get access to this and many other premium features please upgrade to PRO version.</span>
                    <br>
                    <a class="sfal-premium-feature-tooltip-upgrade-btn" href="https://www.google.com">UPGRADE NOW</a>
                </div>
            </div>

			<?php wp_nonce_field('sfal-update-feed', 'update-feed-nonce'); ?>
        </div>
        <div class="sfal-update-feed-form-footer sfal-form-footer">
            <button type="submit" class="sfal-button sfal-button-blue"><?php _e('SAVE FEED', 'wp-ss') ?></button>
            <div class="clearfix"></div>
        </div>
    </form>
</div>
