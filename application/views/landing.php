<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Intractive &mdash; Your updated hotel system!</title>
  <link rel="stylesheet" href="<?php echo base_url(). "/assets/css/style.css" ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . "/assets/images/icons/favicon.png"; ?>">

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
  <script src="<?php echo base_url() . "/assets/js/landing.js"; ?>"></script>

</head>
<body class="landing-body">
	
	<main class="form-view">    
    <div class="form-view__header">
      <h2>Intractive Hotel System</h2>
      <p>Sign up or login here!</p>
    </div>

    <div class="form-view__login u-margin-bottom-small">
      <form action='<?php echo site_url() . "/authentication/login"; ?>' method="POST" class="form-view__form">
        <input type="text" name="login_username" placeholder="Username" /><br>
        <input type="password" name="login_password" placeholder="Password" /><br>
        <input type="submit" name="login_button" value="Submit" class="btn-inline">
        <?php
          echo "<br>" . $this->session->flashdata('message');
        ?>

        <br>
        <a href="#" id="register">Do not have an account yet? Sign up by clicking me!</a>
      </form>
    </div>

    <div class="form-view__register u-margin-bottom-small">
      <form action="<?php echo site_url() . "/authentication/register"; ?>" method="POST" class="form-view__form">
        <input type="text" name="first_name" placeholder="First Name"/>

        <input type="text" name="last_name" placeholder="Last Name"/>
        <input type="text" name="username" placeholder="Username" required />
					
				<input type="email" name="email" placeholder="Email" required />
					
				<input type="password" name="password" placeholder="Password" required />
				
				<input type="date" name="birthdate" required />

        <select name="gender" required> 
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select><br>
          
        <input type="submit" name="register_button" value="Submit" class="btn-inline">
        <br>
        <a href="#" id="login">Already have an account? Click me to login!</a>
      </form> 
    </div>  
  
  </main>
		
</body>
</html>