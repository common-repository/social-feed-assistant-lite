<li tab-content="sfal-create-stream-shortcode-tab">

    <div class="sfal-tab-content-header">
        <span class="sfal-create-stream-tab-content-title"><?php _e('Stream shortcode', 'wp-ss') ?></span>
        <span class="sfal-create-stream-tab-content-description"><?php _e('Place this shortcode anywhere on your site.', 'wp-ss') ?></span>
    </div>

    <div class="sfal-tab-content-main">

        <div class="sfal-create-stream-shortcode">
            <span class="sfal-create-stream-shortcode-copy-trigger" data-clipboard-text='[wp-sfstream id="<?php echo isset($stream->id) ? esc_attr($stream->id) : 'Unknown' ?>"]'>
                <span class="sfal-create-stream-shortcode-copy-status">Click to copy</span>
                <span class="sfal-create-stream-shortcode-value">[wp-sfstream id="<?php echo isset($stream->id) ? esc_attr($stream->id) : 'Unknown' ?>"]</span>
            </span>
        </div>

    </div>

    <br><br><br><br><br><br><br>
</li>