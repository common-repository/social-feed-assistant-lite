<li tab-content="sfal-create-stream-style-color-tab">

    <div class="sfal-setting-row sfal-card-styling-setting-row clearfix">

        <div class="sfal-tab-content-header">
            <span class="sfal-setting-row-title"><?php _e('Cards Styling', 'wp-ss') ?></span>
            <span class="sfal-setting-row-description"><?php _e('here you can set styling settings for cards', 'wp-ss') ?></span>
        </div>

        <div class="sfal-tab-content-main clearfix">

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Avatar STYLE', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('avatar shape style.', 'wp-ss') ?></div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <select name="options[general][style][avatarShape]">
                        <option value="round" <?php selected(esc_attr($stream->options->general->style->avatarShape) == 'round') ?>>Rounded</option>
                        <option value="plain" <?php selected(esc_attr($stream->options->general->style->avatarShape) == 'plain') ?>>Plain</option>
                    </select>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Card Courner', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('card box corners.', 'wp-ss') ?></div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <select name="options[general][style][cardCourner]">
                        <option value="round" <?php selected(esc_attr($stream->options->general->style->cardCourner) == 'round') ?>>Rounded</option>
                        <option value="plain" <?php selected(esc_attr($stream->options->general->style->cardCourner) == 'plain') ?>>Plain</option>
                    </select>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Social icon style', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('Common setting for social icon style', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <select name="options[general][style][socialIconStyle]">
                        <option value="corner" <?php selected(esc_attr($stream->options->general->style->socialIconStyle) == 'corner') ?>>Corner Icon
                        </option>
                        <option value="label" <?php selected(esc_attr($stream->options->general->style->socialIconStyle) == 'label') ?>>Label</option>
                        <option value="timestamp" <?php selected(esc_attr($stream->options->general->style->socialIconStyle) == 'timestamp') ?>>Timestamp
                        </option>
                        <option value="none" <?php selected(esc_attr($stream->options->general->style->socialIconStyle) == 'none') ?>>Off</option>
                    </select>
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Text alignment', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('Common setting for card text alignment', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <select name="options[general][style][textAlignment]">
                        <option value="left" <?php selected(esc_attr($stream->options->general->style->textAlignment) == 'left') ?>>Left
                        </option>
                        <option value="center" <?php selected(esc_attr($stream->options->general->style->textAlignment) == 'center') ?>>Centered
                        </option>
                        <option value="right" <?php selected(esc_attr($stream->options->general->style->textAlignment) == 'right') ?>>Right
                        </option>
                    </select>
                </div>
            </div>

        </div>

    </div>

    <div class="sfal-setting-row sfal-display-elements-setting-row clearfix">

        <div class="sfal-setting-row-column">

            <div class="sfal-tab-content-header">
                <span class="sfal-setting-row-title"><?php _e('Display post elements', 'wp-ss') ?></span>
                <span class="sfal-setting-row-description"><?php _e('here you can set what elements will be show on each post.', 'wp-ss') ?></span>
            </div>

            <div class="sfal-tab-content-main clearfix">

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Avatar', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post avatar', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][avatar]"
                                   <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->avatar) == 1) ?> />
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('User', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post user', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][user]"
								<?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->user) == 1) ?> />
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Date', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show date post', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][date]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->date) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Post Link', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post link', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][postLink]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->postLink) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Like Count', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post like count', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][likeCount]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->likeCount) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Comment Count', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post comments count', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][commentCount]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->commentCount) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('Share', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post share link', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][share]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->share) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sfal-setting-row-multi-column">
                    <div class="sfal-setting-row-header">
                        <div class="sfal-setting-row-title"><?php _e('text', 'wp-ss') ?></div>
                        <div class="sfal-setting-row-description"><?php _e('show post text', 'wp-ss') ?>
                        </div>
                    </div>
                    <div class="sfal-setting-row-content">
                        <div class="pretty p-switch p-fill">
                            <input type="checkbox"
                                   name="options[general][postSettings][displayPostElements][text]" <?php checked(esc_attr($stream->options->general->postSettings->displayPostElements->text) == 1) ?>/>
                            <div class="state p-primary">
                                <label>ON</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="sfal-setting-row sfal-posts-colors-setting-row clearfix">

        <div class="sfal-tab-content-header">
            <span class="sfal-setting-row-title"><?php _e('Post Colors', 'wp-ss') ?></span>
            <span class="sfal-setting-row-description"><?php _e('here you can colors settings for posts', 'wp-ss') ?></span>
        </div>

        <div class="sfal-tab-content-main clearfix">

            <div class="sfal-posts-colors-classic-section clearfix">
                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Classic Template Link', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set classic template post link color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker"
                            value="<?php echo esc_attr($stream->options->general->color->post->classic->link) ?>"
                            name="options[general][color][post][classic][link]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Classic Template Text', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set classic template post text color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->classic->text) ?>"
                            name="options[general][color][post][classic][text]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Classic Template Background', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set classic template post background
                        color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->classic->background) ?>"
                            name="options[general][color][post][classic][background]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Classic Template Border', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set classic template box border
                        color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->classic->border) ?>"
                            name="options[general][color][post][classic][border]">
                    </div>
                </div>
            </div>

            <div class="sfal-posts-colors-tile-section clearfix">
                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Tile Template Overlay', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set tile template post overlay color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->tile->overlay) ?>"
                            name="options[general][color][post][tile][overlay]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Tile Template Text', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set tile template post text color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->tile->text) ?>"
                            name="options[general][color][post][tile][text]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('Tile Template Link', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set tile template post link color', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->tile->link) ?>"
                            name="options[general][color][post][tile][link]">
                    </div>
                </div>
            </div>

            <div class="sfal-posts-colors-general-section clearfix">

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('ACCENT COLOR', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('Applies to post heading.', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->heading) ?>"
                            name="options[general][color][post][heading]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('SECONDARY COLOR', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('Applies to timestamp and social counters.', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->secondary) ?>"
                            name="options[general][color][post][secondary]">
                    </div>
                </div>

                <div class="sfal-setting-row-header">
                    <div class="sfal-setting-row-title"><?php _e('card shadow', 'wp-ss') ?></div>
                    <div class="sfal-setting-row-description"><?php _e('set card post box shadow', 'wp-ss') ?>
                    </div>
                </div>
                <div class="sfal-setting-row-content">
                    <div class="sfal-form-input">
                        <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->post->shadow) ?>"
                            name="options[general][color][post][shadow]">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="sfal-setting-row sfal-grid-colors-setting-row clearfix sfal-border-btm-none">

        <div class="sfal-tab-content-header">
            <span class="sfal-setting-row-title"><?php _e('Button Colors', 'wp-ss') ?></span>
            <span class="sfal-setting-row-description"><?php _e('here you can set colors settings for grid', 'wp-ss') ?></span>
        </div>

        <div class="sfal-tab-content-main clearfix">

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Button Color', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('set button text color', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->grid->buttonColor) ?>"

                           name="options[general][color][grid][buttonColor]">
                </div>
            </div>

            <div class="sfal-setting-row-header">
                <div class="sfal-setting-row-title"><?php _e('Button Background', 'wp-ss') ?></div>
                <div class="sfal-setting-row-description"><?php _e('set button background color', 'wp-ss') ?>
                </div>
            </div>
            <div class="sfal-setting-row-content">
                <div class="sfal-form-input">
                    <input type="text" class="sfal-color-picker" value="<?php echo esc_attr($stream->options->general->color->grid->buttonBG) ?>"

                           name="options[general][color][grid][buttonBG]">
                </div>
            </div>

        </div>

    </div>

    <br><br><br><br><br><br><br>
</li>
