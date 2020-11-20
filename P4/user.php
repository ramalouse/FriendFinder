<?php include("top.php"); ?>

<?php if (isset($_SESSION["name"])) { ?>
  <h2>User Status</h2>
  <p>You are logged in as <?= $_SESSION["name"] ?>.</p>
  
  <form id="logout" action="logout.php" method="post">
    <input type="submit" value="Log out" />
    <input type="hidden" name="logout" value="true" />
  </form>
<?php } else { ?>
  <h2>Log in</h2>
  <form id="login" action="login.php" method="post">
    <dl>
      <dt>Name</dt>     <dd><input type="text" name="name" /></dd>
      <dt>Password</dt> <dd><input type="password" name="password" /></dd>
      <dt> </dt>        <dd><input type="submit" value="Log in" /></dd>
    </dl>
  </form>

  <h2>Register</h2>
  <form id="register" action="register.php" method="post">
    <dl>
      <dt>Name</dt>     <dd><input type="text" name="name" /></dd>
      <dt>Password</dt> <dd><input type="password" name="password" /></dd>
      <dt> </dt>        <dd><input type="submit" value="Register" /></dd>
    </dl>
  </form>
<?php } ?>

<?php include("bottom.php"); ?>
