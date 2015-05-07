<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'status' => array(
        'title'        => 'Статус плагина',
        'value'        => 'off',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'off' => 'Выключен',
            'on'  => 'Включен',
        ),
    ),
    'theme' => array(
        'title'        => 'Шаблон плагина',
        'description'  => 'Какой шаблон из стандарных тем оформления Nivo slider будет использоваться.',
        'value'        => 'default',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'bar' => 'bar',
            'dark'  => 'dark',
            'default' => 'default',
            'light'  => 'light',
        ),
    ),
    'effect' => array(
        'title'        => 'Эффект анимации',
        'description'  => 'Выберите анимацию nivo slider.',
        'value'        => 'random',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'sliceDown' => 'sliceDown',
            'sliceDownLeft'  => 'sliceDownLeft',
            'sliceUp' => 'sliceUp',
            'sliceUpLeft'  => 'sliceUpLeft',
            'sliceUpDown' => 'sliceUpDown',
            'sliceUpDownLeft'  => 'sliceUpDownLeft',
            'fold' => 'fold',
            'fade'  => 'fade',
            'random'  => 'random',
        ),
    ),
    'width' => array(
        'title'        => 'Ширина изображения (px)',
        'placeholder'  => '480',
        'value'        => '480',
        'control_type' => waHtmlControl::INPUT,
    ),
    'height' => array(
        'title'        => 'Высота изображения (px)',
        'placeholder'  => '300',
        'value'        => '300',
        'control_type' => waHtmlControl::INPUT,
    ),
    'speed' => array(
        'title'        => 'Скорость анимации (msec)',
        'placeholder'  => '1000',
        'value'        => '1000',
        'control_type' => waHtmlControl::INPUT,
    ),
    'pause_time' => array(
        'title'        => 'Время паузы (msec)',
        'placeholder'  => '6000',
        'value'        => '6000',
        'control_type' => waHtmlControl::INPUT,
    ),
);