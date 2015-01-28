<?php

return array(
    'name' => 'Баннеры',
    'description' => 'Модуль банеры (слайдер) с выбором нескольких видов анимации',
    'img' => 'img/yosli.png',
    'version' => '1.0',
    'rights' => false,
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'backend_menu' => 'backendMenu',
        'frontend_head' => 'frontendHeader', // or using 'frontend_homepage' hook
    )
);
