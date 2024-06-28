<?php
    session_start();
    if( isset($_POST['task_name'])){
        if($_POST['task_name'] != ""){
            if(isset($_FILES['task_image'])){
                $ext = strtolower(substr( $_FILES['task_image']['name'], -4));
                $file_name = md5(date('Y.m.d.H.i.s')) . $ext;
                $dir = 'uploads/';

                move_uploaded_file( $_FILE['task_image']['tmp_name'], $dir.$file_name);
            }
            $data = [
                'task_name' => $_POST['task_name'],
                'task_description' => $_POST['task_description'],
                'task_date' => $_POST['task_date'],
                'task_image' => $file_name
            ];
            array_push($_SESSION['tasks'], $data);
            unset($_POST['task_name']);
            unset($_POST['task_description']);
            unset($_POST['task_date']);

            var_dump($_SESSION['tasks']);
            header('Location:http://localhost:8000');
        }
        else{
            $_SESSION['message'] = "O campo 'nome da tarefa' esta vazio";
            header('Location:http://localhost:8000');
        }
    }

    if(isset($_GET['key'])){
        array_splice($_SESSION['tasks'], $_GET['key'], 1);
        unset($_GET['key']);
        header('Location:http://localhost:8000');
    }

    var_dump($data);
    var_dump($_SESSION);
?>