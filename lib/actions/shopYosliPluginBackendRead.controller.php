<?php

/*
 * Class shopYosliPluginBackendReadController
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginBackendReadController extends waJsonController {

    public function execute() {
        $id = (int)waRequest::get('id');      
        
        $model = new shopYosliPluginSlidesModel();
        $slide = $model->getById($id);

        $this->response = $slide;
    }

}