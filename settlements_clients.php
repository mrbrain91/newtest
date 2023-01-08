<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}



// $query = "SELECT * FROM settlements WHERE status='0' AND debt>'0' ORDER BY id DESC";
// $rs_result = mysqli_query ($connect, $query);

 

$query = "SELECT id_counterpartie, SUM(prepayment) as total_prepayment, SUM(debt) AS total_debt, SUM(main_prepayment) AS total_main_prepayment FROM debts GROUP BY id_counterpartie";
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
        <span class="right_cus">Взаиморасчеты с клиентами</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
           <!-- <a href="#"> <button type="button" class="btn btn-success">Взаимозачет</button> </a> -->
           <a href="debtor.php"> <button type="button" class="btn btn-primary">должники</button> </a>
           <a href="booked_payment_list.php"> <button type="button" class="btn">история взаимарасчетов</button> </a>
        </div>
</div>

<div class="all_table">
    <div class="container-fluid">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">Контрагент</th>
            <th scope="col">ИНН</th>
            <th scope="col">Долг</th>
            <th scope="col">Предоплата</th>
            <th scope="col">Заказ</th>
            <th scope="col">Итог</th>
            <th scope="col">Детали</th>
            </tr>
        </thead>
        <tbody>


            <?php     
                $i = 0;
                while ($row = mysqli_fetch_array($rs_result)) {
                $i++;
                
                $last_debt = $row['total_debt']- $row['total_prepayment'];
                $last_tot = $row['total_main_prepayment'] - $row['total_prepayment'];
                if ($last_debt == 0 AND $last_tot == 0 ) {
                  $display = 'none';
                }else {
                  $display = 'true';
                }
            ?> 

            <tr style="display:<?php echo $display; ?>;" data-toggle="collapse" data-target="#hidden_<?php echo $i;?>">
            <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
            <td><?php echo $user['inn']?></td>
                <td><?php echo $last_debt; ?></td>
                <td><?php echo $last_tot; ?></td>
                <td>0</td>
                <td><?php echo $sum = $last_debt - $last_tot; ?></td>
                <td><a href="settlement_detail.php?id=<?php echo $row["id_counterpartie"]?>&&prepayment=<?php echo $last_tot;?>">Детали</a></td>
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