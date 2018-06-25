<?php

class Controller {

    protected $view;

    protected function view($viewFile, $data=[]) {
        $this->view = new View($viewFile, $data);
        return $this->view;
    }

}

?>