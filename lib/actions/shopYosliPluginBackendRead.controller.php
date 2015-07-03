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

        $slide['title'] = htmlspecialchars($slide['title']);
        $slide['link']  = htmlspecialchars($slide['link']);
        $slide['sort']  = htmlspecialchars($slide['sort']);

        $this->response = $slide;
    }

}