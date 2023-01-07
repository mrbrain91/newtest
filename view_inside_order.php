<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $payment_type = $_GET['payment_type'];
    $sale_agent = $_GET['sale_agent'];
    $contractor = $_GET['contractor'];
    $ord_date = $_GET['date'];

    $sum = get_sum_id_main($connect, $id)."<br>";
    $sum_count = sum_count_main($connect, $id)."<br>";
    
}


$query = "SELECT * FROM main_ord__item_tbl WHERE order_id='$id'";  
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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
        <span class="right_cus">Просмотр заказ</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
            <a href="order.php"><button type="button" class="btn btn-light">Закрыть</button></a>

        </div>
</div>

<div class="card_head">
    <div class="container-fluid">
        <form action="" class="horizntal-form">
            <div class="row">
                <div class="col-md-3">
                    <span>Дата сделки</span>
                </div>
                <div class="col-md-3">
                    <span>Условия оплаты</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 dash">
                 <?php echo $ord_date; ?>
                </div>
                <div class="col-md-3 dash">
                 <?php echo $payment_type; ?>
                </div>
            </div>
            <div class="row mt">
                <div class="col-md-3">
                    <span>Торговый представитель</span>
                </div>
                <div class="col-md-3">
                    <span>Контрагент</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 dash">
                <?php $user = get_user($connect, $sale_agent);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?>
                </div>
                <div class="col-md-3 dash">
                    <?php $user = get_contractor($connect, $contractor);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="add_pro_lab">
    <div class="container-fluid">
        Продукции 

    </div>
    <!-- <button type="button" class="btn btn-primary" id="addrow" >добавить строку</button>a -->

</div>

<div class="container-fluid">
    <table id="myTable" class="table table-striped table-bordered">
    <thead>
        <tr class="w600">
            <td>Продукция  / Производитель </td>
            <td>Количество</td>
            <td>Срок годности</td>
            <td>Цена</td>
            <td>Скидка</td>
            <td>Сумма</td>
        </tr>
    </thead>
    <tbody>
    <?php     
        while ($row = mysqli_fetch_array($rs_result)) {    
    ?> 
        <tr>
            <td class="col-sm-4" >
                <span><?php echo $row["prod_name"]; ?></span>
            </td>
            <td class="col-sm-1">
                <span><?php echo $row["count_name"]; ?></span>
            </td>
            <td class="col-sm-2">
                <span><?php echo $row["date_name"]; ?></span>
            </td>
            <td class="col-sm-1">
                <span><?php echo number_format($row['price_name']); ?></span>
                
            </td>
            <td class="col-sm-1">
                <span><?php echo $row["sale_name"]; ?></span>
            </td>
            <td class="col-sm-2">
                <span><?php echo number_format($row['total_name']); ?></span>
            </td>

        </tr>
    <?php     
        };    
    ?>
    </tbody>
    <tfooter>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="w600">Количество: <?php echo $sum_count; ?></td>
            <td class="w600">Сумма: <?php echo number_format($sum); ?></td>
        </tr>
    </tfooter>

</table>
</div>



<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>


</body>
</html>