<?php
return [
    'active' => 'techlysupport',
    'default' => null,
    'fallback' => 'techlysupport',
    'available' => [
        'techlysupport',
        'babysite',
        'babysite-green',
        'popularmechanics',
    ],

    'configs' => [
        'babysite' => [
            'features' => [
                'carousel_count' => 5,
                'hot_posts_count' => 4,
                'latest_posts_count' => 6,
            ],
        ],
        'babysite-green' => [
            'features' => [
                'carousel_count' => 5,
                'hot_posts_count' => 4,
            ],
        ],
        'watchsite' => [
            'features' => [
                'carousel_count' => 8,
                'banner_count' => 4,
                'hot_posts_count' => 4,
                'latest_posts_count' => 18,
                'sidebar_popular_count' => 5,
                'sidebar_recommended_count' => 5,
                'category_posts_per_page' => 12,
                'blog_detail_popular_count' => 6,
            ],
        ],
        'techlysupport' => [
            'features' => [
                'hot_posts_count' => 4,
                'latest_posts_count' => 6,
                'category_posts_per_page' => 12,
                'sidebar_popular_count' => 5,
            ],
        ],
        'popularmechanics' => [
            'features' => [
                'hot_posts_count' => 5,
                'latest_posts_count' => 4,
                'category_posts_per_page' => 10,
                'sidebar_popular_count' => 4,
                'sidebar_recommended_count' => 4,
                'blog_detail_popular_count' => 4,
            ],
        ],
    ],
];
