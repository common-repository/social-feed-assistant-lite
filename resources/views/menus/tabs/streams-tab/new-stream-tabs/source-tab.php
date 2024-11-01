<li class="selected" tab-content="sfal-create-stream-source-tab">
    <div class="sfal-tab-content-header">
        <span class="sfal-create-stream-tab-content-title"><?php _e('Connected Feeds', 'wp-ss') ?></span>
        <span class="sfal-create-stream-tab-content-description"><?php _e(
    'Here you can connect feeds created on Feeds tab. To detach feed click feed label.',
    'wp-ss'
) ?></span>
    </div>
    <div class="sfal-tab-content-main">
        <div class="sfal-form-input">

            <label class="sfal-create-stream-sources-input-label"
                   for="sfal-create-stream-sources-input"><?php _e('Select Sources', 'wp-ss') ?></label>


            <select id="sfal-create-stream-sources-input">

                <option selected="selected" disabled="disabled"><?php _e('Select a feed sources...', 'wp-ss') ?></option>

				<?php if (isset($feeds) && count($feeds) > 0) : ?>

					<?php foreach ($feeds as $feed) : ?>

                        <option data-name="<?php echo esc_attr($feed->name) ?>" data-social="<?php echo esc_attr($feed->social_type) ?>" data-social-icon="<?php echo esc_attr($feed->social->icon) ?>" value="<?php echo esc_attr($feed->id) ?>" data-multi-content='<?php echo json_encode( $feed->contents ) ?>'>
								<?php printf("%s - %s - %s", ucfirst(esc_html($feed->social->title)), esc_html($feed->name), esc_html($feed->id)) ?>
                        </option>

					<?php endforeach; ?>

				<?php endif; ?>

            </select>

            <span class="sfal-create-stream-sources-ok-btn"><i class="lni-chevron-down"></i></span>
            <span class="sfal-create-stream-sources-close-btn"><i class="lni-close"></i></span>

            <div class="sfal-create-stream-selected-source"></div>

        </div>

        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
    </div>
</li>
