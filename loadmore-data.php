<?php
include('settings.php');
include('bot_lib.php');


if (isset($_POST['row'])) {
  $start = $_POST['row'];
  $limit = 10;
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
?>