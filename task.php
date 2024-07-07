<?php
    require __DIR__ . '/connect.php';
    session_start();

    if( isset($_POST['task_name'])){
        if($_POST['task_name'] != ""){
            if(isset($_FILES['task_image'])){
                $ext = strtolower(substr( $_FILES['task_image']['name'], -4));
                $file_name = md5(date('Y.m.d.H.i.s')) . $ext;
                $dir = 'uploads/';

                move_uploaded_file( $_FILE['task_image']['tmp_name'], $dir.$file_name);
            }
            $stmt = $pdo->prepare('INSERT INTO tasks(task_name, task_description, task_image, task_date) VALUES (:name, :description, :image, :date)');
            $stmt->bindParam('name', $_POST['task_name']);
            $stmt->bindParam('description', $_POST['task_description']);
            $stmt->bindParam('image', $file_name);
            $stmt->bindParam('date', $_POST['task_date']);

            if($stmt->execute() ){
                $_SESSION['sucess'] = "Dados Cadastrados.";
                header('Location:http://localhost:8000/index.php');    
            }
            else{
                $_SESSION['error'] = "Dados não Cadastrados.";
                header('Location:http://localhost:8000/index.php');
            }
            
        }
        else{
            $_SESSION['message'] = "O campo 'nome da tarefa' esta vazio";
            header('Location:http://localhost:8000/index.php');
        }
    }

    if(isset($_GET['key'])){
        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $_GET['key']);
        if($stmt->execute() ){
            $_SESSION['sucess'] = "Dados Removidos.";
            header('Location:http://localhost:8000/index.php');    
        }
        else{
            $_SESSION['error'] = "Dados não Removidos.";
            header('Location:http://localhost:8000/index.php');
        }
        header('Location:http://localhost:8000');
    }

    var_dump($data);
    var_dump($_SESSION);
?>