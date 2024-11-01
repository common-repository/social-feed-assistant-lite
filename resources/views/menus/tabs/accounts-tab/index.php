<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Accounts', 'wp-ss'); ?></span>
    <span class="sfal-tab-content-description"><?php _e('Create your social account and use on all modules on Social Assistant plugin', 'wp-ss'); ?></span>
    <a class="sfal-button sfal-button-blue sfal-tab-content-header-new" data-endpoint="/accounts/new"> <i class="lni-plus"></i> <?php _e('New Account', 'wp-ss') ?></a>
</div>
<div class="sfal-tab-content-main">
    <div class="sfal-list">
		<?php SfalViews('menus.tabs.accounts-tab.table', compact('accounts')) ?>
    </div>
</div>