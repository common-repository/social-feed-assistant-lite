<table class="sfal-list-table">
    <thead>
    <tr>
        <th class="sfal-list-record-sort"><span><?php use SFAL\Core\Libs\Carbon\SfalCarbon;

_e('Name', 'wp-ss'); ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Social', 'wp-ss'); ?></span></th>
        <th class="sfal-list-record-sort"><span><?php _e('Last Updated', 'wp-ss'); ?></span></th>
        <th><span><?php _e('Actions', 'wp-ss'); ?></span></th>
    </tr>
    </thead>

    <tbody>
	<?php if (isset($accounts) && count($accounts) > 0) : ?>
		<?php foreach ($accounts as $account) : ?>
            <tr class="sfal-list-record">
                <td class="sfal-accounts-list-record-name"><a
                            data-endpoint="/accounts/edit/<?php echo esc_attr($account->id ?? null) ?>"><?php echo $account->title ?? __(
    'Unknown',
    'wp-ss'
) ?></a>
                </td>

                <td class="sfal-accounts-list-record-social"><span class="sfal-accounts-list-record-social-icon" aria-label="<?php echo esc_attr($account->social->title ?? null) ?>" data-cooltipz-dir="top"><i
                                class="<?php echo esc_attr($account->social->icon ?? null) ?> size-sm"></i></span></td>

                <td class="sfal-accounts-list-record-date"><?php echo esc_html(SfalCarbon::createFromFormat('Y-m-d H:i:s', $account->updated_at)
                                                                                        ->toDayDateTimeString() ?? null) ?></td>

                <td class="sfal-list-record-actions sfal-accounts-list-record-actions">
                    <a data-endpoint="/accounts/edit/<?php echo esc_attr($account->id ?? null) ?>" class="sfal-accounts-list-record-actions-edit"><i
                                class="lni-pencil"></i>
						<?php _e('Edit', 'wp-ss') ?></a>
                    <a class="sfal-accounts-list-record-actions-remove" data-account-id="<?php echo esc_attr($account->id ?? null) ?>"
                       data-remove-nonce="<?php echo wp_create_nonce('sfal_remove_account') ?>"><i class="lni-trash"></i> <?php _e('Remove', 'wp-ss') ?></a>
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