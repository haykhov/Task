<?php

class Controller
{
    /**
     * Load Model
     *
     * @author Hayk Hovhannisyan <haykhovhannisyanm@gmail.com>
     * @param $model
     * @return object
     */
    public function model($model) {
        /* Require model file */
        require_once '../app/models/' . $model . '.php';
        /* Instantiate model */
        return new $model();
    }

    /**
     * Load Model
     *
     * @author Hayk Hovhannisyan <haykhovhannisyanm@gmail.com>
     * @param $view
     */
    public function view($view) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
