<?php use SFAL\Core\Libs\Carbon\SfalCarbon; ?>

<table class="sfal-list-table">
    <thead>
    <tr>
        <th class="sfal-list-record-sort"><span><?php _e('Name', 'wp-ss') ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Content', 'wp-ss') ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Social', 'wp-ss') ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Type', 'wp-ss') ?></span></th>
        <th><span><?php _e('Actions', 'wp-ss') ?></span></th>
    </tr>
    </thead>

    <tbody>
	<?php if (isset($feeds) && count($feeds) > 0) : ?>
		<?php foreach ($feeds as $feed) : ?>
            <tr class="sfal-list-record">

                <td class="sfal-feeds-list-record-name"><a data-endpoint="/feeds/edit/<?php echo esc_attr($feed->id) ?>"><?php echo esc_html($feed->name ?? null) ?></a></td>

                <td class="sfal-feeds-list-record-content"><?php echo esc_html(implode(" , ", $feed->contentNames)) ?></td>

                <td class="sfal-feeds-list-record-social"><span class="sfal-feeds-list-record-social-icon" aria-label="<?php echo esc_attr($feed->social->title ?? null) ?>" data-cooltipz-dir="top"><i
                                class="<?php echo esc_attr($feed->social->icon ?? null) ?> size-sm"></i></span></td>

                <td class="sfal-feeds-list-record-type"><?php echo esc_html($feed->type ?? 'Unknown') ?></td>

                <td class="sfal-list-record-actions sfal-feeds-list-record-actions">
                    <a data-endpoint="/feeds/edit/<?php echo esc_attr($feed->id ?? null) ?>" class="sfal-feeds-list-record-actions-edit"><i
                                class="lni-pencil"></i>
						<?php _e('Edit', 'wp-ss'); ?></a>
                    <a class="sfal-feeds-list-record-actions-remove" data-feed-id="<?php echo esc_attr($feed->id ?? null) ?>"
                       data-remove-nonce="<?php echo wp_create_nonce('sfal-remove-feed') ?>"><i class="lni-trash"></i>
						<?php _e('Remove', 'wp-ss'); ?></a>
                    <a class="sfal-feeds-list-record-actions-rebuild" data-feed-id="<?php echo esc_attr($feed->id ?? null) ?>"
                       data-rebuild-nonce="<?php echo wp_create_nonce('sfal-rebuild-feed') ?>"><i class='lni lni-reload'></i>
						<?php _e('Rebuild Cache', 'wp-ss'); ?></a>
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