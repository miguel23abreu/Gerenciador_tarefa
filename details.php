<?php
require __DIR__ . '/connect.php';
session_start();
$stmt = $pdo->prepare("SELECT * from tasks WHERE id = :id");
$stmt->bindParam(':id', $_GET['key']);
$stmt->execute();
$data = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de tarefas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="details-container">
        <div class="header">
            <h1><?php echo $data['task_name']?></h1>
        </div>
        <div class="row">
            <div class="details">
                <dl>
                    <dt>Descrição da Tarefa:</dt>
                    <dd><?php echo $data['task_description']?></dd>
                    <dt>Data da Tarefa:</dt>
                    <dd><?php echo $data['task_date']?></dd>
                </dl>
            </div>
            <div class="image">
                <img src="upload/<?php echo $data['task_image']?>" alt="image">
            </div>
            <div class="footer">
                <p>Desenvolvido por Miguel Abreu de Amorim Neto</p>
            </div>
        </div>
    </div>
</body>

</html>