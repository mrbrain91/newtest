<?php
include('settings.php');
include('bot_lib.php');


// order move to archive
if (isset($_GET['archive_id'])) {

    $archive_id = $_GET['archive_id'];
    $contractor = $_GET['contractor_id'];
    $debt = $_GET['debt'];
    $ord_date = $_GET['ord_date'];
    $payment_type = $_GET['payment_type'];
    //-----------------------ostatka uchun-----------------
    $sql = "SELECT * FROM main_ord__item_tbl WHERE order_id='$archive_id' AND order_itm_sts = 0";
	$rs_result = mysqli_query ($connect, $sql);
    while ($row = mysqli_fetch_assoc($rs_result)) {    
        $prod_name = $row['prod_name'];
        $count_name = $row['count_name'];
        $query = "UPDATE rest_tbl SET rest = rest - '$count_name', bron = bron - '$count_name', archived = archived + '$count_name' WHERE prod_name='$prod_name'";
        mysqli_query($connect, $query);
    }
    //----------------------------------------

    if (upd_order_sts($connect, $archive_id)) {
       if (upd_order_itm_sts($connect, $archive_id)) {
            //--------------------debt yozish--------------------
            add_debt($connect, $archive_id, $contractor, $debt, $ord_date, $payment_type);
        }
    }
}
//end order move to archive



// archive order move order.php

if (isset($_GET['restore_id'])) {
    $restore_id = $_GET['restore_id'];

    //-----------------------ostatka uchun-----------------
    $sql = "SELECT * FROM main_ord__item_tbl WHERE order_id='$restore_id' AND order_itm_sts = 1";
	$rs_result = mysqli_query ($connect, $sql);
    while ($row = mysqli_fetch_assoc($rs_result)) {    
        $prod_name = $row['prod_name'];
        $count_name = $row['count_name'];
        $query = "UPDATE rest_tbl SET rest = rest + '$count_name', bron = bron + '$count_name', archived = archived - '$count_name' WHERE prod_name='$prod_name'";
        mysqli_query($connect, $query);
    }
//--------------------------------------++++------------------


    if (upd_order_sts_res($connect, $restore_id)) {
       if (upd_order_itm_sts_res($connect, $restore_id)) {
            delete_debt($connect, $restore_id);
       }
    }
    
}

// end 

if (isset($_GET['restore_id']) && isset($_GET['sts'])) {
    $restore_id = $_GET['restore_id'];
    if (upd_order_sts_res($connect, $restore_id)) {
       if (upd_order_itm_sts_res($connect, $restore_id)) {
            header("Location: deleted_order.php"); 
       }
    }
    
}



if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

        //-----------------------ostatka uchun-----------------
        $sql = "SELECT * FROM main_ord__item_tbl WHERE order_id='$delete_id' AND order_itm_sts = 0";
        $rs_result = mysqli_query ($connect, $sql);
        while ($row = mysqli_fetch_assoc($rs_result)) {    
            $prod_name = $row['prod_name'];
            $count_name = $row['count_name'];
            $query = "UPDATE rest_tbl SET bron = bron - '$count_name' WHERE prod_name='$prod_name'";
            mysqli_query($connect, $query);
        }
    //--------------------------------------------------------


    if (upd_order_sts_del($connect, $delete_id)) {
       if (upd_order_itm_sts_del($connect, $delete_id)) {
            header("Location: order.php"); 
       }
    }
    
}

    



//yangi prays yaratish
if (isset($_GET['create_new_price'])) {
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `price_tbl` (`date`) VALUES ('$date')";
	if(mysqli_query($connect, $sql)) {
		redirect("price.php");
	}
    
}






?>