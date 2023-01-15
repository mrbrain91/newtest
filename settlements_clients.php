<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}
 

$query = "SELECT id_counterpartie, SUM(prepayment) as total_prepayment, SUM(debt) AS total_debt, SUM(main_prepayment) AS total_main_prepayment FROM debts GROUP BY id_counterpartie";
$rs_result = mysqli_query ($connect, $query);


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
           <!-- <a href="add_order.php"> <button type="button" class="btn btn-primary">должники</button> </a> -->
           <a href="booked_payment_list.php"> <button type="button" class="btn btn-primary">история взаимарасчетов</button> </a>
        </div>
</div>

<div class="all_table">
    <div class="container-fluid">
        <table class="table table-striped table-bordered" style="margin-bottom:0;">
        <thead>
            <tr>
            <th scope="col">Контрагент</th>
            <th scope="col">ИНН</th>
            <th scope="col">Долг</th>
            <th scope="col">Предоплата</th>
            <th scope="col">Итог</th>
            <th scope="col">Перерасчёт</th>
            </tr>
        </thead>
        <tbody>


            <?php     
                $i = 0;
                $sum_last_debt = 0;
                $sum_last_tot = 0;
                $balance_sum = 0;
                
                while ($row = mysqli_fetch_array($rs_result)) {
                
                
                $last_debt = $row['total_debt']- $row['total_prepayment'];
                $last_tot = $row['total_main_prepayment'] - $row['total_prepayment'];
                $sum = $last_tot - $last_debt;

                $sum_last_debt += $last_debt;
                $sum_last_tot += $last_tot;
                $balance_sum += $sum;
                
                


                if ($last_debt == 0 AND $last_tot == 0 ) {
                    $display = 'none';
                  }else {
                    $display = 'true';
                    $i++;
                  }
            ?> 

            <tr class="rowDis" style="display:<?php echo $display; ?>;" data-toggle="collapse" data-target="#hidden_<?php echo $i;?>">
            <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
            <td><?php echo $user['inn']?></td>
                <td><?php echo number_format($last_debt, 0, ',', ' '); ?></td>
                <td><?php echo number_format($last_tot, 0, ',', ' '); ?></td>
                <td><?php echo number_format($sum, 0, ',', ' '); ?></td>
                <td><a href="settlement_debts_detail.php?id=<?php echo $row["id_counterpartie"]?>&&prepayment=<?php echo $last_tot;?>">Перерасчёт</a></td>
            </tr>

            <?php       
                };     
            ?>
        </tbody>
        </table>
        <table class="table" style="background-color:#ebf0ff; border-left: 4px solid #7396ff;">
            <tr>
                <td style="text-align:center;">Количество: <?php echo number_format($i, 0, ',', ' '); ?></td>
                <td style="text-align:center;">Сумма долгов: <?php echo number_format($sum_last_debt, 0, ',', ' '); ?></td>
                <td style="text-align:center;">Сумма предоплат: <?php echo number_format($sum_last_tot, 0, ',', ' '); ?></td>
                <td style="text-align:center;">Итоговая сумма: <?php echo number_format($balance_sum, 0, ',', ' '); ?></td>
                
            </tr>
        </table>
    </div>
</div>






<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>

</body>
</html>