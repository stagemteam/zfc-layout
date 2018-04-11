<?php
namespace Stagem\ZfcLayout;

return [

    'routes' => [
        'default(.*)' => [
            //'@front_css',
            '@core_js',
        ],
    ],

    'modules' => [
        __NAMESPACE__ => [
            'root_path' => __DIR__ . '/../view/assets',
            'collections' => [
                'core_js' => [
                    'assets' => [
                        'js/modal.js',
                        'js/refresh.js',
                        'js/ajax.js',
                    ],
                ],
            ],
        ],
    ],
];