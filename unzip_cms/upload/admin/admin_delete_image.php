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

$colname_rsHentNavn = "-1";
if (isset($_GET['sletbilledid'])) {
  $colname_rsHentNavn = (get_magic_quotes_gpc()) ? $_GET['sletbilledid'] : addslashes($_GET['sletbilledid']);
}
mysqli_select_db($database_cms, $cms);
$query_rsHentNavn = sprintf("SELECT billednavn FROM billeder WHERE billedid = %s", $colname_rsHentNavn);
$rsHentNavn = mysqli_query($query_rsHentNavn, $cms) or die(mysqli_error());
$row_rsHentNavn = mysqli_fetch_assoc($rsHentNavn);
$totalRows_rsHentNavn = mysqli_num_rows($rsHentNavn);

unlink("../billeder/".$row_rsHentNavn["billednavn"]);

if ((isset($_GET['sletbilledid'])) && ($_GET['sletbilledid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM billeder WHERE billedid=%s",
                       GetSQLValueString($_GET['sletbilledid'], "int"));

  mysqli_select_db($database_cms, $cms);
  $Result1 = mysqli_query($deleteSQL, $cms) or die(mysqli_error());

  $deleteGoTo = "gallery.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Slet billede</title>
</head>

<body>
</body>
</html>
<?php
mysqli_freeresult($rsHentNavn);
?>
