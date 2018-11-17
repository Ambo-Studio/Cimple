<?php require_once('../Connections/cms.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

if ((isset($_POST['hidden_id'])) && ($_POST['hidden_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM sideindhold WHERE id=%s",
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_cms, $cms);
  $Result1 = mysql_query($deleteSQL, $cms) or die(mysql_error());

  $deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsDelete = "-1";
if (isset($_GET['id'])) {
  $colname_rsDelete = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cms, $cms);
$query_rsDelete = sprintf("SELECT * FROM sideindhold WHERE id = %s", $colname_rsDelete);
$rsDelete = mysql_query($query_rsDelete, $cms) or die(mysql_error());
$row_rsDelete = mysql_fetch_assoc($rsDelete);
$totalRows_rsDelete = mysql_num_rows($rsDelete);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Rediger topmenu</title>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="layout">
  <tr>
    <td colspan="2" class="top"><h1>Administrationsomr&aring;de</h1></td>
  </tr>
  <tr>
    <td class="top1">&nbsp;</td>
    <td class="top1">&nbsp;</td>
  </tr>
  <tr>
    <td class="left"><div align="center">
      <p>&nbsp;</p>
      <p><strong>Slet topmenu</strong></p>
      <p><a href="index.php">Til admin-forside</a> </p>
    </div></td>
    <td class="middle"><p>&nbsp;</p>
      <h1>Vil du slette f&oslash;lgende undermenu? </h1>
      <form id="delete_submenu" name="delete_submenu" method="post" action="">
        <table width="600" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="114">Navn:</td>
            <td width="478"><?php echo $row_rsDelete['navn']; ?></td>
          </tr>
          <tr>
            <td>Overskrift:</td>
            <td><?php echo $row_rsDelete['overskrift']; ?></td>
          </tr>
          <tr>
            <td>Tekst 1: </td>
            <td><?php echo $row_rsDelete['tekst1']; ?></td>
          </tr>
          <tr>
            <td>Billede:</td>
            <td><?php echo $row_rsDelete['billede']; ?></td>
          </tr>
          <tr>
            <td>Tekst 2: </td>
            <td><?php echo $row_rsDelete['tekst2']; ?></td>
          </tr>
          <tr>
            <td><input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_rsDelete['id']; ?>" /></td>
            <td><label>
              <input type="submit" name="Submit" value="Slet undermenu" />
            </label></td>
          </tr>
        </table>
      </form>      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsDelete);
?>
