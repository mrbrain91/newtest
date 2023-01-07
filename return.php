<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}
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
        <span class="right_cus">Возврат</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
           <a href="add_order.php"> <button type="button" class="btn btn-success">Добавить</button> </a>
        </div>
</div>

<div class="all_table">
    <div class="container-fluid">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">Контрагент</th>
            <th scope="col">Добавил</th>
            <th scope="col">Дата возврата</th>
            <th scope="col">Тип оплаты</th>
            <th scope="col">Сумма</th>
            <th scope="col">Накладные</th>
            <th scope="col">Просмотр</th>
            <th scope="col">Редактировать</th>
            

            </tr>
        </thead>
        <tbody>
            <tr>
            <td>ООО "EURO PHARM MARKET"</td>
            <td>Khamidov Khakimjon Makhmudovich</td>
            <td>20.12.2021</td>
            <td>Перечисление</td>
            <td>2 214 000</td>
            <td><a href="">Счет-фактура</a></td>
            <td><a href="view_prod.php">Просмотр</a></td>
            <td><a href="edit_pro.php">Редактировать</a></td>

            </tr>
            <tr>
            <td>ООО "EURO PHARM MARKET"</td>
            <td>Khamidov Khakimjon Makhmudovich</td>
            <td>20.12.2021</td>
            <td>Перечисление</td>
            <td>2 214 000</td>
            <td><a href="">Счет-фактура</a></td>
            <td><a href="view_prod.php">Просмотр</a></td>
            <td><a href="edit_pro.php">Редактировать</a></td>

            </tr>
            <tr>
            <td>ООО "EURO PHARM MARKET"</td>
            <td>Khamidov Khakimjon Makhmudovich</td>
            <td>20.12.2021</td>
            <td>Наличные деньги</td>
            <td>2 214 000</td>
            <td><a href="">Счет-фактура</a></td>
            <td><a href="view_prod.php">Просмотр</a></td>
            <td><a href="edit_pro.php">Редактировать</a></td>
            
            </tr>
        </tbody>
        </table>
    </div>
</div>




<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>


</body>
</html>