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
	<p>Login</p>

	<form action="<?php echo site_url() . "/authentication/login"; ?>" method="POST">
		<p>Email</p>
		<input type="text" name="username" />
		
		<p>Password</p>
		<input type="text" name="password" />

		<input type="submit" value="Login" />
	</form>


	<p>Register</p>

	<form action="<?php echo site_url() . "/authentication/register"; ?>" method="POST">
		<p>Nama Depan</p>
		<input type="text" name="first_name">

		<p>Nama Belakang</p>
		<input type="text" name="last_name">

		<p>Username</p>
		<input type="text" name="username">

		<p>Email</p>
		<input type="text" name="email">

		<p>Password</p>
		<input type="text" name="password">

		<p>birthday</p>
		<input type="date" name="birthday">

		<p>gender</p>
		<input type="text" name="gender">

		<input type="submit" value="Submit">
	</form>

</body>
</html>