<?php

/*
 * Class shopYosliPluginSettingsAction
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginSettingsAction extends waViewAction {

    public function execute() {
    	$plugin = wa('shop')->getPlugin('yosli');
        $namespace = 'shop_yosli';

        $params = array();
        $params['id'] = 'yosli';
        $params['namespace'] = $namespace;
        $params['title_wrapper'] = '%s';
        $params['description_wrapper'] = '<br><span class="hint">%s</span>';
        $params['control_wrapper'] = '<div class="name">%s</div><div class="value">%s %s</div>';

        $settings_controls = $plugin->getControls($params);

        $this->view->assign('settings_controls', $settings_controls);
    }

}