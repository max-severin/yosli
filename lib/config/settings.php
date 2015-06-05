<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'status' => array(
        'title'        => _wp('Status'),
        'value'        => 'off',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'off' => _wp('Off'),
            'on'  => _wp('On'),
        ),
    ),
    'theme' => array(
        'title'        => _wp('Plugin theme'),
        'description'  => _wp('Select plugin theme from standard Nivo slider themes.'),
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
        'title'        => _wp('Animation effect'),
        'description'  => _wp('Select the Nivo slider animation.'),
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
        'title'        => _wp('Width (px)'),
        'description'  => _wp('Width of the uploaded images.'),
        'placeholder'  => '480',
        'value'        => '480',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'height' => array(
        'title'        => _wp('Height (px)'),
        'description'  => _wp('Height of the uploaded images.'),
        'placeholder'  => '300',
        'value'        => '300',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'speed' => array(
        'title'        => _wp('Animation speed (msec)'),
        'placeholder'  => '1000',
        'value'        => '1000',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'pause_time' => array(
        'title'        => _wp('Pause time (msec)'),
        'placeholder'  => '6000',
        'value'        => '6000',
        'control_type' => waHtmlControl::CUSTOM.' '.'shopYosliPlugin::settingNumberControl',
        'options'      => array(
            'min'  => '0',
            'step' => '1',
        ),
    ),
    'direction_nav' => array(
        'title'        => _wp('Displays the buttons «forward» and «backward»'),
        'value'        => 'false',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => _wp('Off'),
            'true'  => _wp('On'),
        ),
    ),
    'control_nav' => array(
        'title'        => _wp('Navigation mapping'),
        'value'        => 'true',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => _wp('Off'),
            'true'  => _wp('On'),
        ),
    ),
    'pause_on_hover' => array(
        'title'        => _wp('Stop animation while hovering'),
        'value'        => 'true',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => _wp('Off'),
            'true'  => _wp('On'),
        ),
    ),
    'control_nav_thumbs' => array(
        'title'        => _wp('Display thumbnails'),
        'value'        => 'false',
        'control_type' => waHtmlControl::SELECT,
        'options'      => array(
            'false' => _wp('Off'),
            'true'  => _wp('On'),
        ),
    ),
);