<?php

require_once('IController.php');
require_once('Model/Student.php');
require_once('Model/Course.php');

class StudentController implements IController {

    private $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function index()
    {
        $result = $this->model->findAll();

        $couseModel = new Course();
        $courses = $couseModel->findAll();

        include('Views/PageHeader.php');
        include('Views/StudentList.php');
        include('Views/PageFooter.php');
    }

    public function add()
    {
        $couseModel = new Course();
        $courses = $couseModel->findAll();

        include('Views/PageHeader.php');
        include('Views/StudentForm.php');
        include('Views/PageFooter.php');
    }

    public function edit()
    {
        if(isset($_GET['id'])){ 
            $couseModel = new Course();
            $courses = $couseModel->findAll();

            $result = $this->model->find($_GET['id']);
            if(count($result) > 0){
                $student = $result[0];
                
                include('Views/PageHeader.php');
                include('Views/StudentForm.php');
                include('Views/PageFooter.php');

            }else{
                die("Aluno não encontrado.");
            }
        }else{
            die("ID não informado");
        }
    }

    public function save()
    {
        if(isset($_GET['id']))
            $this->model->setId($_GET['id']);

        $this->model->setName($_POST['name']);
        $this->model->setEmail($_POST['email']);
        $this->model->setPassword($_POST['password']);
        $this->model->setPhone($_POST['phone']);
        $this->model->setCourse($_POST['course']);
        $this->model->setStatus($_POST['status']);

        if($this->model->save()){
            $_SESSION['message']['text'] = "Aluno salvo com sucesso!";
            $_SESSION['message']['type'] = 1;
        }else{
            $_SESSION['message']['text'] = "Erro ao salvar aluno!";
            $_SESSION['message']['type'] = 0;
        }

        header("Location: index.php?c=student");
    }

    public function delete()
    {
        if(isset($_GET['id'])){

            if($this->model->delete($_GET['id'])){
                $_SESSION['message']['text'] = "Exclusão efetuada com sucesso!";
                $_SESSION['message']['type'] = 1;
            }else{
                $_SESSION['message']['text'] = "A exclusão falhou!";
                $_SESSION['message']['type'] = 0;
            }

            header("Location: index.php?c=student");
        }else{
            die("ID não informado.");
        }   
    }

    public function search()
    {
        $data[':NAME'] = "%".trim($_POST['name'])."%";
        $data[':COURSE'] = $_POST['course'];

        $result = $this->model->search($data);

        $couseModel = new Course();
        $courses = $couseModel->findAll();

        include('Views/PageHeader.php');
        include('Views/StudentList.php');
        include('Views/PageFooter.php');
    }
}