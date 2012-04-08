<html>
  <head>
    <style type="text/css">
    .error { color:red; }
    </style>
  </head>

  <body>
    <h1>Login</h1>

    <?php echo $error ? "<p class='error'>$error</p>" : ''; ?>

    <form method="post" action="">
      user:
      <input type="text" name="user" value="<?php echo $_POST['user']; ?>"/>
      <br>
      password:
      <input type="password" name="password"/>
      <br>
      <input type="submit"/>
    </form>
  </body>
</html>
