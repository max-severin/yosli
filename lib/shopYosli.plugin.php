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
                        <a href="?plugin=yosli">' . _wp('Slider') . '</a>
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

    /**
     * Generates the HTML code for the user control with ID settingNumberControl for number parametrs
     * @param string $name
     * @param array $params
     * @return string
     */
    static public function settingNumberControl($name, $params = array()) {

        $control = '';

        $control_name = htmlentities($name, ENT_QUOTES, 'utf-8');

        $control .= "<input id=\"{$params['id']}\" type=\"number\" name=\"{$control_name}\" ";
        $control .= self::addCustomParams(array('class', 'placeholder', 'value',), $params);
        $control .= self::addCustomParams(array('min', 'max', 'step',), $params['options']);
        $control .= ">";

        return $control;

    }

    /**
     * Generates the HTML parts of code for the params in user controls added by plugin
     * @param array $list
     * @param array $params
     * @return string
     */
    private static function addCustomParams($list, $params = array()) {
        $params_string = '';

        foreach ($list as $param => $target) {
            if (is_int($param)) {
                $param = $target;
            }
            if (isset($params[$param])) {
                $param_value = $params[$param];
                if (is_array($param_value)) {
                    if (isset($param_value['title'])) {
                        $param_value = $param_value['title'];
                    } else {
                        $param_value = implode(' ', $param_value);
                    }
                }
                if ($param_value !== false) {
                    $param_value = htmlentities((string)$param_value, ENT_QUOTES, 'utf-8');
                    if (in_array($param, array('autofocus'))) {                     
                        $params_string .= " {$target}";
                    } else {                        
                        $params_string .= " {$target}=\"{$param_value}\"";
                    }
                }
            }
        }

        return $params_string;
    }

}