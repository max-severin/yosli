<?php

class shopYosliPluginBackendLayout extends shopBackendLayout {

    public function execute() {
        parent::execute();
        $this->assign('page', 'yosli');
    }

}
