<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $name = $_POST['ons'];
  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo $name;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.js" integrity="sha512-/lbeISSLChIunUcgNvSFJSC+LFCZg08JHFhvDfDWDlY3a/NYb/NPKOcfDte3aA6E3mxm9a3sdxvkktZJSCpxGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>test</title>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <input type="text" class='form-control autonumber' name='ons'>
    <input type="text" class='form-control autonumber'>
    <input type="submit" class='form-control'>
</form>
<script>




    const autoNumericOptionsEuro = {
    decimalPlaces: '0',
    digitGroupSeparator        : ' ',
    decimalCharacter           : ',',
    decimalCharacterAlternative: '.',
    // roundingMethod: AutoNumeric.options.roundingMethod.halfUpSymmetric,
    };

    // Initialization
    new AutoNumeric.multiple('.autonumber', autoNumericOptionsEuro);



        // valueInput = numberWithoutSpaces(document.getElementById(id).value);




  </script>
</body>
</html>