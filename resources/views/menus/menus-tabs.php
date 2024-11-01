<div id="sfal-main">
    <div id="sfal-header">
        <div class="sfal-plugin-title">
            <span class="sfal-plugin-name">
                <?php if(isset($icon) && !empty($icon)) : ?>
                    <?php if($icon['type'] == 'image'): ?>
                        <img class="sfal-plugin-name-icon" src="<?php echo esc_url($icon['url']) ?>" />
                    <?php else : ?>
                        <i class="lni lni-<?php echo esc_attr($icon['lni']) ?>"></i>
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo $title ?>
            </span>
            <span class="sfal-plugin-description"><?php echo $description ?></span>
        </div>
        <div class="sfal-plugin-help">
            <span>
                <a href="https://ithemelandco.com/Plugins/Documentations/Social-Feed-Assistant/Documentation.pdf" target="_blank"><?php _e('Need Help', 'wp-ss') ?> <i class="lni-help"></i></a>
            </span>
        </div>
    </div>
    <div id="sfal-body">
        <div class="sfal-tabs">
            <div class="sfal-tabs-navigation">
                <nav class="sfal-tabs-navbar">
                    <ul class="sfal-tabs-list" nav-tab="sfal-main-tabs">
						<?php foreach ($tabs as $tab) : ?>
                            <li>
                                <a class="<?php echo $tab::isDefault() ? esc_attr('selected') : null ?>" tab-content="<?php echo esc_attr($tab::getID()) ?>"
                                   href="#"><?php echo esc_html($tab::getLabel()) ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </nav>
            </div>
            <div class="sfal-tabs-content">
                <ul class="sfal-tabs-list-content" nav-tab-content="sfal-main-tabs">
					<?php foreach ($tabs as $tab) : ?>
                        <li class="<?php echo $tab::isDefault() ? esc_attr('selected') : null ?>" tab-content="<?php echo esc_attr($tab::getID()) ?>">
							<?php $tab::index() ?>
                        </li>
					<?php endforeach; ?>
                </ul>
				<?php SfalViews('menus.loader') ?>
            </div>
        </div>
    </div>
</div>
