<?php

class App {

    // protected $controller = 'homeController';
    // protected $action = 'index';
    // protected $params = [];

    public $urlpatterns = [
        // use /: to add parameters
        "authentication/login"=>["authenticationController", "login"],
        "authentication/submitLogin"=>["authenticationController", "submitLogin"],
        "authentication/register"=>["authenticationController", "register"],

        // dashboard
        "dashboard"=>["dashboardController", "index"],
        "dashboard/clientes"=>["dashboardController", "clientes"],
        "dashboard/clientes/submitCliente"=>["dashboardController", "submitCliente"],
    ];

    public function __construct() {
        // $this->parseURL();

        // if (file_exists(CONTROLLER . $this->controller . '.php')) {
        //     $this->controller = new $this->controller;
        //     if (method_exists($this->controller, $this->action)) {
        //         call_user_func_array([$this->controller, $this->action], $this->params);
        //     }
        // }
        // else {
        //     echo "Page does not exist";
        // }
        
        foreach($this->urlpatterns as $key => $value) {
            $request = trim($_GET['url'], '/');

            $webURL = explode('/', $request);
            $setURL = explode('/', $key);

            $found = "no";
            
            if ($webURL[0] == $setURL[0]) {
                if (count($webURL) == count($setURL)) {
                    $parameters = [];
                    $state = "same";
                    for($i = 0; $i < count($webURL); $i++) {
                        if ($webURL[$i] != $setURL[$i]) {
                            if (strpos($setURL[$i], ":") === false) {
                                $state = "different";
                                break;
                            }
                            else {
                                array_push($parameters, $webURL[$i]);
                            }
                        }
                    }
                    if ($state == "same") { // if found controller call it here
                        $this->path($key, new $value[0], $value[1], $parameters);
                        $found = "yes";
                        break;
                    } 
                    else {
                        $parameters = [];
                    }
                }
            }
        }

        if ($found == "no") {
            echo "URL does not exist";
        }
    }

    protected function path($url, $controller, $method, $parameters) {
        call_user_func_array([$controller, $method], $parameters);
    }

    // protected function parseURL() {
    //     $request = trim(isset($_GET['url']) ? $_GET['url'] : 'home', '/');
    //     if (!empty($request)) {
    //         $url = explode('/', $request);
    //         $this->controller = isset($url[0]) ? $url[0] . 'Controller' : 'homeController';
    //         $this->action = isset($url[1]) ? $url[1] : 'index';
    //         unset($url[0], $url[1]);
    //         $this->params = !empty($url) ? array_values($url) : [];
    //     }
    // }

}

?>