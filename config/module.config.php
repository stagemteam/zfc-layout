<?php
namespace Stagem\ZfcLayout;

return [
    'assetic_configuration' => array_merge_recursive(
        require_once realpath('config/assets.php'),
        require_once 'assets.config.php'
    ),
];