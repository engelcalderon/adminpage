<?php

class dashboardController extends Controller {

    public function index() {
        $this->view("dashboard/index", [
            "title" => "Main"
        ]);
        $this->view->render();
    }
}

?>