<?php defined('ABSPATH') || exit('no access') ?>
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main {
    width: 100%;
    height: auto;
    margin: 20px auto;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-container {
  width: 100%;
  height: 100%;
  float: left;
  position: relative;
  padding: 0;
  display: block;
  background: #fff;
  transition: opacity 0.2s ease, visibility 0.2s ease;
  overflow: hidden;
  cursor: pointer;
  margin: 0;
  box-shadow: 0 0 13px 0 <?php echo $options->general->color->post->shadow ?>;
  border-radius: <?php echo ($options->general->style->cardCourner == 'round') ? '5px' : 0 ?>;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box {
  box-sizing: border-box;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box ::selection {
  background: #eee;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box:hover .sfal-tile-feed-box-container .sfal-tile-feed-box-overlay,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box:hover .sfal-tile-feed-box-container .sfal-tile-feed-box-overlay {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-content-img img,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-content-img div {
  min-height: 100%;
  min-width: 100%;
  transition: transform 0.3s ease, filter 0.3s, opacity 500ms ease-in;
  transform-origin: 0 0;
  backface-visibility: hidden;
  background-size: cover;
  background-position: center;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box:hover .sfal-tile-feed-box-content .sfal-tile-feed-box-content-img img,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box:hover .sfal-tile-feed-box-content .sfal-tile-feed-box-content-img div {
  transform: scale(1.1);
  transform-origin: 0 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-content,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-media-wrapper,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-content-img {
  position: relative;
  width: 100%;
  height: 100%;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-media-wrapper .sfal-tile-feed-box-content-img img.sfal-lazy-img-loading {
  background-color: #000;
  background-image: url(<?php echo $assetsUrl ?>/img/user/oval.svg);
  background-repeat: no-repeat !important;
  background-position: 50% 50% !important;
  background-size: initial;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-media-wrapper .sfal-tile-feed-box-content-img div.sfal-lazy-img-loading {
  background-image: url(<?php echo $assetsUrl ?>/img/user/oval.svg);
  background-color: #000;
  min-width: 100%;
  background-position: center !important;
  background-repeat: no-repeat !important;
  background-size: initial;
  height: 400px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-grid-feed-box .sfal-tile-feed-box-media-wrapper .sfal-tile-feed-box-content-img > div {
  height: 400px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-type {
  position: absolute;
  top: 23px;
  right: 23px;
}

<?php if ($options->general->style->socialIconStyle == 'label') : ?>
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-title {
  position: absolute;
  top: 22px;
  left: 20px;
  color: #fff;
  background: #405de6;
  padding: 2px 11px 3px 12px;
  border-radius: 5px;
  font-size: 12px;
  font-weight: 600;
}
<?php endif; ?>

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-sidecar-type {
  width: 23px;
  height: 23px;
  border-radius: 5px;
  background-color: #ffffff;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-sidecar-type::after {
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

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay {
  background: <?php echo $options->general->color->post->tile->overlay ?>;
  position: absolute;
  z-index: 2;
  top: -1px;
  right: -1px;
  bottom: -1px;
  left: -1px;
  opacity: 0;
  transform-origin: 0 0;
  visibility: hidden;
  pointer-events: none;
  transition: opacity 0.3s, visibility 0.3s;
  box-sizing: border-box;
  color: #fff;
  display: block;
  padding: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header {
  display: block;
  position: relative;
  width: 100%;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-img {
  float: left;
  margin-right: 13px;
  position: relative;
}

<?php if ($options->general->style->socialIconStyle == 'timestamp') : ?>
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-timestamp-icon {
  position: absolute;
  bottom: -3px;
  left: 26px;
  width: 20px;
  height: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-timestamp-icon > span {
  background: #405de6;
  color: #fff;
  padding: 2px 5px 0px 5px;
  font-size: 11px;
  border-radius: 50%;
  font-weight: bold;
  text-align: center;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-timestamp-icon > span > i {
  font-weight: bold;
}
<?php endif; ?>

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-img img {
  max-width: 40px;
  max-height: 40px;
  <?php echo ($options->general->style->avatarShape == 'round') ? "border-radius : 50% \n" : null; ?>
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-meta {
  line-height: 18px;
  text-align: left;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-account-title {
  display: block;
  font-weight: bold;
  padding-bottom: 2px;
  color: <?php echo $options->general->color->post->heading ?>;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-account-url,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-account-date {
  color: <?php echo $options->general->color->post->secondary ?>;
  font-size: 12px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main span.sfal-tile-feed-box-overlay-header-account-url {
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    text-overflow: ellipsis;
    max-width: 90px;
    vertical-align: -4px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content {
  text-align : left;
  box-sizing: border-box;
  font-size: 12px;
  line-height: 20px;
  position: absolute;
  bottom: 22px;
  width: 100%;
  padding-right: 45px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content-text {
  text-align : <?php echo $options->general->style->textAlignment; ?>;
  color : <?php echo $options->general->color->post->tile->text; ?>;
  font-size: 12px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content-text a {
  color : <?php echo $options->general->color->post->tile->link ?>
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content-text a:hover {
  color : <?php echo $options->general->color->post->tile->text; ?>;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content-meta {
  color: <?php echo $options->general->color->post->secondary ?>;
  margin-top: 30px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-like-counter-meta a,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-comment-counter-meta a {
  color: inherit;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-like-counter-meta {
  margin-right: 20px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-like-counter-meta i,
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-comment-counter-meta i {
  vertical-align: -2px;
  margin-right: 5px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta {
  float: right;
  position: relative;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links {
    position: absolute;
    bottom: 30px;
    border-radius: 5px;
    background-color: rgb(0, 0, 0);
    right: -7px;
    padding: 9px 8px;
    filter: drop-shadow(0 0 4px rgba(0, 0, 0, 0.27));
    transition: all 0.2s ease-in;
    opacity: 0;
    visibility: hidden;
    z-index: 10;
    border: 1px solid #797979;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta .lni-exit-up {
  cursor: pointer;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links.show-share-links {
  opacity: 1;
  visibility: visible;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links a {
  color: #fff;
  text-decoration: none;
  padding: 4px 0;
  display: block;
  outline: none !important;
  box-shadow: none;
  font-size: 11px;
  text-align: left;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links a i {
  font-size: 13px;
  vertical-align: -1px;
  margin-right: 5px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links::after {
  content: "";
  position: absolute;
  bottom: -1px;
  left: 84%;
  width: 0;
  height: 0;
  border: 7px solid #0000;
  border-top-color: rgb(119, 119, 119);
  border-bottom: 0;
  margin-left: -7px;
  margin-bottom: -6px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-video-type {
  background: #fff;
  border-radius: 5px;
  padding: 2px 5px 0 7px;
  filter: drop-shadow(0 0 3.5px
  rgba(0, 0, 0, 0.2));
  font-size: 15px;
  color: #898989;
}

<?php if ($options->general->style->socialIconStyle == 'corner') : ?>
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-icon {
  width: 0;
  height: 0;
  border-style: solid;
  border-width: 65px 65px 0 0;
  border-color: #405de6 transparent transparent transparent;
  position: absolute;
  top: 0;
  left: 0;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-icon span {
  color: #fff;
  font-size: 18px;
  position: absolute;
  left: 10px;
  bottom: 26px;
}

#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-icon span i {
  font-weight: bold;
}
<?php endif; ?>

<?php if ($options->general->style->textAlignment == 'center'): ?>
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-img {
    float: none;
    margin-right: 0;
    text-align: center;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-meta {
    text-align: center;
    margin-top: 10px;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-social-timestamp-icon {
    position: absolute;
    bottom: -3px;
    left: 15px;
    height: 20px;
    width: 100%;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-header-account-tile {
    font-size: 14px;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content {
    text-align: center;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-content-text {
    text-align: center;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta {
    float: none;
    margin-left: 25px;
  }
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box-overlay-share-meta-links {
    
  }


/* Justified */
#sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-feed-box.sfal-tile-justified-feed-box {
  min-width: 100px;
}
/* End Justified */

<?php endif; ?>

/* Responsive */

@media (min-width: 200px) {
  
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-image-feed-box,
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-feeds-main .sfal-tile-video-feed-box {
    width: 100%;
  }

  #sfal-stream-<?php echo $streamID ?> .sfal-tile-grid-feed-box {
    padding-right: <?php echo $options->grid->responsive->mobile->gap / 2 ?>px;
    padding-left: <?php echo $options->grid->responsive->mobile->gap / 2 ?>px;
    margin-bottom: <?php echo $options->grid->responsive->mobile->gap ?>px;
  }
  
  #sfal-stream-<?php echo $streamID ?> .sfal-tile-masonry-feed-box {
    padding-right: <?php echo $options->masonry->responsive->mobile->gap / 2 ?>px;
    padding-left: <?php echo $options->masonry->responsive->mobile->gap / 2 ?>px;
    margin-bottom: <?php echo $options->masonry->responsive->mobile->gap ?>px;
  }
}

@media (min-width: 768px) {
    #sfal-stream-<?php echo $streamID ?> .sfal-tile-grid-feed-box {
      padding-right: <?php echo $options->grid->responsive->tablet->gap / 2 ?>px;
      padding-left: <?php echo $options->grid->responsive->tablet->gap / 2 ?>px;
      margin-bottom: <?php echo $options->grid->responsive->tablet->gap ?>px;
    }
    
    #sfal-stream-<?php echo $streamID ?> .sfal-tile-masonry-feed-box {
      padding-right: <?php echo $options->masonry->responsive->tablet->gap / 2 ?>px;
      padding-left: <?php echo $options->masonry->responsive->tablet->gap / 2 ?>px;
      margin-bottom: <?php echo $options->masonry->responsive->tablet->gap ?>px;
    }
}
@media (min-width: 960px) {
    #sfal-stream-<?php echo $streamID ?> .sfal-tile-grid-feed-box {
      padding-right: <?php echo $options->grid->responsive->desktop->gap / 2 ?>px;
      padding-left: <?php echo $options->grid->responsive->desktop->gap / 2 ?>px;
      margin-bottom: <?php echo $options->grid->responsive->desktop->gap ?>px;
    }
    
    #sfal-stream-<?php echo $streamID ?> .sfal-tile-masonry-feed-box {
      padding-right: <?php echo $options->masonry->responsive->desktop->gap / 2 ?>px;
      padding-left: <?php echo $options->masonry->responsive->desktop->gap / 2 ?>px;
      margin-bottom: <?php echo $options->masonry->responsive->desktop->gap ?>px;
    }
}

/* End Responsive */
