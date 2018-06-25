<?php

class authenticationController extends Controller {

    public function login() {
        session_start();
        $this->view("authentication/login", [
            "title" => "Login",
            "error" => $_SESSION["loginError"]
        ]);
        $_SESSION["loginError"] = null;
        $this->view->render();
    }

    public function submitLogin() {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $form = $_POST;

            $user = userModel::verifyData([
                "email" => $form["email"]
            ]);

            if ($user["state"] == "ok") {
                $password = crypt($form["password"], '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/');

                if ($user["data"]["password"] == $password) {
                    // header("location:../dashboard");
                    echo json_encode(array(
                        "status"=> "success"
                    ));
                }
                else {
                    // session_start();
                    // $_SESSION["loginError"] = "User or password does not match";
                    // header("location:../authentication/login");
                    echo json_encode(array(
                        "status" => "error",
                        "message"=> "User or password does not match"
                    ));
                }
            }
        }
    }

    public function register() {
        $this->view("authentication/register", [
            "title" => "Register",
        ]);
        $this->view->render();
    }

}

?>