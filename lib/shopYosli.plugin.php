<?php

/*
 * Class shopYosliPlugin
 * Plugin allows users in the backend to add pictures with title and link,
 * pictures are displayed at the frontend,
 * jquery plagin that is used in the yosli plugin is a nivo slider - https://github.com/gilbitron/Nivo-Slider
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPlugin extends shopPlugin {
    
    /**
     * Handler for backend_menu event: add yosli button in backend menu tabs
     * @return array
     */
    public function backendMenu() {
        $html = '';
        
        if ($this->getSettings('status') === 'on') {
	        $html = '<li ' . (waRequest::get('plugin') == $this->id ? 'class="selected"' : 'class="no-tab"') . '>
	                    <a href="?plugin=yosli">Слайдер</a>
	                </li>';
        }

        return array('core_li' => $html);
    }

    
    /**
     * Frontend method that displays and initiates jquery nivo slider
     * @return string
     */
    static function display() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'yosli'));

        if ($settings['status'] === 'on') {

            $model = new shopYosliPluginSlidesModel();
            $slides = $model->order('id DESC')->fetchAll();
            
            $view = wa()->getView(); 
            $view->assign('settings', $settings);
            $view->assign('slides', $slides);

            $html = $view->fetch(realpath(dirname(__FILE__)."/../").'/templates/Frontend.html');
            
            return $html;

        } else {

            return;

        }     
    }

}