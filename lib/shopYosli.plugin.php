<?php

class shopYosliPlugin extends shopPlugin {

    public function frontendHeader() {           
/*
            $app_settings_model = new waAppSettingsModel();
            $settings = $app_settings_model->get(array('shop', 'callb'));

            $view = wa()->getView(); 
            $view->assign('call_b_settings', $settings);
            $html = $view->fetch($this->path.'/templates/Frontend.html');

            return $html;        
*/
    }

    public function backendMenu() {
        
        if ( $this->getSettings('status') ) {

	        $html = '<li ' . (waRequest::get('plugin') == $this->id ? 'class="selected"' : 'class="no-tab"') . '>
	                    <a href="?plugin=yosli">Баннеры</a>
	                </li>';
	        return array('core_li' => $html);
        } else {
        	return;
        }
    }

}
