<?php

class dashboardController extends Controller {

    public function index() {
        $this->view("dashboard/index", [
            "title" => "Main"
        ]);
        $this->view->render();
    }

    public function clientes() {
        $clients = clientModel::getClients();

        $this->view("dashboard/usuarios/clientes", [
            "title" => "Clientes",
            "clients" => $clients["data"]
        ]);
        $this->view->render();
    }

    public function submitCliente() {
        if( isset($_POST["tipoID"]) && isset($_POST["ID"]) && isset($_POST["nombre"]) 
            && isset($_POST["nfantasia"]) && isset($_POST["telefono"]) && isset($_POST["email"]) && isset($_POST["provincia"])
            && isset($_POST["canton"]) && isset($_POST["distrito"]) && isset($_POST["barrio"]) && isset($_POST["direccion"])){

                $data = [
                    "tipoID"=>$_POST["tipoID"],
                    "ID"=>$_POST["ID"],
                    "nombre"=>$_POST["nombre"],
                    "nfantasia"=>$_POST["nfantasia"],
                    "telefono"=>$_POST["telefono"],
                    "email"=>$_POST["email"],
                    "provincia"=>$_POST["provincia"],
                    "canton"=>$_POST["canton"],
                    "distrito"=>$_POST["distrito"],
                    "barrio"=>$_POST["barrio"],
                    "direccion"=>$_POST["direccion"]
                ];

                $response = clientModel::newClient($data);
                
                if ($response["status"] == "success") {
                    $client = clientModel::getClient($data["ID"]);
                    if ($client["status"] == "success") {
                        echo json_encode(array(
                            "status" => "success",
                            "client" => $client["data"]
                        ));
                        return;
                    }
                }
                echo json_encode(array(
                    "status" => "error"
                ));
                // if ($response["status"] == "success") {
                //     echo $response["email"];
                //     // $client = clientModel::getClient($response["id"]);
                //     // if ($client["status"] == "success") {
                //     //     echo json_encode(array(
                //     //         "status" => "success",
                //     //         "client" => $client["data"]
                //     //     ));
                //     // }
                //     // else {
                //     //     echo json_encode(array(
                //     //         "status" => "error",
                //     //         "message" => $client["message"]
                //     //     ));
                //     // }
                // }
                // else if ($response["status"] == "error") {
                //     echo json_encode(array(
                //         "status" => "error",
                //         "message" => $response["message"]
                //     ));
                // }
            
            }
    }
}

?>