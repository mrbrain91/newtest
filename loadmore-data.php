<?php
include('settings.php');
include('bot_lib.php');


if (isset($_POST['row'])) {
  $start = $_POST['row'];
  $limit = 15;
  $query = "SELECT * FROM debts WHERE prepayment > '0' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr class="item">
                <td><?php echo $row["order_id"]; ?></td>
                <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
                <td><?php echo $date = date("d.m.Y", strtotime($row["order_date"])); ?></td>

                <td><?php echo $row["payment_type"]; ?></td>
                <td><?php echo number_format($row["prepayment"], 0, ',', ' '); ?></td>
                <td><a href="#">отмена</a></td>
        </tr>

    <?php }
  }
}
if (isset($_POST['rowpredo'])) {
  $start = $_POST['rowpredo'];
  $limit = 15;
  $query = "SELECT * FROM debts WHERE main_prepayment != '0' AND sts='2' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
            <td><?php $user = get_contractor($connect, $row["id_counterpartie"]); echo $user["name"];?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["order_date"])); ?></td>

            <td><?php echo $row['payment_type']; ?></td>
            <td><?php echo number_format($row['main_prepayment'], 0, ',', ' '); ?></td>
            <td><a href="#">Просмотр</a></td>
            <td><a href="#">Редактировать</a></td>

            </tr>

    <?php }
  }
}

if (isset($_POST['rowopsup'])) {
  $start = $_POST['rowopsup'];
  $limit = 15;
  $query = "SELECT * FROM supplier ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
            <td><?php $user = get_supplier($connect, $row["id_supplier"]); echo $user["name"];?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["order_date"])); ?></td>

            <td><?php echo $row['payment_type']; ?></td>
            <td><?php echo number_format($row['debt'], 0, ',', ' '); ?></td>
            <td><a href="#">Просмотр</a></td>
            <td><a href="#">Редактировать</a></td>

        </tr>

    <?php }
  }
}

if (isset($_POST['rowcashin'])) {
  $start = $_POST['rowcashin'];
  $limit = 15;
  $query = "SELECT * FROM cashbox WHERE sum_in != '0' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
         <tr>
            <td><?php echo $row["id"]; ?></td>

            <td><?php $name  = get_status_in($connect, $row["types_id"]); echo $name["name"]; ?></td>

            

            <td><?php echo $row['type_payment']; ?></td>
            <td><?php echo number_format($row['sum_in'], 0, ',', ' '); ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["date_cash"])); ?></td>
            <td><a href="#">Просмотр</a></td>
            <td><a href="#">Редактировать</a></td>
            <td><a href="#">Отменить</a></td>

            </tr>
    <?php }
  }
}

if (isset($_POST['rowcashout'])) {
  $start = $_POST['rowcashout'];
  $limit = 15;
  $query = "SELECT * FROM cashbox WHERE sum_out != '0' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
         <tr>
            <td><?php echo $row["id"]; ?></td>

            <td><?php $name  = get_status_out($connect, $row["types_id"]); echo $name["name"]; ?></td>
            <td><?php echo $row['type_payment']; ?></td>
            <td><?php echo number_format($row['sum_out'], 0, ',', ' '); ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["date_cash"])); ?></td>
            <td><a href="#">Просмотр</a></td>
            <td><a href="#">Редактировать</a></td>
            <td><a href="#">Отменить</a></td>

            </tr>
    <?php }
  }
}

