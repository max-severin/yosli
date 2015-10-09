<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'name' => /*_wp*/('Slider'),
    'version' => '1.0.2',
    'img' => 'img/yosli.png',
    'vendor' => 1020720,
    'shop_settings' => true,
    'custom_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'backend_menu' => 'backendMenu',
        'frontend_head' => 'frontendHeader',
    )
);