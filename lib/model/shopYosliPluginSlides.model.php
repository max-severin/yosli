<?php

/*
 * Class shopYosliPluginSlidesModel
 * @author Max Severin <makc.severin@gmail.com>
 */
class shopYosliPluginSlidesModel extends waModel {

    protected $table = 'shop_yosli_slide';

    public function getSlides() {
        $slides = $this->order('sort DESC, id DESC')->fetchAll();

        foreach ($slides as $id => $slide) {
            $slides[$id]['title'] = htmlspecialchars($slide['title']);
            $slides[$id]['alt']   = htmlspecialchars($slide['alt']);
            $slides[$id]['link']  = htmlspecialchars($slide['link']);
            $slides[$id]['sort']  = htmlspecialchars($slide['sort']);
        }

        return $slides;
    }

}