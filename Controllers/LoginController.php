<?php

require_once('IController.php');

class LoginController implements IController {

    public function index()
    {
        $hideMenu = true;

        include('Views/PageHeader.php');
        include('Views/Login.php');
        include('Views/PageFooter.php');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == 'joao' && $password == '123456'){
            $_SESSION['logged'] = true;
            $_SESSION['message']['text'] = "Login efetuado com sucesso!";
            $_SESSION['message']['type'] = 1;
        }else{
            $_SESSION['message']['text'] = "Usuário ou senha incorretos!";
            $_SESSION['message']['type'] = 0;
        }

        header('Location: index.php');
    }

    public function logout()
    {
        $_SESSION['logged'] = false;
        $_SESSION['message']['text'] = "Você foi desconectado!";
        $_SESSION['message']['type'] = 1;

        header('Location: index.php');
    }
}