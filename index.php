<?php

session_start();

function loadController($nameController, $nameFunction = 'index')
{
    $nameController .= "Controller";
    require_once('Controllers/'.$nameController.'.php');

    $controller = new $nameController();
    $controller->$nameFunction();
}

function isLogged()
{
    if(isset($_SESSION['logged'])){
        if($_SESSION['logged']){
            return true;
        }
    }

    return false;
}

if(isLogged()){
    if(isset($_GET['c'])){
        $nameController = $_GET['c'];
    
        if(isset($_GET['f']))
            loadController($nameController, $_GET['f']);
        else
            loadController($nameController);
    }else{
        loadController('course');
    }
}else{
    if(isset($_GET['c'])){
        if($_GET['c'] == 'login'){
            if(isset($_GET['f'])){
                if($_GET['f'] == 'login'){
                    loadController('login', 'login');
                    die();
                }
            }
        }
    }
    
    loadController('login');
}
