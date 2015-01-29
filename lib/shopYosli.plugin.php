<?php

class shopYosliPlugin extends shopPlugin {

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

    static function display() {
        $model = new shopYosliPluginSlidesModel();
        $slides = $model->order('id DESC')->fetchAll();
        
        $view = wa()->getView(); 
        $view->assign('slides', $slides);
        $html = $view->fetch(realpath(dirname(__FILE__)."/../").'/templates/Frontend.html');

        return $html;
    }

}
