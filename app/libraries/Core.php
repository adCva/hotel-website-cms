<?php

// Core app class.
class Core
{

    // Controller and dynamic controller, method and parameters.
    protected $currentController = "Home";
    protected $currentMethod = "index";
    protected $parameters = [];


    public function __construct()
    {
        $url = $this->getUrl();

        // We want to look in the conrollers folder to see if the url exists there. Look for the first value [0].
        if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        } else {
            header("Location:" . URLROOT . "/home");
        }

        //Require the new set controller for it to work
        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;



        // Check if the current controller has the currentMethod.
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }


        // Get the rest of the url parameters [2, 3, 4 ....so on].
        $this->parameters = $url ? array_values($url) : [];

        // Callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
    }


    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
