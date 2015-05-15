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
            'bar'     => 'bar',
            'dark'    => 'dark',
            'default' => 'default',
            'light'   => 'light',
        ),
    ),
    'effect' => array(
        'title'        => 'Эффект анимации',
        'description'  => 'Выберите анимацию nivo slider.',
        'value'        => 'random',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'sliceDown'       => 'sliceDown',
            'sliceDownLeft'   => 'sliceDownLeft',
            'sliceUp'         => 'sliceUp',
            'sliceUpLeft'     => 'sliceUpLeft',
            'sliceUpDown'     => 'sliceUpDown',
            'sliceUpDownLeft' => 'sliceUpDownLeft',
            'fold'            => 'fold',
            'fade'            => 'fade',
            'random'          => 'random',
        ),
    ),
    'width' => array(
        'title'        => 'Ширина (px)',
        'description'  => 'Ширина, формируемая при загрузке изображений.',
        'placeholder'  => '480',
        'value'        => '480',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'height' => array(
        'title'        => 'Высота (px)',
        'description'  => 'Высота, формируемая при загрузке изображений.',
        'placeholder'  => '300',
        'value'        => '300',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'speed' => array(
        'title'        => 'Скорость анимации (msec)',
        'placeholder'  => '1000',
        'value'        => '1000',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'pause_time' => array(
        'title'        => 'Время паузы (msec)',
        'placeholder'  => '6000',
        'value'        => '6000',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'direction_nav' => array(
        'title'        => 'Отображение кнопок «вперед» и «назад»',
        'value'        => 'false',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => 'Выключен',
            'true'  => 'Включен',
        ),
    ),
    'control_nav' => array(
        'title'        => 'Отображение навигации',
        'value'        => 'true',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => 'Выключен',
            'true'  => 'Включен',
        ),
    ),
    'pause_on_hover' => array(
        'title'        => 'Остановка анимации при наведении',
        'value'        => 'true',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => 'Выключен',
            'true'  => 'Включен',
        ),
    ),
    'control_nav_thumbs' => array(
        'title'        => 'Отображение миниатюр',
        'value'        => 'false',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => 'Выключен',
            'true'  => 'Включен',
        ),
    ),
);