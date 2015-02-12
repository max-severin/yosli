<?php

/*
 * Class shopYosliPluginBackendActions
 * @author Max Severin <makc.severin@gmail.com>
 */

class shopYosliPluginBackendActions extends waViewActions {

    public function defaultAction() {
        
    	$model = new shopYosliPluginSlidesModel();
        $slides = $model->order('id DESC')->fetchAll();
        
        $this->view->assign('slides', $slides);

        $this->setLayout(new shopYosliPluginBackendLayout());

    }

    public function createAction() {        

        if (waRequest::method() == 'post') {
        
            $model = new shopYosliPluginSlidesModel();

            if ( file_exists($file = waRequest::file('filename')) ) {                
                $filename = $this->saveFile($file);
            } else {
                $filename = '';
            }

            $data = array(
                'title' => waRequest::post('title', '', 'String'),  
                'link' => waRequest::post('link', '', 'String'),          
                'filename' => $filename,
                'create_datetime' => date('Y-m-d H:i:s'),
            );

            $model->insert($data);

        }
        
        $this->redirect('?plugin=yosli');

    }

    public function updateAction() {        

        if (waRequest::method() == 'post') {
        
            $model = new shopYosliPluginSlidesModel();
                                
            $old_filename = waRequest::post('old_filename', '', 'String');                       
            $file = waRequest::file('filename'); 

            $filename = $old_filename; 
            if ( file_exists($file) ) {
                $filename = $this->saveFile($file, $old_filename);                
            }

            $id = waRequest::post('id', 0, 'int');

            $data = array(
                'title' => waRequest::post('title', '', 'String'),  
                'link' => waRequest::post('link', '', 'String'),          
                'filename' => $filename,
            );

            $model->updateById($id, $data);

        }       
        
        $this->redirect('?plugin=yosli');

    }

    public function saveFile($file, $old_file = false) {

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'yosli'));

        ($settings['height']) ? $height = $settings['height'] : $height = 800;
        ($settings['width']) ? $width = $settings['width'] : $width = 800;

        $rand = mt_rand();
        $name = "$rand.original.png";
        $filename = wa()->getDataPath("yosli/{$name}", TRUE, 'shop'); 

        waFiles::move($file, $filename);   

        try {
            $img = waImage::factory($filename);
        } catch(Exception $e) {
            $errors = 'File is not an image ('.$e->getMessage().').';
            return;
        }
        
        $img->resize($width, $height, waImage::NONE)->save($filename, 90);

        if ($old_file) {
            waFiles::delete(wa()->getDataPath("yosli/{$old_file}", TRUE, 'shop'));
        }

        return $name;

    }

}