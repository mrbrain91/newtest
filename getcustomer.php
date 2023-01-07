<?php
$mysqli = new mysqli("localhost", "root", "root", "orto_db");
if($mysqli->connect_error) {
  exit('Could not connect');
}

if (isset($_GET['i'])) {
  $i = $_GET['i'];
}
// echo $_GET['i'];
$sql = "SELECT cost FROM price_item_tbl WHERE name = ? AND price_id=(SELECT max(id) FROM price_tbl)"; 

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($pn);
$stmt->fetch();
$stmt->close();
?>

<input readonly data-type="product_price" type="number" name="product_price[]"  class="form-control product_price" form="order_form"/ id="product_price_<?php echo $i;?>" value="<?php echo $pn;?>">