if (isset($_POST['roworder'])) {
  $start = $_POST['roworder'];
  $i = $_POST['i'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM main_ord_tbl WHERE order_status='0' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      ?>
        <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
          <td><?php echo $row["id"]; ?></td>
          <td><?php $user = get_contractor($connect, $row["contractor"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
          <td><?php $user = get_user($connect, $row["sale_agent"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
          <td><?php echo $date = date("d.m.Y", strtotime($row["ord_date"])); ?></td>
          <td><?php echo $row["payment_type"]; ?></td>
          <td><?php echo number_format($row['transaction_amount'], 0, '.', ' '); ?></td>
        </tr>
        <tr >
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="view_inside_order.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["ord_date"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
                <a href="edit_inside_order.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["ord_date"]; ?>"><button class="btn btn-custom">Редактировать</button> </a>
                <a href="action.php?archive_id=<?=$row['id']?>&&contractor_id=<?=$row['contractor']?>&&debt=<?=$row['transaction_amount']?>&&ord_date=<?=$row['ord_date']?>&&payment_type=<?=$row['payment_type']?>"><button onclick="return confirm('Архивировать?')" class="btn btn-custom">Архивировать</button> </a>
                <a href="action.php?delete_id=<?=$row['id']?>"><button onclick="return confirm('Отменить?')" class="btn btn-custom">Отменить</button> </a>
                <a href="#" class="btn btn-custom">Счет-фактура</button> </a>
            </div> </td>
        </tr>
    <?php }
  }
}
if (isset($_POST['rowstore'])) {
  $start = $_POST['rowstore'];
  $i = $_POST['i'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM order_tbl ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      if ($row["status_order"] == 1) {
        $status_order = 'Принят';
        $status_btn = 'Черновик';
        $color = '#5cb85c';
        $dsp_toggle = 'none';

    }elseif ($row["status_order"] == 0) {
        $status_order = 'Черновик';
        $status_btn = 'Принят';
        $color = 'silver';
        $dsp_toggle = 'true';
    }
      ?>
        <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            <td><?php echo $row["id"]; ?></td>
            <td><?php $supplier = get_supplier($connect, $row["supplier_id"]);?>&nbsp;<?php echo $supplier["name"];?></td>
            <td><?php echo number_format($row['sum_order'], 0, '.', ' '); ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["date_order"])); ?></td>
            <td><span style="border: 1px solid; background-color: <?php echo $color;?>; padding: 5px 10px; border-radius: 4px; color: white;"><?php echo $status_order; ?></span></td>
        </tr>
        <tr>
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
            <a href="view_prod.php?id=<?php echo $row["id"]; ?>&&date=<?php echo $row["date_order"]; ?>&&sum=<?php echo $row["sum_order"]; ?>&&note=<?php echo $row["order_note"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
            <a href="edit_pro.php?id=<?php echo $row["id"]; ?>&&date=<?php echo $row["date_order"]; ?>&&sum=<?php echo $row["sum_order"]; ?>&&note=<?php echo $row["order_note"]; ?>"><button class="btn btn-custom">Редактировать</button> </a>
            <a href="action.php?store_id=<?=$row['id']?>&&contractor_id=<?=$row['contractor']?>&&debt=<?=$row['transaction_amount']?>&&ord_date=<?=$row['ord_date']?>&&payment_type=<?=$row['payment_type']?>"><button onclick="return confirm('<?php echo $status_btn; ?>')" class="btn btn-custom"><?php echo $status_btn; ?></button> </a>
            <a style="display:<?php echo $dsp_toggle;?>;" href="action.php?delete_id=<?=$row['id']?>"><button onclick="return confirm('Отменить?')" class="btn btn-custom">Отменить</button> </a>
            <a href="#" class="btn btn-custom">Счет-фактура</button> </a>
            </div> </td>
        </tr>
    <?php }
  }
}

