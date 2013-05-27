<?php require_once('../Connections/cms.php'); ?>
<?php
// Made by Frederick Eggertsen
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
      <h1>Rediger Meta data</h1>
      <form id="edit" name="edit" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="550" border="0" cellpadding="3">
          <tr>
            <td width="68">Tittle:</td>
            <td width="464"><label>
              <input name="overskrift" type="text" id="overskrift" value="<?php echo $row_rsEdit['tittle']; ?>" size="70" />
            </label></td>
          </tr>
          <tr>
            <td>Keywords: </td>
            <td><label>
              <textarea name="tekst1" cols="70" rows="6" id="tekst1"><?php echo $row_rsEdit['keyword']; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>Indhold: </td>
            <td><label>
              <textarea name="tekst2" cols="70" rows="6" id="tekst2"><?php echo $row_rsEdit['dec']; ?></textarea>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input type="submit" name="Submit" value="Gem data" />
            </label></td>
          </tr>
        </table>
         
        <input type="hidden" name="MM_update" value="edit">
      </form>      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
