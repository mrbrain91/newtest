<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}

$last_id = get_id_new_ord($connect);


//get  users
$sql = "SELECT * FROM users_tbl WHERE role='sale'";
$users_tbl = mysqli_query ($connect, $sql);
//end get users 


//get counterparties
$sql = "SELECT * FROM counterparties_tbl";
$counterparties_tbl = mysqli_query ($connect, $sql);
//end get counterparties 



//get product from price 
$sql = "SELECT * FROM price_item_tbl WHERE price_id=(SELECT max(id) FROM price_tbl)";  
$product_list = mysqli_query ($connect, $sql);
//end get product




if(isset($_POST['submit']) && $_POST['submit'] == 'Принять') {

    add_each_ord($connect);
    $summ_prod = get_sum_main_ord($connect);
    add_main_ord($connect, $summ_prod);

}



?>


<!DOCTYPE html>
<html lang="en">
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
        <span class="right_cus"> Добавление сделки</span>
    </div>    
</div>

<div class="toolbar">
        <div class="container-fluid">
            <!-- <button type="button" class="btn btn-primary">Сохранить</button> -->
            <!-- <button type="button" class="btn btn-success">Принять</button> -->
            <td><input class="btn btn-success" type="submit" form="order_form" name="submit" value="Принять" />
            <a href="order.php"><button type="button" class="btn btn-light">Закрыть</button></a>

        </div>
</div>

<div class="card_head">
    <div class="container-fluid">
        <form action="#"  method="POST" class="horizntal-form" id="order_form">

            <div class="row">
                <div class="col-md-3">
                    <span>Дата сделки</span>
                </div>
                <div class="col-md-3">
                    <span>Условия оплаты</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <input type="date" value="<?php echo date("Y-m-d"); ?>"  class="form-control" name="main_order_date" form="order_form">
                </div>
                <div class="col-md-3">
                    <select required name="main_order_paymen_type" form="order_form" class="normalize">
                            <option value="">--выберите---</option>
                            <option value="<?php echo 'Перечисление';?>"><?php echo 'Перечисление';?></option>
                            <option value="<?php echo 'Наличные деньги';?>"><?php echo 'Наличные деньги';?></option>
                    </select>
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
                <div class="col-md-3">
                    <select required name="main_order_sale_agent" form="order_form" class="normalize">
                        <option value="">--выберитe---</option>
                        <?php    
                            while ($option = mysqli_fetch_array($users_tbl)) {    
                        ?>
                            <option value="<?php echo $option["id"];?>"><?php echo $option["surname"]?> <?php echo $option["name"];?> <?php echo $option["fathername"];?></option>
                        <?php       
                            };    
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select required name="main_order_contractor" form="order_form" class="normalize">
                        <option value="">--выберитe---</option>
                        <?php    
                            while ($option_contractor = mysqli_fetch_array($counterparties_tbl)) {    
                        ?>
                            <option value="<?php echo $option_contractor["id"];?>"><?php echo $option_contractor["name"]?></option>
                        <?php
                            };    
                        ?>
                    </select>
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
<div class="row">
    <table id="orders" class="table order-list">
    <thead>
        <tr>
            <td>Продукция  / Производитель </td>
            <td>Количество</td>
            <!-- <td>Срок годности</td> -->
            <td>Цена</td>
            <td>Скидка</td>
            <td>Сумма</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-sm-4">
                <select required name="prod_name[]" form="order_form" class="form-control" id='prod_name_1' for='1' onchange="showCustomer(this.value,'1')">
                    <option value="">--выберитe продукцию---</option>
                    <?php     
                        while ($option = mysqli_fetch_array($product_list)) {    
                    ?> 
                        <option value="<?php echo $option["name"];?>"><?php echo $option["name"];?></option>
                    <?php       
                        };    
                    ?>
                </select>
            </td>
            <td class="col-sm-1">
                <input required type="number" name="quantity[]"  class="form-control quantity" id='quantity_1' for='1' form="order_form"/>
            </td>
            <td class="col-sm-1">
                <div id="txtHint_1">
                    <input disabled data-type="product_price" type="number" name="product_price[]" id='product_price_1'  class="form-control product_price" for="1" form="order_form"/">
                </div>
            </td>
            <td class="col-sm-1">
                <input required type="number" name="sale[]"  class="form-control sale" id='sale_1' for='1' form="order_form"/>
                
            </td>
            <td class="col-sm-2">
                <input readonly type="text" name="total_cost[] "  class="form-control total_cost" id='total_cost_1' for='1' form="order_form"/>
                
            </td>
             <td><button type="button" name="addrow" id="addrow" class="btn btn-success circle">+</button></td>

            </td>
        </tr>
    </tbody>
    <tfooter>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Количество: 0</td>
            <td>Сумма: 0</td>
        </tr>
    </tfooter>

