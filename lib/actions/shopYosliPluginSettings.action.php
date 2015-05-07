<?php

/*
 * Class shopYosliPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginSettingsAction extends shopPluginsSettingsAction {

    public function execute() {
    	$_GET['id'] = 'yosli';

        parent::execute();
    }

}