<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

$query = "SELECT * FROM users_tbl ORDER by id DESC";  
$rs_result = mysqli_query ($connect, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <span class="right_cus">Пользователи</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
           <a href="add_user.php"> <button type="button" class="btn btn-success">Добавить</button> </a>
        </div>
</div>



<!-- <table class="table table-hover">
    <thead>
        <th></th><th></th><th></th>
    </thead>
    
    <tbody>
        <tr data-toggle="collapse" data-target="#accordion" class="clickable">
            <td>Some Stuff</td>
            <td>Some more stuff</td>
            <td>And some more</td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="accordion" class="collapse">Hidden by default</div>
            </td>
        </tr>
    </tbody>
</table> -->



<div class="all_table">
    <div class="container-fluid">
        <table class="table table-hover table-bordered">
        <thead>
            <tr>
            <th scope="col">Название</th>
            <th scope="col">Логин</th>
            <th scope="col">Роль</th>
            <th scope="col">Статус</th>
            <th scope="col">Просмотр</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
            </tr>
        </thead>
        <tbody>
<?php     
    while ($row = mysqli_fetch_array($rs_result)) {    
?> 
    <tr>
        <td><?php echo $row["surname"]; ?>&nbsp;<?php echo $row["name"];?>&nbsp;<?php echo $row["fathername"]; ?></td>
        <td><?php echo $row["login"]; ?></td>
        <td><?php 
            if ($row["role"]=='administrator') {
               echo "Администратор";
            }elseif ($row["role"]=='operator') {
               echo "Оператор";
            }elseif ($row["role"]=='sale') {
                echo "Торговый представитель";
             }elseif ($row["role"]=='storekeeper') {
                echo "Складовик";
             }
            ?></td>
        <td><?php 
        if ($row["status"] == 1) {
            echo "Активный";
        }
        else {
            echo "Неактивный";
        }
        ?></td>
        <td><a href="#">Просмотр</a></td>
        <td><a href="#">Редактировать</a></td>
        <td><a href="#" onclick="return confirm('Удалить?')" role="button">Удалить</a></td>
    </tr>
<?php       
    };    
?>
        </tbody>
        </table>
    </div>
</div>




<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>


</body>
</html>