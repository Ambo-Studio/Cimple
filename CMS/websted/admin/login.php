<?php require_once('../Connections/cms.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $_SESSION['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['brugernavn'])) {
  $loginUsername=$_POST['brugernavn'];
  $password=$_POST['adgangskode'];
  $kryptpw = hash('sha256', $_POST['password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($cms, $database_cms);
  
  $LoginRS__query=sprintf("SELECT brugernavn, adgangskode FROM brugere WHERE brugernavn='%s' AND adgangskode='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($cms ,$LoginRS__query) or die(mysqli_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Log p&aring;</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<form action="<?php echo $loginFormAction; ?>" method="POST" name="login" id="login">
  <p>&nbsp;</p>
  <table width="400" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#CCCCCC">
    <tr>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="28%"><span class="style1">Log p&aring; </span></td>
          <td width="72%">&nbsp;</td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td>Brugernavn:</td>
          <td><input name="brugernavn" type="text" id="brugernavn" size="40"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td>Adgangskode:</td>
          <td><input name="adgangskode" type="password" id="adgangskode" size="40"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Log pÂ"></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
