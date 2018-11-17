<?php require_once('Connections/cms.php'); ?>
<?php
$colname_rsResultat = "-1";
if (isset($_GET['search'])) {
  $colname_rsResultat = (get_magic_quotes_gpc()) ? $_GET['search'] : addslashes($_GET['search']);
}
mysqli_select_db($cms ,$database_cms);
$query_rsResultat = sprintf("SELECT id, mainid, overskrift FROM sideindhold WHERE tekst1 LIKE '%%%s%%' OR tekst2 LIKE '%%%s%%'    OR overskrift LIKE '%%%s%%'", $colname_rsResultat,$colname_rsResultat,$colname_rsResultat);
$rsResultat = mysqli_query($cms ,$query_rsResultat) or die(mysqli_error());
$row_rsResultat = mysqli_fetch_assoc($rsResultat);
$totalRows_rsResultat = mysqli_num_rows($rsResultat);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CMS-websted</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="layout">
  <tr>
    <td colspan="2" class="top"><img src="images/logo.jpg" width="376" height="91" alt="toplogo" /></td>
  </tr>
  <tr>
    <td class="top1">&nbsp;</td>
    <td class="top1"><a href="index.php?id=1&amp;mainid=1">Forside</a> | <a href="index.php?id=2&amp;mainid=2">Nyhedder</a> | <a href="index.php?id=3&amp;mainid=3">Fotos</a> | <a href="index.php?id=4&amp;mainid=4">Links</a> | <a href="index.php?id=4&amp;mainid=4">Kontakt</a> </td>
  </tr>
  <tr>
    <td class="left"><p>&nbsp;</p>
      
    </td>
    <td class="middle"><form id="form1" name="form1" method="get" action="resultat.php">
      <table width="200" border="0" align="right" cellpadding="2" cellspacing="0">
        <tr>
          <td width="151"><label>
            <input name="search" type="text" id="search" />
          </label></td>
          <td width="41"><label>
            <input type="submit" name="Submit" value="S&oslash;g" />
          </label></td>
        </tr>
      </table>
    </form>
      <p>&nbsp;</p>
      <table width="600" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><h1>Resultater:</h1></td>
        </tr>
        <?php do { ?>
          <tr>
            <td><a href="index.php?id=<?php echo $row_rsResultat['id']; ?><?php if ($row_rsResultat['mainid'] <> null) echo "&mainid="+$row_rsResultat['mainid']; ?>"><?php echo $row_rsResultat['overskrift']; ?></a></td>
          </tr>
          <?php } while ($row_rsResultat = mysqli_fetch_assoc($rsResultat)); ?>
      </table>      
      <?php if ($totalRows_rsResultat == 0) { // Show if recordset empty ?>
        <table width="600" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td>Desv&aelig;rre... s&oslash;gningen gav ikke nogen resultater. </td>
          </tr>
        </table>
        <?php } // Show if recordset empty ?><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
</table>
<div id="footer">Copyright 2012 | Aspit &Oslash;stjylland</div>
</body>
</html>
<?php
mysqli_free_result($rsResultat);
?>
