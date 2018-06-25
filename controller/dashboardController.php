<?php

class dashboardController extends Controller {

    public function index() {
        $this->view("dashboard/index", [
            "title" => "Main"
        ]);
        $this->view->render();
    }

    public function clientes() {
        $this->view("dashboard/usuarios/clientes", [
            "title" => "Clientes"
        ]);
        $this->view->render();
    }
}

?>