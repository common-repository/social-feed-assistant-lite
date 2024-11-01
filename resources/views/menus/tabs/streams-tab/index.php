<div class="sfal-tab-content-header">
    <span class="sfal-tab-content-title"><?php _e('Streams', 'wp-ss'); ?></span>
    <span class="sfal-tab-content-description"><?php _e('Create your Stream and use on frontend with special shortcode', 'wp-ss') ?></span>
    <a class="sfal-button sfal-button-blue sfal-tab-content-header-new" data-endpoint="/streams/new"> <i class="lni-plus"></i> <?php _e('New Stream', 'wp-ss') ?></a>
    <?php if(isset($streams, $feedsCount) && count($streams) <= 0 && $feedsCount <= 0) : ?>
      <div class="sfal-create-feed-help">
        <div class="sfal-alert sfal-alert-warning" role="alert">
          <?php _e('You have no feed or stream created!!! Please create a new feed by going to the', 'wp-ss') ?>
          <a class="sfal-alert-link going-feed-tab"><?php _e('feed tab', 'wp-ss') ?></a>.
        </div>
      </div>
    <?php endif; ?>
</div>
<div class="sfal-tab-content-main">
    <div class="sfal-list">
		<?php SfalViews('menus.tabs.streams-tab.table', compact('streams')) ?>
    </div>
</div>
