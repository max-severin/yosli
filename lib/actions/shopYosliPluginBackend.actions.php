<?php

class shopYosliPluginBackendActions extends waViewActions {

    public function defaultAction() {        
        
    	$model = new shopYosliPluginSlidesModel();
        $slides = $model->order('id DESC')->fetchAll();
        
        $this->view->assign('slides', $slides);

        $this->setLayout(new shopYosliPluginBackendLayout());

    }

    public function createAction() {        
        
    	$model = new shopYosliPluginSlidesModel();

        if (waRequest::method() == 'post') {

            $title = waRequest::post('title', '', 'str');
            $link = waRequest::post('link', '', 'str');                        
            $file = waRequest::file('filename');
            $create_datetime = date('Y-m-d H:i:s');  

            if ( file_exists($file) ) {
                $rand = mt_rand();
                $name = "$rand.original.jpg";
                $filename = wa()->getDataPath("yosli/{$name}", TRUE, 'shop'); 

                waFiles::move($file, $filename);   

                try {
                    $img = waImage::factory($filename);
                } catch(Exception $e) {
                    // Nope... it's not an image.
                    $errors = 'File is not an image ('.$e->getMessage().').';
                    return;
                }
                $img->resize(600, 800, waImage::AUTO)->save($filename, 90);
            }

            $model->insert(array(
                'title' => $title,  
                'link' => $link,          
                'filename' => $name,
                'create_datetime' => $create_datetime,
            ));

        }       
        
        $this->redirect('?plugin=yosli');

    }

    public function updateAction() {        
        
    	$model = new shopYosliPluginSlidesModel();

        if (waRequest::method() == 'post') {

            $id = waRequest::post('id', '', 'int');
            $title = waRequest::post('title', '', 'str');
            $link = waRequest::post('link', '', 'str');                       
            $old_file = waRequest::post('old_filename');                       
            $file = waRequest::file('filename'); 

            $name = $old_file; 
            if ( file_exists($file) ) {
                $rand = mt_rand();
                $name = "$rand.original.jpg";
                $filename = wa()->getDataPath("yosli/{$name}", TRUE, 'shop'); 

                waFiles::move($file, $filename);   

                try {
                    $img = waImage::factory($filename);
                } catch(Exception $e) {
                    // Nope... it's not an image.
                    $errors = 'File is not an image ('.$e->getMessage().').';
                    return;
                }
                $img->resize(600, 800, waImage::AUTO)->save($filename, 90);

                if ($old_file) {
                	waFiles::delete(wa()->getDataPath("yosli/{$old_file}", TRUE, 'shop'));
                }
            }

            $model->updateById($id, array(
                'title' => $title,  
                'link' => $link,          
                'filename' => $name,
            ));

        }       
        
        $this->redirect('?plugin=yosli');

    }


}
