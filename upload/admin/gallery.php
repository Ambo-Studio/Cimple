<?php require_once('../Connections/cms.php'); ?>
<?php
mysql_select_db($database_cms, $cms);
$query_rsBilleder = "SELECT * FROM billeder";
$rsBilleder = mysql_query($query_rsBilleder, $cms) or die(mysql_error());
$row_rsBilleder = mysql_fetch_assoc($rsBilleder);
$totalRows_rsBilleder = mysql_num_rows($rsBilleder);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Billedgalleri</title>
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php do { ?>
  <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
      <td width="50%"><?php echo '<img height="100" 
  src="../billeder/'.$row_rsBilleder['billednavn'].'">'; ?></td>
      <td width="36%"><?php echo $row_rsBilleder['billednavn']; ?></td>
      <td width="14%" align="center"><a href="admin_delete_image.php?sletbilledid=<?php echo $row_rsBilleder ['billedid'];?>">Slet</a></td>
    </tr>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>
      </table>
  <?php } while ($row_rsBilleder = mysql_fetch_assoc($rsBilleder)); ?><p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsBilleder);
?>
