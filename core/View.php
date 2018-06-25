<?php

class View {

    protected $viewFile;
    protected $data = [];

    public function __construct($viewFile, $data) {
       $this->viewFile = $viewFile;
       $this->data = $data;
    }

    public function render() {
        if (file_exists(VIEW . $this->viewFile . '.phtml')) {
            include VIEW . $this->viewFile . '.phtml';
        }
    }

    public function getFormData() {
        return $_POST;
    }

}

?>