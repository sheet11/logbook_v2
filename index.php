<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login form</title>
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/stylelogin.css">
    <script src="js/prefixfree.min.js"></script>

    
  </head>

  <body>

    <div class="login">
    <h1>Log Book Online 2019</h1>

    <form class="form" action="proseslogin.php" method="post" enctype="multipart/form-data">

      <p class="field">
        <input type="text" name="nip" placeholder="NIP" required/>
        <i class="fa fa-user"></i>
      </p>

      <p class="field">
        <input type="password" name="password" placeholder="Password" required/>
        <i class="fa fa-lock"></i>
      </p>


      <p class="submit"><input type="submit" name="sent" value="Login"></p>

      


    </form>
  </div> <!--/ Login-->

<div class="copyright">
    <p>Copyright &copy; 2019.<a href="" target="_blank">Poltekkes Kemenkes Bengkulu</a></p>
    
    
    
    
    
  </body>
</html>
