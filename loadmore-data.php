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
  $query = "SELECT * FROM debts WHERE main_prepayment != '0' ORDER BY id desc LIMIT ".$start.",".$limit;

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

?>