<?php

require_once('IController.php');
require_once('Model/Course.php');

class CourseController implements IController {

    private $model;

    public function __construct()
    {
        $this->model = new Course();
    }

    public function index()
    {
        $result = $this->model->findAll();

        include('Views/PageHeader.php');
        include('Views/CourseList.php');
        include('Views/PageFooter.php');
    }

    public function add()
    {
        include('Views/PageHeader.php');
        include('Views/CourseForm.php');
        include('Views/PageFooter.php');
    }

    public function edit()
    {
        if(isset($_GET['id'])){ 
            $result = $this->model->find($_GET['id']);
            if(count($result) > 0){

                $course = $result[0];

                include('Views/PageHeader.php');
                include('Views/CourseForm.php');
                include('Views/PageFooter.php');

            }else{
                die("Curso não encontrado.");
            }
        }else{
            die("ID não informado");
        }
    }

    public function save()
    {
        if(isset($_GET['id']))
            $this->model->setId($_GET['id']);

        $this->model->setNameCourse($_POST['nameCourse']);
        $this->model->setDescription($_POST['description']);
        $this->model->setDateStart($_POST['dateStart']);
        $this->model->setDateFinish($_POST['dateFinish']);
        $this->model->setStatus($_POST['status']);
        
        if($this->model->save()){
            $_SESSION['message']['text'] = "Curso salvo com sucesso!";
            $_SESSION['message']['type'] = 1;
        }else{
            $_SESSION['message']['text'] = "Erro ao salvar curso!";
            $_SESSION['message']['type'] = 0;
        }

        header("Location: index.php?c=course");
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

            header("Location: index.php?c=course");
        }else{
            die("ID não informado.");
        }        
    }

    public function search()
    {
        $data[':NAME'] = "%".$_POST['name']."%";
        $data[':STATUS'] = $_POST['status'];

        $result = $this->model->search($data);

        include('Views/PageHeader.php');
        include('Views/CourseList.php');
        include('Views/PageFooter.php');
    }
}