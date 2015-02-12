<?php

/*
 * Class shopYosliPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopYosliPluginSettingsAction extends waViewAction {

    public function execute() {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'yosli'));
        $this->view->assign('settings', $settings);

    }

}