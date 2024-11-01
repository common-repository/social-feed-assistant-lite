<?php defined('ABSPATH') || exit('no access') ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main {
    width: 100%;
    height: auto;
    margin: 20px auto;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-wall-feed-box .swiper-container {
    margin-top: 0;
    width: 100%;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-wall-feed-box .swiper-container [data-media="mute-unmute"] {
    right: 0;
    left: 20px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main a {
  text-decoration : none;
  border-bottom: none;
  box-shadow: none;
  outline: none;
  color: inherit;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main a img {
  box-shadow: none;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box {
    box-sizing: border-box;
    <?php if ($options->general->postSettings->layout == 'wall') : ?>
        width: <?php echo $options->wall->width ?>px;
        padding-right: <?php echo $options->wall->horizontalMargin / 2 ?>px;
        padding-left: <?php echo $options->wall->horizontalMargin / 2 ?>px;
        margin-bottom: <?php echo $options->wall->verticalMargin ?>px;
    <?php endif; ?>
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-container {
    border-radius: <?php echo ($options->general->style->cardCourner == 'round') ? '10px' : 0 ?>;
    border: 1px solid <?php echo $options->general->color->post->classic->border ?>;
    background: <?php echo $options->general->color->post->classic->background ?>;
    box-shadow: 0 0 13px 0 <?php echo $options->general->color->post->shadow ?>;
    overflow: hidden;
    height: 100%;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-header {
    display: inline-block;
    position: relative;
    width: 100%;
    padding: 20px 0 25px 0;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-header-img {
    float: left;
    margin: 1px 10px 0 18px;
    position: relative;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-header-img img {
    max-width: 40px;
    max-height: 40px;
    <?php echo ($options->general->style->avatarShape == 'round') ? "border-radius : 50% \n" : null; ?>
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-header-meta {
    line-height: 18px;
    padding-left: 20px;
    padding-top: 5px;
}

<?php if ($options->general->style->socialIconStyle == 'corner') : ?>
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-icon {
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 65px 65px 0;
    border-color: transparent #405de6 transparent transparent;
    position: absolute;
    top: 0;
    right: 0;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-icon span {
    color: #fff;
    font-size: 18px;
    position: absolute;
    right: -56px;
    top: 8px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-icon span i,
.wpsf-tile-feed-box-social-icon span i {
}
<?php endif; ?>

<?php if ($options->general->style->socialIconStyle == 'timestamp') : ?>
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-timestamp-icon {
    position: absolute;
    bottom: -3px;
    left: 26px;
    width: 20px;
    height: 20px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-timestamp-icon > span {
    background: #405de6;
    color: #fff;
    padding: 2px 5px 0px 5px;
    font-size: 11px;
    border-radius: 50%;
    font-weight: bold;
    text-align: center;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-timestamp-icon > span > i {
  font-weight: bold;
}
<?php endif; ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-title {
    display: block;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-title {
    font-size: 16px;
    font-weight: 600;
    color: <?php echo $options->general->color->post->heading ?>;
}

<?php if (! (bool) $options->general->postSettings->displayPostElements->user) : ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-url {
    display: none;
}

<?php endif; ?>

<?php if (! (bool) $options->general->postSettings->displayPostElements->date) : ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-date {
    display: none;
}

<?php endif; ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-url,
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-date {
    font-size: 12px;
    color: <?php echo $options->general->color->post->secondary ?>;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main span.wpsf-classic-feed-account-url {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    text-overflow: ellipsis;
    max-width: 90px;
    vertical-align: -4px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-account-date.wpsf-date-wordpress-format {
    font-size: 9px !important;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content {
    position: relative;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-media-wrapper {
    width: 100%;
    cursor: <?php echo $options->general->actionOnImageClick != '0' ? 'pointer' : 'default'  ?>;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-type {
  position: absolute;
  top: 23px;
  right: 23px;
  z-index: 2;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-sidecar-type {
  width: 23px;
  height: 23px;
  border-radius: 5px;
  background-color: #ffffff;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-sidecar-type::after {
  content: "";
  position: absolute;
  top: -4px;
  right: -4px;
  width: 23px;
  height: 23px;
  border-radius: 5px;
  background-color: #ffffff;
  filter: drop-shadow(0 0 3.5px rgba(0, 0, 0, 0.18));
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-video-type {
  background: #fff;
  border-radius: 5px;
  padding: 2px 5px 0 7px;
  filter: drop-shadow(0 0 3.5px
  rgba(0, 0, 0, 0.2));
  font-size: 15px;
  color: #898989;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-img,
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-media-wrapper {
    width: 100%;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-media-wrapper .wpsf-classic-feed-box-content-img img.wpsf-lazy-img-loading,
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-media-wrapper .wpsf-classic-feed-box-content-img div.wpsf-lazy-img-loading {
    background-color: #000;
    background-image: url(<?php echo $assetsUrl ?>/img/user/oval.svg);
    background-size: initial;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-video,
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-video video {
    width: 100%;
    height: 100%;
    line-height: 0;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-video {
    background-color: #000;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-img img.wpsf-lazy-img
{
    width: 100%;
    object-fit: cover;
    background-repeat: no-repeat;
    background-position: 50% 50%;
    background-size: cover;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-img div.wpsf-lazy-img
{
    min-width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 400px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-text {
    <?php echo (! (bool) $options->general->postSettings->displayPostElements->text) ? "display : none \n" : null . "\n"; ?>
    text-align : <?php echo $options->general->style->textAlignment; ?>;
    color: <?php echo $options->general->color->post->classic->text ?>;
    line-height: 20px;
    font-size: 13px;
    padding: 0 20px 21px 20px;
    overflow: hidden;
    overflow-wrap: break-word;
    box-sizing: content-box;
    <?php if($options->general->postSettings->layout == "grid") : ?>
        height: 100px;
    <?php endif; ?>
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-content-text a {
    color: <?php echo $options->general->color->post->classic->link ?> !important;
    text-decoration: none !important;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-footer {
    padding: 15px 20px 20px 20px;
    border-top: 1px solid #e9e9e9;
    color: <?php echo $options->general->color->post->secondary ?>;
    font-size: 13px;
    font-weight: 600;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-meta {
    padding: 18px 20px 20px 20px;
    color: <?php echo $options->general->color->post->secondary ?>;
    font-size: 13px;
    font-weight: 600;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-like-counter-meta i,
#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comment-counter-meta i {
    padding-right: 1px;
    vertical-align: -2px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-like-counter-meta {
    margin-right: 27px;
    <?php echo (! (bool) $options->general->postSettings->displayPostElements->likeCount) ? "display : none \n" : null; ?>
}

<?php if (! (bool) $options->general->postSettings->displayPostElements->commentCount) : ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comment-counter-meta {
    display: none;
}

<?php endif; ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta {
    float: right;
    padding-right: 15px;
    cursor: pointer;
    position: relative;
    z-index: 2;
    <?php echo (! (bool) $options->general->postSettings->displayPostElements->share) ? "display : none \n" : null; ?>
}


#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta-links {
    position: absolute;
    bottom: 30px;
    border-radius: 5px;
    background-color: #ffffff;
    right: -8px;
    padding: 9px 8px;
    filter: drop-shadow(0 0 4px rgba(0, 0, 0, 0.27));
    transition: all 0.2s ease-in;
    opacity: 0;
    z-index: 10;
    visibility: hidden;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta-links.show-share-links {
    opacity: 1;
    visibility: visible;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta-links a {
    color: #666;
    color: #9c9b9b;
    padding: 4px 0;
    display: block;
    text-decoration: none !important;
    outline: none !important;
    box-shadow: none;
    font-size: 11px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta-links a i {
    font-size: 13px;
    vertical-align: -1px;
    margin-right: 5px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-share-meta-links::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 65%;
    width: 0;
    height: 0;
    border: 7px solid #0000;
    border-top-color: #fff;
    border-bottom: 0;
    margin-left: -7px;
    margin-bottom: -6px;
}

<?php if ($options->general->style->socialIconStyle == 'label') : ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-social-title {
    top: 15px;
    left: 15px;
    position: absolute;
    color: #fff;
    background: #405de6;
    padding: 6px 15px 7px 15px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    z-index: 2;
    line-height: 1;
}

<?php endif; ?>

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments {
    font-size: 15px;
    position: relative;
    white-space: initial;
    background: <?php echo $options->general->color->post->comments->background ?>;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-container {
    padding: 25px 35px;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-list .wpsf-classic-feed-box-slide-comment {
    padding: 0 0 10px 0;
    line-height: 1.8;
    color: <?php echo $options->general->color->post->comments->text ?>;
    opacity: 1;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-list .wpsf-classic-feed-box-slide-comment a{
    color: <?php echo $options->general->color->post->comments->text ?>;
    font-weight: bold;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-list .wpsf-classic-feed-box-slide-comment a.wpsf-classic-feed-box-slide-comment-username {
    margin: 0 5px 0 0;
    color: <?php echo $options->general->color->post->comments->text ?>;
    font-weight: bold;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-list .wpsf-classic-feed-box-slide-comment a.wpsf-clasic-feed-box-view-all-comments-slide {
    font-weight: bold;
    color: <?php echo $options->general->color->post->comments->text ?>;
}

#wpsf-stream-<?php echo $streamID ?> .wpsf-classic-feeds-main .wpsf-classic-feed-box-comments .wpsf-classic-feed-box-comments-list .wpsf-classic-feed-box-comment-not-exist > a {
    font-weight: 600;
    color: <?php echo $options->general->color->post->comments->text ?>;
    margin-left: 5px;
}


/** Responsive */

.wpsf-classic-grid-feed-box {
    min-height: 1px;
    padding-right: 12px;
    padding-left: 12px;  
}

.wpsf-classic-masonry-feed-box {
    padding-right: 12px;
    padding-left: 12px;  
}

@media (min-width: 200px) {
    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-grid-feed-box {
        padding-right: <?php echo $options->grid->responsive->mobile->gap / 2 ?>px;
        padding-left: <?php echo $options->grid->responsive->mobile->gap / 2 ?>px;
        margin-bottom: <?php echo $options->grid->responsive->mobile->gap ?>px;
  }
  
    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-masonry-feed-box {
        padding-right: <?php echo $options->masonry->responsive->mobile->gap / 2 ?>px;
        padding-left: <?php echo $options->masonry->responsive->mobile->gap / 2 ?>px;
        margin-bottom: <?php echo $options->masonry->responsive->mobile->gap ?>px;
  }
}
@media (min-width: 720px) {
    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-grid-feed-box {
        padding-right : <?php echo $options->grid->responsive->tablet->gap / 2 ?>px;
        padding-left : <?php echo $options->grid->responsive->tablet->gap / 2 ?>px;
        margin-bottom: <?php echo $options->grid->responsive->tablet->gap ?>px;
    }

    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-masonry-feed-box {
        padding-right : <?php echo $options->masonry->responsive->tablet->gap / 2 ?>px;
        padding-left : <?php echo $options->masonry->responsive->tablet->gap / 2 ?>px;
        margin-bottom: <?php echo $options->masonry->responsive->tablet->gap ?>px;
    }
}
@media (min-width: 960px) {
    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-grid-feed-box {
        padding-right : <?php echo $options->grid->responsive->desktop->gap / 2 ?>px;
        padding-left : <?php echo $options->grid->responsive->desktop->gap / 2 ?>px;
        margin-bottom: <?php echo $options->grid->responsive->desktop->gap ?>px;
    }

    #wpsf-stream-<?php echo $streamID ?> .wpsf-classic-masonry-feed-box {
        padding-right : <?php echo $options->masonry->responsive->desktop->gap / 2 ?>px;
        padding-left : <?php echo $options->masonry->responsive->desktop->gap / 2 ?>px;
        margin-bottom: <?php echo $options->masonry->responsive->desktop->gap ?>px;
    }
}

/** End Responsive */
