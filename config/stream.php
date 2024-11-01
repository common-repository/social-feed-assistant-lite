<?php

return [
    'options' => [
        'name' => 'Untitled',
        'general' => [
          'postSettings' => [
            'displayPostElements' => [
              'avatar' => 0,
              'user' => 0,
              'date' => 0,
              'postLink' => 0,
              'likeCount' => 0,
              'commentCount' => 0,
              'share' => 0,
              'text' => 0,
            ],
            'displayPopupElements' => [
              'avatar' => 0,
              'user' => 0,
              'date' => 0,
              'location' => 0,
              'likeCount' => 0,
              'commentCount' => 0,
              'followBtn' => 0,
              'postLink' => 0,
              'share' => 0,
              'text' => 0,
              'comment' => 0,
            ],
            'template' => 'classic',
            'layout' => 'grid',
         ],
          'style' => [
            'avatarShape' => 'rounded',
            'cardCourner' => 'plain',
            'socialIconStyle' => 'corner',
            'textAlignment' => 'left',
          ],
          'color' => [
            'post' => [
              'classic' => [
                'link' => 'rgba(94, 159, 202, 1)',
                'text' => 'rgba(131, 141, 143, 1)',
                'background' => 'rgba(255, 255, 255, 1)',
                'border' => 'rgba(244, 244, 244, 1)',
              ],
              'tile' => [
                'overlay' => 'rgba(0, 0, 0, 0.8)',
                'link' => 'rgba(107, 145, 255, 1)',
                'text' => 'rgba(255, 255, 255, 1)',
              ],
              'comments' => [
                'background' => 'rgba(247, 247, 247, 1)',
                'text' => 'rgba(102, 102, 102, 1)',
              ],
              'heading' => 'rgba(143, 143, 143, 1)',
              'secondary' => 'rgba(179, 179, 179, 1)',
              'shadow' => 'rgba(0, 0, 0, 0.12)',
            ],
            'slider' => [
              'arrows' => 'rgba(255, 255, 255, 1)',
              'arrowsBG' => 'rgba(0, 0, 0, 0.47)',
            ],
            'grid' => [
              'buttonColor' => 'rgba(255, 255, 255, 1)',
              'buttonBG' => 'rgba(239, 241, 243, 1)',
            ],
            'popup' => [
              'overlay' => 'rgba(0, 0, 0, 0.6)',
              'background' => 'rgba(247, 247, 247, 0.8)',
              'text' => 'rgba(55, 55, 55, 1)',
              'links' => 'rgba(0, 53, 105, 1)',
              'followBtn' => 'rgba(56, 151, 240, 1)',
              'commentsBackground' => 'rgba(247, 247, 247, 0.8)',
              'commentsText' => 'rgba(102, 102, 102, 1)',
            ],
            'filter' => [
              'background' => 'rgba(255, 255, 255, 1)',
              'text' => 'rgba(75, 155, 197, 1)',
              'activeText' => 'rgba(255, 255, 255, 1)',
              'activeBg' => 'rgba(75, 155, 197, 1)',
            ],
          ],
          'itemsOrder' => 1,
          'postCount' => 12,
          'maxContainer' => 0,
          'showSearchBar' => 0,
          'actionOnImageClick' => 1,
          'dateFormat' => 'short',
          'privateStream' => 0,
          'hideStreamOnDesktop' => 0,
          'hideStreamOnMobile' => 0,
          'showOnlyMediaPost' => 0,
          'titlesLink' => 0,
          'openLinksInNewTab' => 0,
          'maxImageResolution' => 0,
          'feedLoadWithAnimation' => 0,
          'showPostHeading' => [
            'avatar' => 0,
            'username' => 0,
            'followBtn' => 0,
            'bio' => 0,
          ],
          'loadingImage' => '',
          'customCss' => '',
        ],
        'masonry' => [
          'responsive' => [
            'desktop' => [
              'column' => 4,
              'gap' => 30,
            ],
            'tablet' => [
              'column' => 2,
              'gap' => 15,
            ],
            'mobile' => [
              'column' => 1,
              'gap' => 15,
            ],
          ],
        ],
        'grid' => [
          'responsive' => [
            'desktop' => [
              'column' => 4,
              'gap' => 30,
            ],
            'tablet' => [
              'column' => 2,
              'gap' => 15,
            ],
            'mobile' => [
              'column' => 1,
              'gap' => 15,
            ],
          ],
        ],
        'justified' => [
          'lastRow' => 1,
          'rowHeight' => 300,
          'maxRowHeight' => 350,
          'margins' => 10,
        ],
        'wall' =>  [
          'width' => 400,
          'verticalMargin' => 20,
          'horizontalMargin' => 0,
          'postComments' => 0,
        ],
        'carousel' => [
          'responsive' => [
            'desktop' => [
              'row' => 1,
              'column' => 4,
              'gap' => 30,
            ],
            'tablet' => [
              'row' => 1,
              'column' => 3,
              'gap' => 30,
            ],
            'mobile' => [
              'row' => 1,
              'column' => 1,
              'gap' => 30,
            ],
          ],
          'sliderControls' => [
            'slideSwitchSpeed' => 300,
            'autoPlaySpeed' => 0,
            'paginationControl' => 0,
            'arrowsControl' => 0,
            'dragControl' => 0,
          ],
          'loadMore' => 0,
          'maxItemPerSlide' => 0,
        ],
    ]
];
