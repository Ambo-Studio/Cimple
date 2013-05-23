<?php require_once('../Connections/cms.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
mysql_select_db($database_cms, $cms);
$query_rsSubmenu1 = "SELECT * FROM sideindhold WHERE mainid = 1";
$rsSubmenu1 = mysql_query($query_rsSubmenu1, $cms) or die(mysql_error());
$row_rsSubmenu1 = mysql_fetch_assoc($rsSubmenu1);
$totalRows_rsSubmenu1 = mysql_num_rows($rsSubmenu1);

mysql_select_db($database_cms, $cms);
$query_rsSubmenu2 = "SELECT * FROM sideindhold WHERE mainid = 2";
$rsSubmenu2 = mysql_query($query_rsSubmenu2, $cms) or die(mysql_error());
$row_rsSubmenu2 = mysql_fetch_assoc($rsSubmenu2);
$totalRows_rsSubmenu2 = mysql_num_rows($rsSubmenu2);

mysql_select_db($database_cms, $cms);
$query_rsSubmenu3 = "SELECT * FROM sideindhold WHERE mainid = 3";
$rsSubmenu3 = mysql_query($query_rsSubmenu3, $cms) or die(mysql_error());
$row_rsSubmenu3 = mysql_fetch_assoc($rsSubmenu3);
$totalRows_rsSubmenu3 = mysql_num_rows($rsSubmenu3);

mysql_select_db($database_cms, $cms);
$query_rsSubmenu4 = "SELECT * FROM sideindhold WHERE mainid = 4";
$rsSubmenu4 = mysql_query($query_rsSubmenu4, $cms) or die(mysql_error());
$row_rsSubmenu4 = mysql_fetch_assoc($rsSubmenu4);
$totalRows_rsSubmenu4 = mysql_num_rows($rsSubmenu4);

mysql_select_db($database_cms, $cms);
$query_rsSubmenu5 = "SELECT * FROM sideindhold WHERE mainid = 5";
$rsSubmenu5 = mysql_query($query_rsSubmenu5, $cms) or die(mysql_error());
$row_rsSubmenu5 = mysql_fetch_assoc($rsSubmenu5);
$totalRows_rsSubmenu5 = mysql_num_rows($rsSubmenu5);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administration</title>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>

<body> 
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="layout">
  <tr>
    <td colspan="2" class="top"><h1>Administrationsomr&aring;de</h1></td>
  </tr>
  <tr>
    <td class="top1">&nbsp;</td>
    <td class="top1"><table width="100" border="0" align="right" cellpadding="2" cellspacing="0">
      <tr>
        <td align="center"><a href="<?php echo $logoutAction ?>">Log ud</a> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="left"><div align="center">
      <p>&nbsp;</p>
      <p><strong>Admin-forside</strong></p>
      <p>&nbsp;</p>
    </div></td>
    <td class="middle"><p>&nbsp;</p>
      <table width="700" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td colspan="5" bgcolor="#F3F3F3">Rediger  ved at v&aelig;lge mellem f&oslash;lgende funktioner:</td>
        </tr>
        <tr>
          <td width="135" align="center" bgcolor="#F9F9F9"><a href="admin_edit_topmenu.php?id=1">Topmenu1/forside</a></td>
          <td width="139" align="center" bgcolor="#F9F9F9"><a href="admin_edit_topmenu.php?id=2">Topmenu 2</a></td>
          <td width="129" align="center" bgcolor="#F9F9F9"><a href="admin_edit_topmenu.php?id=3">Topmenu 3</a> </td>
          <td width="130" align="center" bgcolor="#F9F9F9"><a href="admin_edit_topmenu.php?id=4">Topmenu 4</a> </td>
          <td width="131" align="center" bgcolor="#F9F9F9"><a href="admin_edit_topmenu.php?id=5">Topmenu 5</a> </td>
        </tr>
        <tr>
          <td align="center" valign="top"><strong>Undermenuer:</strong><br />
            <?php do { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><a href="admin_edit_submenu.php?id=<?php echo $row_rsSubmenu1['id']; ?>"><?php echo $row_rsSubmenu1['navn']; ?></a></td>
              </tr>
            </table>
          <?php } while ($row_rsSubmenu1 = mysql_fetch_assoc($rsSubmenu1)); ?></td>
          <td align="center" valign="top"><strong>Undermenuer:</strong><br />
            <?php do { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><a href="admin_edit_submenu.php?id=<?php echo $row_rsSubmenu2['id']; ?>"><?php echo $row_rsSubmenu2['navn']; ?></a></td>
              </tr>
            </table>
          <?php } while ($row_rsSubmenu2 = mysql_fetch_assoc($rsSubmenu2)); ?></td>
          <td align="center" valign="top"><strong>Undermenuer:</strong><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php do { ?>
                      <a href="admin_edit_submenu.php?id=<?php echo $row_rsSubmenu3['id']; ?>"><?php echo $row_rsSubmenu3['navn']; ?></a>
                <?php } while ($row_rsSubmenu3 = mysql_fetch_assoc($rsSubmenu3)); ?></td>
              </tr>
            </table></td>
          <td align="center" valign="top"><strong>Undermenuer:</strong><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php do { ?>
                      <a href="admin_edit_submenu.php?id=<?php echo $row_rsSubmenu4['id']; ?>"><?php echo $row_rsSubmenu4['navn']; ?></a>
                <?php } while ($row_rsSubmenu4 = mysql_fetch_assoc($rsSubmenu4)); ?></td>
              </tr>
            </table></td>
          <td align="center" valign="top"><strong>Undermenuer:</strong><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php do { ?>
                      <a href="admin_edit_submenu.php?id=<?php echo $row_rsSubmenu5['id']; ?>"><?php echo $row_rsSubmenu5['navn']; ?></a>
                <?php } while ($row_rsSubmenu5 = mysql_fetch_assoc($rsSubmenu5)); ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#F9F9F9"><a href="admin_new_submenu.php?id=1">Tilf&oslash;j undermenu</a> </td>
          <td align="center" bgcolor="#F9F9F9"><a href="admin_new_submenu.php?id=2">Tilf&oslash;j undermenu</a></td>
          <td align="center" bgcolor="#F9F9F9"><a href="admin_new_submenu.php?id=3">Tilf&oslash;j undermenu</a></td>
          <td align="center" bgcolor="#F9F9F9"><a href="admin_new_submenu.php?id=4">Tilf&oslash;j undermenu</a></td>
          <td align="center" bgcolor="#F9F9F9"><a href="admin_new_submenu.php?id=5">Tilf&oslash;j undermenu</a></td>
        </tr>
      </table>      
      <p>&nbsp;</p>
      <table width="700" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td colspan="2" bgcolor="#F3F3F3">Administr&eacute;r billeder: </td>
        </tr>
        <tr>
          <td align="center" onfocus="MM_openBrWindow('upload.php','upload','width=400,height=150')"><a href="#" onclick="MM_openBrWindow('upload.php','upload','width=400,height=150')">Upload billeder</a> </td>
          <td align="center"><a href="#" onclick="MM_openBrWindow('gallery.php','gallery','scrollbars=yes,width=500,height=500')">Vis billeder</a> </td>
        </tr>
      </table>      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
     
      <h1>&nbsp;</h1></td>
  </tr>
</table>
<div id="footer">Copyright 2002-2012 Gazunga International| Cimple CMS |</div>
</body>
</html>
<?php
mysql_free_result($rsSubmenu1);

mysql_free_result($rsSubmenu2);

mysql_free_result($rsSubmenu3);

mysql_free_result($rsSubmenu4);

mysql_free_result($rsSubmenu5);
?>
