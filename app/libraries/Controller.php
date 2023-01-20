<?php

// Base controller
class Controller
{

    // Core model method.
    public function model($model)
    {
        // Require model file.
        require_once "../app/models/" . ucwords($model) . ".php";

        // Instantiate model.
        return new $model;
    }



    // Core view method.
    public function view($view, $data = [])
    {
        if (file_exists("../app/views/" . $view . ".php")) {
            require_once "../app/views/" . $view . ".php";
        } else {
            die("No such view exists.");
        }
    }
}
