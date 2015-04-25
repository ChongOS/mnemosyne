<?php

class ImagesController extends AppController {

    public $uses = [];
    
     
    public function deleteFile($file) {
        $this->autoRender = false;
        if ($this->request->is('delete')) {
            $_GET['file'] = $file;
            $this->Upload->deleteFile(array('image_versions' => array('' => array(), 'thumbnail' => array())));
        }
    }

    public function upload() {
        $this->autoRender = false;
        $handler = $this->Upload->uploadFile(array(
            'image_versions' => array(
                '' => array(
                    'max_width' => 500,
                    'max_height' => 375,
                    'jpeg_quality' => 95
                ),
                'thumbnail' => array(
                    'max_width' => 200,
                    'max_height' => 200
                )
            )
        ));
    }


}