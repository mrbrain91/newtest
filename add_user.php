<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

$last_id = get_id_new_order($connect);


if(isset($_POST['submit']) && $_POST['submit'] == 'Сохранить') {
    add_user($connect);
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>ortosavdo</title>
</head>
<body>
    
<?php include 'partSite/nav.php'; ?>

<div class="page_name">
    <div class="container-fluid">
        <i class="fa fa-clone" aria-hidden="true"></i>
        <i class="fa fa-angle-double-right right_cus"></i>
        <span class="right_cus">Добавление пользователя</span>
    </div>    
</div>

<div class="toolbar">
    <div class="container-fluid">
        <!-- <button type="button" class="btn btn-primary">Сохранить</button> -->
        <!-- <button type="submit" form="order_form" name="save_add_pro" class="btn btn-success">Принять</button> -->
        <td><input class="btn btn-success" type="submit" form="user_form" name="submit" value="Сохранить" />

        <a href="users.php"><button type="button" class="btn btn-light">Закрыть</button></a>

    </div>
</div>

<section class="card_head">
    <div class="container-fluid">
        <form action="" method="POST" class="horizntal-form" id="user_form">

            <div class="row ">
                <div class="col-md-3">
                    <span>Имя</span>
                </div>
                <div class="col-md-3">
                    <span>Фамилия</span>
                </div>
                <div class="col-md-3">
                    <span>Отчество</span>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-3"> 
                    <input required type="text" class="form-control" name="name" form="user_form">
                </div>
                <div class="col-md-3">
                    <input required type="text" class="form-control" name="surname" form="user_form">
                </div>
                <div class="col-md-3">
                    <input required type="text" class="form-control" name="fathername" form="user_form">
                </div>
            </div>
            <div class="row mt">
                <div class="col-md-3">
                    <span>Логин</span>
                </div>
                <div class="col-md-3">
                    <span>Пароль</span>
                </div>
                <div class="col-md-3">
                    <span>Роль</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input required type="text" class="form-control" name="login" form="user_form">
                </div>
                <div class="col-md-3">
                    <input required type="password" class="form-control" name="pass" form="user_form">
                </div>
                <div class="col-md-3">
                    <select required name="role" form="user_form" class="form-control"">
                    <option value=""></option>
                    <option value="administrator">Администратор</option>
                    <option value="sale">Торговый представитель</option>
                    <option value="operator">Оператор</option>
                    <option value="storekeeper">Складовик</option>
                </select>
                </div>
            </div>
            <div class="row mt">
                <div class="col-md-3">
                    <span>Статус</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                     <input checked type="radio" id="active" name="status" form="user_form" value="1">
                     <label for="active">Активный</label><br>
                     <input type="radio" id="noactive" name="status" form="user_form" value="0">
                     <label for="noactive">Неактивный</label><br>
                </div>
            </div>
        </form>
    </div>
</section>



<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>

