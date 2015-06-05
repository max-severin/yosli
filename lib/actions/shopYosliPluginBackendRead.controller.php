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

        $slide['title'] = addslashes(htmlspecialchars($slide['title']));
        $slide['link']  = addslashes(htmlspecialchars($slide['link']));
        $slide['sort']  = addslashes(htmlspecialchars($slide['sort']));

        $this->response = $slide;
    }

}