<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

//---get counterparties
$sql = "SELECT * FROM counterparties_tbl";
$counterparties_tbl = mysqli_query ($connect, $sql);


$count_query = "SELECT count(*) as allcount FROM debts WHERE prepayment > '0' ORDER BY id DESC";
$count_result = mysqli_query($connect,$count_query);
$count_fetch = mysqli_fetch_array($count_result);
$postCount = $count_fetch['allcount'];
$limit = 10;


$all_debt_query = "SELECT sum(prepayment) as all_debt, count(id) as allcount FROM debts WHERE prepayment > '0'";
$all_debt_result = mysqli_query ($connect, $all_debt_query);
$all_debt_fetch = mysqli_fetch_array($all_debt_result);
$all_debt = $all_debt_fetch['all_debt'];
$all_count = $all_debt_fetch['allcount'];



 
$query = "SELECT * FROM debts WHERE prepayment > '0' ORDER BY id desc LIMIT 0,".$limit;
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
        <span class="right_cus">История взаимарасчетов</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
           <!-- <a href="#"> <button type="button" class="btn btn-success">Взаимозачет</button> </a> -->
           <!-- <a href="add_order.php"> <button type="button" class="btn btn-primary">должники</button> </a> -->
           <div class="toolbar_wrapper">
                <div><a href="settlements_clients.php"> <button type="button" class="btn">закрыть</button> </a></div>

                <div class="filter-container">
                    <div class="filter-container-item first" data-toggle="modal" data-target="#filter">
                     <span class="glyphicon glyphicon-filter"></span>
                    </div>
                    <div class="filter-container-item">
                        <span>10/<?php echo $all_count; ?></span>
                    </div>
                    <div class="filter-container-item">
                        <div class="loadmore">
                            
                            <button class="btn btn-outline-info" type="button" id="loadBtn" value="+10"><span class="glyphicon glyphicon-arrow-down"></span></button>
                            <input type="hidden" id="row" value="0">
                            <input type="hidden" id="postCount" value="<?php echo $postCount; ?>">
                        </div>
                    </div>
                </div>                
           </div>
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
            <th scope="col">Тип оплата</th>
            <th scope="col">Сумма</th>
            <th>Отмена</th>

            </tr>
        </thead>
        <tbody class="postList">


            <?php     
                $i = 0;
                while ($row = mysqli_fetch_array($rs_result)) {
                $i++;
            ?> 

            <tr class="item">
                <td><?php echo $row["order_id"]; ?></td>
                <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
                <td><?php echo $date = date("d.m.Y", strtotime($row["order_date"])); ?></td>

                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo number_format($row["prepayment"], 0, ',', ' '); ?></td>
                <td><a href="#">отмена</a></td>
            </tr>

            <?php       
                };     
            ?>



        </tbody>
        </table>
        
        <table class="table" style="background-color:#ebf0ff; border-left: 4px solid #7396ff;">
            <tr>
                <td >Общая задолженность: <?php echo number_format($all_debt, 0, ',', ' '); ?></td>
            </tr>
        </table>
    </div>
</div>


<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script>

$('.normalize').selectize();

$(document).ready(function () {
    $(document).on('click', '#loadBtn', function () {
        
      var row = Number($('#row').val());
      var count = Number($('#postCount').val());
      var limit = 3;

      row = row + limit;

      $('#row').val(row);
      $("#loadBtn").val('Loading...');
 
      $.ajax({
        type: 'POST',
        url: 'loadmore-data.php',
        data: 'row=' + row,
        success: function (data) {
          var rowCount = row + limit;
          $('.postList').append(data);
          if (rowCount >= count) {
            $('#loadBtn').css("display", "none");
          } else {
            $("#loadBtn").val('+10');
          }
        }
      });
    });
  });
</script>
</body>
</html>