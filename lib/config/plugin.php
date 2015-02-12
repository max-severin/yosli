<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */

return array(
    'name' => 'Баннеры',
    'description' => 'Вывод анимируемых баннеров в виде слайдера',
    'img' => 'img/yosli.png',
    'version' => '1.0',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'backend_menu' => 'backendMenu',
        'frontend_head' => 'frontendHeader',
    )
);