<?php

/*
 * @author Max Severin <makc.severin@gmail.com>
 */
return array(
    'shop_yosli_slide' => array(
        'id' => array('int', 11, 'null' => 0, 'autoincrement' => 1),
        'title' => array('text', 'null' => ''),
        'link' => array('text', 'null' => ''),
        'filename' => array('text', 'null' => ''),
        'create_datetime' => array('datetime', 'null' => ''),
        ':keys' => array(
            'PRIMARY' => 'id',
        ),
    ),
);