<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Intractive!</title>
</head>
<body>
	<h1>ini quick prototyping jadi maaf bahasanya jelek</h1>
	<p>masuk</p>
	<p>selamat datang</p>
  <a href="<?php echo site_url() . "/dashboard/logout"; ?>">logout disini</a>
  <a href="<?php echo site_url() . "/dashboard"; ?>">balik ke dashboard</a>

  <h1>hasil pencarianku</h1>
  <?php
    foreach($search as $item) {
      $num = $item['id'];
      $name = $item['name'];
      $loc = $item['location'];
      $desc = $item['description'];

      echo "
        Data number: $num<br>
        Name: $name<br>
        Location: $loc<br>
        Description: $desc<br>
      "; 
    }


  ?>

</body>
</html>