</table>
<input class="form-control" type='hidden' data-type="product_id_1" id='product_id_1' name='product_id[]'/>            

</div>
</div>


<div class="line line-dashed line-lg pull-in" style="clear: both;"></div>
        
<div class="col-md-12 nopadding">
    <div class="col-md-4 col-md-offset-4 pull-right nopadding">
        <div class="col-md-8 pull-right nopadding">
            <div class="form-group">
                <td><input class="form-control subtotal" type='text' id='subtotal' name='subtotal' readonly/></td>
            </div>
        </div>
        <div class="col-md-3 pull-right">
            <div class="form-group">
                <label>Subtotal</label>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">

    <?php include 'partSite/modal.php'; ?>
    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>



</body>

<script>


$('.normalize').selectize();





// -------------------------------------------- select bazadan olish-------------------------------------------------------

function showCustomer(str, inc) {
  var xhttp;    
  if (str == "") {
    document.getElementById("txtHint_"+inc).innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint_"+inc).innerHTML = this.responseText;

    }
  };
  xhttp.open("GET", "getcustomer.php?q="+str+"&&i="+inc+"", true);
  xhttp.send();
}

// ----------------------------------------------input calculate------------------------------------------------------------------------------



// Add a generic event listener for any change on quantity or price classed inputs
$("#orders").on('input', 'input.quantity,input.sale,input.product_price', function() {
  getTotalCost($(this).attr("for"));
});

$(document).on('click', '.btn_remove', function() {
  var button_id = $(this).attr('id');
  $('#row'+button_id+'').remove();
});

// Using a new index rather than your global variable i
function getTotalCost(ind) {
  var qty = $('#quantity_'+ind).val();
  var sale = $('#sale_'+ind).val();
  var price = $('#product_price_'+ind).val();
  var totNumber = (qty * price)+(qty * price*sale)/100;



  var tot = totNumber;
  $('#total_cost_'+ind).val(tot);
  calculateSubTotal();
}


function calculateSubTotal() {
  var subtotal = 0;
  $('.total_cost').each(function() {
     subtotal += parseFloat($(this).val());
  });
  $('#subtotal').val(subtotal);
}

// -----------------------------row qoshish-----------------------------------------------------------------------------------------------


<?php
    //get product from price 
    $sql = "SELECT * FROM price_item_tbl WHERE price_id=(SELECT max(id) FROM price_tbl)";  
    $product_list = mysqli_query ($connect, $sql);
    //end get product



?>


$(document).ready(function () {
    var counter = 0;
    var inc = 1;
 
    $("#addrow").on("click", function () {
        inc++;
        var newRow = $("<tr>");
        var cols = "";                                                      
                
        cols += '<td><select required name="prod_name[]" form="order_form" class="form-control" id="prod_name_'+inc+'" for="'+inc+'" onchange="showCustomer(this.value,'+inc+')"><option value="">--выберите продукцию--</option><?php while ($option = mysqli_fetch_array($product_list)) { ?> <option value="<?php echo $option["name"];?>"><?php echo $option["name"];?></option> <?php }; ?></select></td>';
        cols += '<td><input required type="number" name="quantity[]"  class="form-control quantity" id="quantity_'+inc+'" for="'+inc+'" form="order_form"/></td>';
        cols += '<td><div id="txtHint_'+inc+'"><input disabled data-type="product_price" type="number" name="product_price[]"  class="form-control product_price" id="product_price_'+inc+'" for="'+inc+'" form="order_form"/></div></td>';
        cols += '<td><input required type="number" name="sale[]" class="form-control sale" id="sale_'+inc+'" for="'+inc+'" form="order_form"/></td>';

        

        cols += '<td><input readonly="" type="text" name="total_cost[] " class="form-control total_cost" id="total_cost_'+inc+'" for="'+inc+'" form="order_form"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="-"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });


});



// function calculateRow(row) {
//     var price = +row.find('input[name^="price"]').val();

// }

// function calculateGrandTotal() {
//     var grandTotal = 0;
//     $("table.order-list").find('input[name^="price"]').each(function () {
//         grandTotal += +$(this).val();
//     });
//     $("#grandtotal").text(grandTotal.toFixed(2));
// }
</script>
</html>