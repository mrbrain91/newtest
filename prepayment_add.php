<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

$last_id = get_id_new_order($connect);


if(isset($_POST['submit']) && $_POST['submit'] == 'Сохранить') {

        $id_counterpartie = $_POST['id_counterpartie'];
        $prepayment_date = $_POST['prepayment_date'];
        $prepayment_sum = $_POST['prepayment_sum'];
        $payment_type = $_POST['payment_type'];
    add_main_prepayment($connect, $id_counterpartie, $prepayment_date, $prepayment_sum, $payment_type);
    // add_prepayment($connect, $id_counterpartie, $prepayment_date, $prepayment_sum, $payment_type);
}

//get counterparties
$sql = "SELECT * FROM counterparties_tbl";
$counterparties_tbl = mysqli_query ($connect, $sql);


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>ortosavdo</title>
</head>
<body>
    
<?php include 'partSite/nav.php'; ?>

<div class="page_name">
    <div class="container-fluid">
        <i class="fa fa-clone" aria-hidden="true"></i>
        <i class="fa fa-angle-double-right right_cus"></i>
        <span class="right_cus">Добавление оплата</span>
    </div>    
</div>

<div class="toolbar">
    <div class="container-fluid">
        <!-- <button type="button" class="btn btn-primary">Сохранить</button> -->
        <!-- <button type="submit" form="order_form" name="save_add_pro" class="btn btn-success">Принять</button> -->
        <td><input class="btn btn-success" type="submit" form="user_form" name="submit" value="Сохранить" />

        <a href="prepayment_list.php"><button type="button" class="btn btn-light">Закрыть</button></a>

    </div>
</div>

<section class="card_head">
    <div class="container-fluid">
        <form action="" method="POST" class="horizntal-form" id="user_form">

            
            <div class="row">
                <div class="col-md-3">
                        <span>Дата</span>
                </div>
            </div>
            <div class="row">
               
            <div class="col-md-3">
                    <input required type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="prepayment_date">
                </div>
            </div>
            <div class="row mt">
                <div class="col-md-3">
                    <span>Контрагент</span>
                </div>
                <div class="col-md-3">
                    <span>Баланс контрагента</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"> 
                <select required class="normalize" name="id_counterpartie">
                        <option value=""></option>
                        <?php    
                            while ($option_contractor = mysqli_fetch_array($counterparties_tbl)) {    
                        ?>
                            <option value="<?php echo $option_contractor["id"];?>"><?php echo $option_contractor["name"]?></option>
                        <?php
                            };    
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input disabled type="text" class="form-control" value="22 000">
                </div>
            </div>
            <div class="row mt">
                <div class="col-md-3">
                    <span>Тип оплаты</span>
                </div>
                <div class="col-md-3">
                    <span>Сумма</span>
                </div>
            </div>
            <div class="row">
            <div class="col-md-3">
                    <select required name="payment_type" class="normalize"">
                        <option value=""></option>
                        <option value="Перечисление">Перечисление</option>
                        <option value="Наличные деньги">Наличные деньги</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input required type="number" class="form-control" name="prepayment_sum">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>

</body>
</html>

<script>
$('.normalize').selectize();
</script>

