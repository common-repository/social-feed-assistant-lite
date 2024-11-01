<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Feeds', 'wp-ss'); ?></span>
    <span class="sfal-tab-content-description"><?php _e('Create your social feed and use on social widgets', 'wp-ss') ?></span>
    <a class="sfal-button sfal-button-blue sfal-tab-content-header-new" data-endpoint="/feeds/new"> <i class="lni-plus"></i> <?php _e('New Feed', 'wp-ss') ?></a>
</div>
<div class="sfal-tab-content-main">
    <div class="sfal-list">
		<?php SfalViews('menus.tabs.feeds-tab.table', compact('feeds')) ?>
    </div>
</div>