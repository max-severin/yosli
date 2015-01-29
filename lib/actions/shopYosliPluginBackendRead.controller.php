<?php
class shopYosliPluginBackendReadController extends waJsonController
{
    public function execute()
    {   
        $id = (int)waRequest::get('id');      
        
        $model = new shopYosliPluginSlidesModel();
        $slide = $model->getById($id);

        $this->response = $slide;
    }    
}
