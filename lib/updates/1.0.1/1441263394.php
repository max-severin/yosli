<?php

/**
 * @author Max Severin <makc.severin@gmail.com>
 */
$plugin_id = array('shop', 'yosli');

$app_settings_model = new waAppSettingsModel();

$app_settings_model->set($plugin_id, 'status_target_blank', 'off');