if (isset($_POST['rowreturn'])) {
  $start = $_POST['rowreturn'];
  $i = $_POST['i'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM return_list ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      if ($row["return_status"] == 0) {
        $status_order = 'Принят';
        $color = '#28a745';
        $dsp_toggle = 'none';

      }elseif ($row["return_status"] == 1) {
          $status_order = 'Удален';
          $color = '#dc3545';
          $dsp_toggle = 'none';
      }
      ?>
       <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            <td><?php echo $row["id"]; ?></td>
            <td><?php $user = get_contractor($connect, $row["contractor"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php $user = get_user($connect, $row["sale_agent"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["return_date"])); ?></td>
            <td><?php echo $row["payment_type"]; ?></td>
            <td><?php echo number_format($row['transaction_amount'], 0, '.', ' '); ?></td>
            <td><span style="border: 1px solid; background-color: <?php echo $color;?>; padding: 5px 10px; border-radius: 4px; color: white;"><?php echo $status_order; ?></span></td>
        </tr>
        <tr>
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="view_inside_return.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["return_date"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
                <a style="display:<?php if($row["return_status"] == 0){echo 'true';}else {echo 'none';}?>;" href="edit_inside_return.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["return_date"]; ?>"><button class="btn btn-custom">Редактировать</button> </a>
                <a style="display:<?php if($row["return_status"] == 0){echo 'true';}else {echo 'none';}?>;" href="action.php?return_delete_id=<?=$row['id']?>"><button onclick="return confirm('Отменить?')" class="btn btn-custom">Удалить</button> </a>
                <a style="display:<?php if($row["return_status"] == 0){echo 'true';}else {echo 'none';}?>;" href="#" class="btn btn-custom">Накладные</button> </a>
            </div> </td>
        </tr>
    <?php }
  }
}

if (isset($_POST['rowarchive'])) {
  $start = $_POST['rowarchive'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM main_ord_tbl WHERE order_status='1' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      ?>
        <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            <td><?php echo $row["id"]; ?></td>
            <td><?php $user = get_contractor($connect, $row["contractor"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php $user = get_user($connect, $row["sale_agent"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["ord_date"])); ?></td>
            <td><?php echo $row["payment_type"]; ?></td>
            <td><?php echo number_format($row['transaction_amount'], 0, '.', ' '); ?></td>
        </tr>
        <tr >
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="inside_archive_order.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["ord_date"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
                <a href="action.php?restore_id=<?=$row['id']?>"><button onclick="return confirm('Восстановить?')" class="btn btn-custom">Восстановить</button> </a>
            </div> </td>
        </tr>
    <?php }
  }
}

if (isset($_POST['rowdel'])) {
  $start = $_POST['rowdel'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM main_ord_tbl WHERE order_status='2' ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      ?>
         <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            <td><?php echo $row["id"]; ?></td>
            <td><?php $user = get_contractor($connect, $row["contractor"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php $user = get_user($connect, $row["sale_agent"]);?>&nbsp;<?php echo $user["surname"]; ?>&nbsp;<?php echo $user["name"]; ?>&nbsp;<?php echo $user["fathername"]; ?></td>
            <td><?php echo $date = date("d.m.Y", strtotime($row["ord_date"])); ?></td>
            <td><?php echo $row["payment_type"]; ?></td>
            <td><?php echo number_format($row['transaction_amount'], 0, '.', ' '); ?></td>
        </tr>
        <tr >
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="inside_deleted_order.php?id=<?php echo $row["id"]; ?>&&payment_type=<?php echo $row["payment_type"]; ?>&&sale_agent=<?php echo $row["sale_agent"]; ?>&&contractor=<?php echo $row["contractor"]; ?>&&date=<?php echo $row["ord_date"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
            </div> </td>
        </tr>
    <?php }
  }
}

if (isset($_POST['rowcounterpartie'])) {
  $start = $_POST['rowcounterpartie'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM counterparties_tbl ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      if ($row['sts'] == 1) {
        $sts = "Активный";
        $sts_color = "green";
     }else {
         $sts = "Не активный";
        $sts_color = "black";
     }
      ?>
        <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["alternative_name"]; ?></td>
            <td><?php echo $row["inn"]; ?></td>
            <td style="color: <?php echo $sts_color; ?>"><?php echo $sts; ?></td>
        </tr>
        <tr>
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="counterpartie_view.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
                <a href="counterpartie_edit.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-custom">Редактировать</button> </a>
                <a href="action.php?change_sts_counterpartie_id=<?=$row['id']?>"><button class="btn btn-custom" onclick="return confirm('Изменить?')">Изменить стутус</button> </a>
            </td>
        </tr>
    <?php }
  }
}

if (isset($_POST['rowsupplier'])) {
  $start = $_POST['rowsupplier'];
  $i = $start;
  $limit = 15;
  $query = "SELECT * FROM supplier_tbl ORDER BY id desc LIMIT ".$start.",".$limit;

  $result = mysqli_query($connect,$query);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $i++;
      if ($row['sts'] == 1) {
        $sts = "Активный";
        $sts_color = "green";
     }else {
         $sts = "Не активный";
        $sts_color = "black";
     }
      ?>
        <tr data-toggle="collapse" data-target="#row<?php echo $i;?>" aria-expanded="true" class="accordion-toggle">
            
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["alternative_name"]; ?></td>
            <td><?php echo $row["inn"]; ?></td>
            <td style="color: <?php echo $sts_color; ?>"><?php echo $sts; ?></td>
        </tr>
        <tr>
            <td colspan="12" style="border:0px;  background-color: #fafafb;" class="hiddenRow"><div class="accordian-body collapse" id="row<?php echo $i;?>"> 
                <a href="supplier_view.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-custom">Просмотр</button> </a>
                <a href="supplier_edit.php?id=<?php echo $row["id"]; ?>"><button class="btn btn-custom">Редактировать</button> </a>
                <a href="action.php?change_sts_supplier_id=<?=$row['id']?>"><button class="btn btn-custom" onclick="return confirm('Изменить?')">Изменить стутус</button> </a>
            </td>
        </tr>
    <?php }
  }
}



?>