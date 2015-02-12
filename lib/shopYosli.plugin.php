<?php

/*
 * Class shopYosliPlugin
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopYosliPlugin extends shopPlugin {

    /** Handler for backend_menu event: return plugin button in backend menu. */
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

    /** Method for frontend which displays jquery slider. */
    static function display() {

        $app_settings_model = new waAppSettingsModel();

        $settings = $app_settings_model->get(array('shop', 'yosli'));

        if ($settings['status']) {

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