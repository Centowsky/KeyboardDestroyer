<?php

require_once '../framework/Controller.php';

class AdminController extends Controller {
    public function run() {
        $this->view->render('admin');
    }
}