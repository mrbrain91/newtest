<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}



// $query = "SELECT * FROM settlements WHERE status='0' AND debt>'0' ORDER BY id DESC";
// $rs_result = mysqli_query ($connect, $query);

 

$query = "SELECT * FROM debts WHERE prepayment > '0' ORDER BY id DESC";
$rs_result = mysqli_query ($connect, $query);

// $row1 = mysqli_fetch_assoc(mysqli_query($connect, $query1));
// $total_prepayment = $row1['total_prepayment'];


?>


<!DOCTYPE html>
<html lang="ru">
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
        <span class="right_cus">История взаимарасчетов</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
           <!-- <a href="#"> <button type="button" class="btn btn-success">Взаимозачет</button> </a> -->
           <!-- <a href="add_order.php"> <button type="button" class="btn btn-primary">должники</button> </a> -->
           <a href="settlements_clients.php"> <button type="button" class="btn">закрыть</button> </a>
        </div>
</div>

<div class="all_table">
    <div class="container-fluid">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">Н/З</th>
            <th scope="col">Контрагент</th>
            <th scope="col">Дата пересчета</th>
            <th scope="col">Тип оплатаы</th>
            <th scope="col">Сумма</th>
            <th>Отмена</th>

            </tr>
        </thead>
        <tbody>


            <?php     
                $i = 0;
                while ($row = mysqli_fetch_array($rs_result)) {
                $i++;
            ?> 

            <tr data-toggle="collapse" data-target="#hidden_<?php echo $i;?>">
                <td><?php echo $row["order_id"]; ?></td>
                <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
                <td><?php echo $row["order_date"]; ?></td>
                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo $row["prepayment"]; ?></td>
                <td><a href="#">отмена</a></td>
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