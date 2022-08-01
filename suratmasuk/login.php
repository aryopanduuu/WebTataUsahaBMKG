<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="shortcut icon" href="../public/img/logo.png" />
	<title>LOGIN | SURAT MASUK</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../public/css/login.css">
</head>
<div class="wrapper fadeInDown">
  <div id="formContent">



    <!-- Icon -->
    <div class="center">
        <br><br>
    <img src="../public/img/logo.png" alt="logo" height="80px" width="80px" class="center">
    <br><br>
    </div>

    <!-- Tabs Titles -->
    <div class="center">
    <h3 class="active"> LOGIN </h3>
    <h5>SURAT MASUK</h5>
    <br>
    </div>

    <!-- Login Form -->
    <form action="proses-login.php" method="POST" class="login-validation" novalidate="">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <br><br>
        <div class="fixlogin">
        <button class="btn btn-primary" name="login">LOGIN</button>
        <br><br>
        </div>
    </form>



  </div>
</div>
        </body>
</html>


