<?php

/*
 * Class shopYosliPluginBackendActions
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginBackendActions extends waViewActions {

    public function defaultAction() {
        $model = new shopYosliPluginSlidesModel();
        $slides = $model->order('id DESC')->fetchAll();

        foreach ($slides as $id => $slide) {
            $slides[$id]['title'] = addslashes(htmlspecialchars($slide['title']));
            $slides[$id]['link'] = addslashes(htmlspecialchars($slide['link']));
        }
        
        $this->view->assign('slides', $slides);

        $this->setLayout(new shopYosliPluginBackendLayout());
    }

    public function createAction() {
        if (waRequest::method() == 'post') {
        
            $model = new shopYosliPluginSlidesModel();

            $data = array(
                'title' => waRequest::post('title', '', 'String'),  
                'link' => waRequest::post('link', '', 'String'),          
                'filename' => $this->saveFile(),
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
            $is_new_filename = waRequest::post('is_new_filename', '', 'Int');

            ($is_new_filename) ? $filename = $this->saveFile($old_filename) : $filename = $old_filename;

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

    public function tmpimageAction() {
        $id = $this->getId();
        $file = waRequest::file('filename');

        if (!$file->uploaded()) {
             $this->sendResponse('error:No file uploaded.');
            return;
        }

        try {
            $img = $file->waImage();
        } catch(Exception $e) {
            // Nope... it's not an image.
             $this->sendResponse('error:File is not an image ('.$e->getMessage().').');
            return;
        }

        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'yosli'));

        ($settings['height']) ? $height = $settings['height'] : $height = 800;
        ($settings['width']) ? $width = $settings['width'] : $width = 800;

        $temp_dir  = wa()->getTempPath("yosli", 'shop');
        $fname = uniqid($id.'_').'.png';
        $img->resize($width, $height, waImage::NONE)->save($temp_dir.'/'.$fname, 90);

        $yosliSlides = $this->getStorage()->read('yosliSlides');
        if (!$yosliSlides) {
            $yosliSlides = array();
        }

        if (isset($yosliSlides[$id]) && file_exists($yosliSlides[$id])) {
            if (!unlink($yosliSlides[$id])) {
                throw new waException('Unable to delete photo temp file: '+$yosliSlides[$id]);
            }
        }
        $yosliSlides[$id] = $temp_dir.'/'.$fname;

        $this->getStorage()->write('yosliSlides', $yosliSlides);

        $temp_file_url = $this->getPreviewUrl($fname);

        $this->sendResponse( $temp_file_url );
    }

    public function dataAction() {
        $app_id = $this->getRequest()->get('app');
        $path = $this->getRequest()->get('path');

        if ($this->getRequest()->get('temp')) {
            $file = waSystem::getInstance()->getTempPath($path, $app_id);
        } else {
            $file = waSystem::getInstance()->getDataPath($path, false, $app_id);
        }

        waFiles::readFile($file);
    }

    protected function saveFile($old_file = false) {
        $id = $this->getId();

        $rand = mt_rand();
        $name = "$rand.original.png";
        $filename = wa()->getDataPath("yosli", TRUE, 'shop') . '/' . $name;

        $yosliSlides = $this->getStorage()->read('yosliSlides');

        if (!isset($yosliSlides[$id]) || !file_exists($yosliSlides[$id])) {
            return;
        }

        $newFile = $yosliSlides[$id];

        try {
            $img = waImage::factory($newFile)
                ->save($filename);
        } catch (Exception $e) {
            $this->sendResponse( 'error: Unable to save new file '.$filename.' ('.pathinfo($filename, PATHINFO_EXTENSION).'): '.$e->getMessage() );
            return;
        }

        unset($yosliSlides[$id]);
        $this->getStorage()->write('yosliSlides', $yosliSlides);
        unlink($newFile);

        if ($old_file) {
            waFiles::delete(wa()->getDataPath("yosli/{$old_file}", TRUE, 'shop'));
        }

        return $name;
    }

    protected function sendResponse ($string) {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head></head><body onload="parent.yosliBackendSlides.uploadTmpimage();">'.
            $string
        .'</body></html>';
        exit();
    }

    protected function getPreviewUrl ($file) {
        return $this->getConfig()->getBackendUrl(true).'shop/?plugin=yosli&action=data&temp=1&path=yosli/'.$file;
    }

    protected function getId() {
        return wa()->getUser()->getId();
    }

}