<?php

/*
 * Class shopYosliPluginBackendLayout
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginBackendLayout extends shopBackendLayout {

    public function execute() {
        parent::execute();
        $this->assign('page', 'yosli');
    }

}