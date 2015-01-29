<?php
class shopYosliPluginBackendDeleteController extends waJsonController
{
    public function execute()
    {           
        $id = (int)waRequest::get('id');                          
        $old_file = waRequest::get('old_filename');  
        
        $model = new shopYosliPluginSlidesModel();

        if ( $model->deleteById($id) ) {  
            if ($old_file) {
                waFiles::delete(wa()->getDataPath("yosli/{$old_file}", TRUE, 'shop'));
            }          
            $this->response = true;
        } else {
            $this->response = false;
        } 
            
    }
    
}
