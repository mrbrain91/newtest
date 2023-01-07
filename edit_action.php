<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}


if (isset($_GET['pn'])) {
    $orid = $_GET['orid'];
    $pi = $_GET['pi'];
    $pn = $_GET['pn'];
    $cn = $_GET['cn'];
    $prn = $_GET['prn'];
    $sn = $_GET['sn'];
    $dn = $_GET['dn'];


    $id = $_GET['id'];
    $sum = $_GET['sum'];
    $date = $_GET['date'];
    $note = $_GET['note'];
}


$a = 'Пластырь One Aid PVC 19x72 №500';
$b = 'Пластырь One Aid PVC 19x72 №100';
$c = 'Пластырь One Aid PVC 19x72 №8';
$d = 'Пластырь One Aid PVC 25x72 №7';
$e = 'Пластырь One Aid PVC 38x72 №5';
$f = 'Пластырь One Aid PVC MIX №12';
$g = 'Пластырь One Aid PU 19x72 №5';
$h = 'Пластырь One Aid PU 38x72 №3';
$i = 'Пластырь One Aid PU MIX №9';
$j = 'Пластырь One Aid PU 60x70 №3';

if(isset($_POST['submit']) && $_POST['submit'] == 'Сохранить') {

$torid=$_POST['orid'];
$tpi=$_POST['pi'];

$tsum = $_POST['sum'];
$tdate = $_POST['date'];
$tnote = $_POST['note'];


$tp_name=$_POST['prod_name'];
$tc_name=$_POST['count_name'];
$td_name=$_POST['date_name'];                   
$tpr_name=$_POST['price_name'];
$ts_name=$_POST['sale_name'];
$tt_name = ($tc_name * $tpr_name) - ($tc_name * $tpr_name * $ts_name) / 100;



if (upd_prod_item($connect, $torid, $tpi, $tp_name, $tc_name, $td_name, $tpr_name, $ts_name, $tt_name)) {


    header("Location: edit_pro.php?id=".$torid."&&date=".$tdate."&&sum=".$tsum."&&note=".$tnote."");
}
    
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
        <span class="right_cus">Просмотр прихода продукции</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
            <input class="btn btn-success" type="submit" form="order_form" name="submit" value="Сохранить" />


            <a href="in_store.php"><button type="button" class="btn btn-light">Закрыть</button></a>
        </div>
</div>




<div class="add_pro_lab">
    <div class="container-fluid">
        Продукции 

    </div>

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
            <!-- <td>Сумма</td>  -->
        </tr>
    </thead>
    <tbody>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="horizntal-form" id="order_form">
        <tr>
        <td class="col-sm-4">
                    <select name="prod_name" form="order_form" class="form-control">
                        <option value="<?php echo $pn;?>"><?php echo $pn;?></option>
                        <option value="<?php echo $a;?>"><?php echo $a;?></option>
                        <option value="<?php echo $b;?>"><?php echo $b;?></option>
                        <option value="<?php echo $c;?>"><?php echo $c;?></option>
                        <option value="<?php echo $d;?>"><?php echo $d;?></option>
                        <option value="<?php echo $e;?>"><?php echo $e;?></option>
                        <option value="<?php echo $f;?>"><?php echo $f;?></option>
                        <option value="<?php echo $g;?>"><?php echo $g;?></option>
                        <option value="<?php echo $h;?>"><?php echo $h;?></option>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <option value="<?php echo $j;?>"><?php echo $j;?></option>


                       
                    </select>

                </td>
                <td class="col-sm-1">
                    <input required type="text" name="count_name"  class="form-control" form="order_form" value="<?php echo $cn;?>"/>                  
                </td>
                <td class="col-sm-2">
                    <input required type="date" name="date_name"  class="form-control" form="order_form" value="<?php echo $dn;?>"/>
                    
                </td>
                <td class="col-sm-1">
                    <input required type="text" name="price_name"  class="form-control" form="order_form" value="<?php echo $prn;?>"/>
                    
                </td>
                <td class="col-sm-1">
                <input required type="text" name="sale_name"  class="form-control" form="order_form" value="<?php echo $sn;?>"/>
                <input  type="hidden" name="orid"  form="order_form" value="<?php echo $orid;?>"/>
                <input  type="hidden" name="pi"  form="order_form" value="<?php echo $pi;?>"/>

                <input  type="hidden" name="sum"  form="order_form" value="<?php echo $sum;?>"/>
                <input  type="hidden" name="date"  form="order_form" value="<?php echo $date;?>"/>
                <input  type="hidden" name="note"  form="order_form" value="<?php echo $note;?>"/>
                    
                </td>
                <!-- <td class="col-sm-2">
                    <input disabled type="text" name="total_name"  class="form-control" form="order_form"/>
                    
                </td> -->

        </tr>
    </form>
    </tbody>
    <tfooter>
    </tfooter>

</table>
</div>



<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>


</body>
</html>