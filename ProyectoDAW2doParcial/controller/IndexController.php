<?php
require_once 'model/DTO/Menu.php';

class IndexController
{


    public function index()
    {

        $content = 'view/homeView.php';
        require_once 'view/layout.php';

    }
}
