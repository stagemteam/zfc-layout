<?php
namespace Stagem\ZfcLayout;

return [


    //'assetic_configuration' => require_once 'assets.config.php',

    'assetic_configuration' => array_merge_recursive(
        require_once realpath('config/assets.php'),
        require_once 'assets.config.php'
    ),

    'translator' => [
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
                'text_domain' => __NAMESPACE__,
            ],
        ],
    ],

    'view_helper_config' => [
        'flashMessenger' => [
            'message_open_format'      => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
            'message_close_string'     => '</li></ul></div>',
            'message_separator_string' => '</li><li>'
        ]
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout::layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout::default' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'templates' =>  [
        'map' => [
            'layout::default' => __DIR__ . '/../templates/layout/default.phtml',
            'layout::home'  => __DIR__ . '/../templates/layout/home-page.phtml',
            'layout::question'  => __DIR__ . '/../templates/layout/question.phtml',
            //'app::home-page'  => __DIR__ . '/../templates/app/home-page.phtml'
            'error::error'  => __DIR__ . '/../templates/error/index.phtml',
            'error::404'  => __DIR__ . '/../templates/error/404.phtml'
        ],
        'paths' => [
            'widget'  => [__DIR__ . '/../templates/widget'],
            'home-index'  => [__DIR__ . '/../templates/index'],
        ],
    ],
];