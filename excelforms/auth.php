<?php
require_once 'db.php';
if (isset($_POST['auth_name']))
{
    $sql = "SELECT * FROM `users` WHERE `UserName`='".$_POST['auth_name']."'";
    //echo $sql;
    $result = $con->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row = $result->fetch();
    if (isset($row['Password']) && $row['Password']== $_POST['auth_pass']) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['isAdm'] = $row['isAdm'];

    $UID=$_SESSION['user_id'];
    $Action="Login";
    $sql="INSERT INTO tLog (`UserId`,`Action`)
                    VALUES ('$UID','$Action')";
    $result = $con->query($sql);

    }else{
    $UID=$_SESSION['user_id'];
    $Action="ErrorLogin";
    $Params="Login: ".$_POST['auth_name']."->Password: ".$_POST['auth_pass'];
    $sql="INSERT INTO tLog (`UserId`,`Action`,`Params`)
                    VALUES ('$UID','$Action','$Params')";
    $result = $con->query($sql);
    }
 //   echo  ("<script type=\"text/javascript\">window.location=\"./index.php\";</script>");
   // header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit;
}

if (isset($_GET['action']) AND $_GET['action']=="logout") {
    //session_start();
    $UID=$_SESSION['user_id'];
    $Action="Exit";
    $sql="INSERT INTO tLog (`UserId`,`Action`)
                    VALUES ('$UID','$Action')";
    $result = $con->query($sql);

    session_destroy();


  //  echo  ("<script type=\"text/javascript\">window.location=\"./index.php\";</script>");
    exit;
}

if (!isset($_SESSION['user_id'])) {
?>  <center>
    <form method="POST" class="form-horizontal">
    <div class="container">
    <div class="page-header">
           </div>
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="auth_name" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="auth_pass" required>

    <button type="submit">Login</button>
  </div>
</form>
</center>
<?php
exit;
}
?>
