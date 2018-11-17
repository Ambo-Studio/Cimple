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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit")) {
  $updateSQL = sprintf("UPDATE sideindhold SET overskrift=%s, tekst1=%s, billede=%s, tekst2=%s WHERE id=%s",
                       GetSQLValueString($_POST['overskrift'], "text"),
                       GetSQLValueString($_POST['tekst1'], "text"),
                       GetSQLValueString($_POST['billede'], "text"),
                       GetSQLValueString($_POST['tekst2'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_cms, $cms);
  $Result1 = mysql_query($updateSQL, $cms) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsEdit = "-1";
if (isset($_GET['id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_cms, $cms);
$query_rsEdit = sprintf("SELECT * FROM sideindhold WHERE id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $cms) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

mysql_select_db($database_cms, $cms);
$query_rsBilledmenu = "SELECT * FROM billeder";
$rsBilledmenu = mysql_query($query_rsBilledmenu, $cms) or die(mysql_error());
$row_rsBilledmenu = mysql_fetch_assoc($rsBilledmenu);
$totalRows_rsBilledmenu = mysql_num_rows($rsBilledmenu);
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
      <p><strong>Rediger topmenu</strong></p>
      <p><a href="index.php">Til admin-forside  </a></p>
    </div></td>
    <td class="middle"><p>&nbsp;</p>
      <h1>Rediger topmenu </h1>
      <form id="edit" name="edit" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="550" border="0" cellpadding="3">
          <tr>
            <td width="97">Overskrift:</td>
            <td width="435"><label>
              <input name="overskrift" type="text" id="overskrift" value="<?php echo $row_rsEdit['overskrift']; ?>" size="70" />
            </label></td>
          </tr>
          <tr>
            <td>Tekst 1: </td>
            <td><label>
              <textarea name="tekst1" cols="70" rows="6" id="tekst1"><?php echo $row_rsEdit['tekst1']; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td>Billede:</td>
            <td><label>
            <select name="billede" id="billede">
              <option value="" <?php if (!(strcmp("", $row_rsEdit['billede']))) {echo "selected=\"selected\"";} ?>>----Ingen billeder----</option>
              <?php
do {  
?>
              <option value="<?php echo $row_rsBilledmenu['billednavn']?>"<?php if (!(strcmp($row_rsBilledmenu['billednavn'], $row_rsEdit['billede']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsBilledmenu['billednavn']?></option>
              <?php
} while ($row_rsBilledmenu = mysql_fetch_assoc($rsBilledmenu));
  $rows = mysql_num_rows($rsBilledmenu);
  if($rows > 0) {
      mysql_data_seek($rsBilledmenu, 0);
	  $row_rsBilledmenu = mysql_fetch_assoc($rsBilledmenu);
  }
?>
            </select>
            </label></td>
          </tr>
          <tr>
            <td>Tekst 2: </td>
            <td><label>
              <textarea name="tekst2" cols="70" rows="6" id="tekst2"><?php echo $row_rsEdit['tekst2']; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Gem data" />
            </label></td>
          </tr>
        </table>
         
        <input name="id" type="hidden" id="id" value="<?php echo $row_rsEdit['id']; ?>" />
        <input type="hidden" name="MM_update" value="edit">
      </form>      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsEdit);

mysql_free_result($rsBilledmenu);
?>
