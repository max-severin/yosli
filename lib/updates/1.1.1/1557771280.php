<?php

/**
 * @author Max Severin <makc.severin@gmail.com>
 */
$model = new waModel();

try {
    $model->query("SELECT `alt` FROM `shop_yosli_slide` WHERE 0");
} catch (waDbException $e) {
    $model->exec("ALTER TABLE `shop_yosli_slide` ADD `alt` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");

	$model->query("UPDATE `shop_yosli_slide` SET `alt` = `title`");
}