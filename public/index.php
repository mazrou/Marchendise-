<?php
        namespace PHPMVC;

        use PHPMVC\LIB\FrontController;
   
        if(!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        require_once '..' . DS . 'app' . DS . 'config.php';

        require_once APP_PATH  . 'lib' . DS . 'autoload.php';

        $frontcontroller= new FrontController();

        $frontcontroller->dispatch();


