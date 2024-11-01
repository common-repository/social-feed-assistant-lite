<table class="sfal-list-table">
    <thead>
    <tr>
        <th class="sfal-list-record-sort"><span><?php _e('Stream', 'wp-ss'); ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Layout', 'wp-ss'); ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Feeds', 'wp-ss'); ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Shortcode', 'wp-ss'); ?></span></th>
        <th><span><?php _e('Actions', 'wp-ss'); ?></span></th>
    </tr>
    </thead>

    <tbody>
	<?php if (isset($streams) && count($streams) > 0) : ?>
		<?php foreach ($streams as $stream) : ?>
            <tr class="sfal-list-record">
                <td class="sfal-streams-list-record-name"><a
                            data-endpoint="/streams/edit/<?php echo esc_attr($stream->id ?? null) ?>"><?php echo esc_html($stream->name ?? 'Untitled') ?></a>
                </td>

                <td class="sfal-streams-list-record-layout"><span
                            class="sfal-badge sfal-badge-secondary"><?php echo esc_html(ucfirst($stream->layout ?? 'Unknown')) ?></span></td>

                <td class="sfal-streams-list-record-feeds">
					<?php if ($stream->feeds) : ?>
						<?php foreach ($stream->feeds as $feed) : ?>
                            <span class="sfal-feeds-list-record-feeds-icons" aria-label="<?php echo esc_attr($feed->name) ?>" data-cooltipz-dir="top" >
                                <i class="<?php echo esc_attr($feed->social->icon ?? null) ?> size-sm"></i>
                            </span>
						<?php endforeach; ?>

					<?php endif; ?>
                </td>

                <td class="sfal-streams-list-record-shortcode">
                    <span class="sfal-streams-list-record-shortcode-text">[wp-sfstream id="<?php echo esc_html($stream->id) ?>"]</span>
                    <div class="sfal-streams-list-record-shortcode-copy-action">
                        <span class="sfal-streams-list-record-shortcode-copy-action-trigger" data-clipboard-text='[wp-sfstream id="<?php echo esc_html($stream->id) ?>"]'>
                            <span>Copy</span>
                        </span>
                    </div>
                </td>

                <td class="sfal-list-record-actions sfal-streams-list-record-actions">
                    <a data-endpoint="/streams/edit/<?php echo esc_attr($stream->id ?? null) ?>"

                       class="sfal-streams-list-record-actions-edit"><i
                                class="lni-pencil"></i>
						<?php echo __('Edit', 'wp-ss') ?></a>
                    <a class="sfal-streams-list-record-actions-remove" data-stream-id="<?php echo esc_attr($stream->id ?? null) ?>"
                       data-remove-nonce="<?php echo wp_create_nonce('sfal_remove_stream') ?>"><i
                                class="lni-trash"></i>
						<?php echo __('Remove', 'wp-ss') ?></a>
                </td>

            </tr>
		<?php endforeach; ?>
	<?php else : ?>
        <tr class="sfal-list-record sfal-txt-align-c">
            <td colspan="6"><?php _e('Row Not Exists !', 'sfal') ?></td>
        </tr>
	<?php endif; ?>
    </tbody>
</table>
