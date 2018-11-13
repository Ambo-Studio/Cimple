<?php require_once('Connections/cms.php'); ?>
<?php
$colname_rsSideindhold = "1";
if (isset($_GET['id'])) {
  $colname_rsSideindhold = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysqli_select_db($cms, $database_cms);
$query_rsSideindhold = sprintf("SELECT * FROM sideindhold WHERE id = %s ORDER BY id DESC", $colname_rsSideindhold);
$rsSideindhold = mysqli_query($cms, $query_rsSideindhold) or die(mysqli_connect_error());
$row_rsSideindhold = mysqli_fetch_assoc($rsSideindhold);
$totalRows_rsSideindhold = mysqli_num_rows($rsSideindhold);

$colname_rsSubmenu = "-1";
if (isset($_GET['mainid'])) {
  $colname_rsSubmenu = (get_magic_quotes_gpc()) ? $_GET['mainid'] : addslashes($_GET['mainid']);
}
mysqli_select_db($cms ,$database_cms);
$query_rsSubmenu = sprintf("SELECT * FROM sideindhold WHERE mainid = %s", $colname_rsSubmenu);
$rsSubmenu = mysqli_query($cms ,$query_rsSubmenu) or die(mysqli_connect_error());
$row_rsSubmenu = mysqli_fetch_assoc($rsSubmenu);
$totalRows_rsSubmenu = mysqli_num_rows($rsSubmenu);
?>

<!-- Dette er HTML start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Dette er Head -->
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!-- Dette er Metatag -->
<meta http-equiv="refresh" content="3000" />
<meta name="description" content="Cimple"></meta>
<meta name="keywords" content="CMS,CIMPLE,Keyword,website,Gazunga"></meta> 
<meta name="author" content="Frederick Eggertsen" />

<!-- Dette er Metatag -->
<title>Cimple,Title in index.php</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<!--  /Dette er Head -->

<!-- Dette er body -->
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="layout">
  <tr>
    <td colspan="2" class="top"><img src="images/logo.jpg" width="376" height="91" alt="toplogo" />
      <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="728" height="90">
        <param name="movie" value="swf/razerbanner1.swf" />
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="8.0.35.0" />
        <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you donít want users to see the prompt. -->
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
        <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
        <!--[if !IE]>-->
        <object type="application/x-shockwave-flash" data="swf/razerbanner1.swf" width="728" height="90">
          <!--<![endif]-->
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" />
          <param name="swfversion" value="8.0.35.0" />
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
          <div>
            <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
            <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
          </div>
          <!--[if !IE]>-->
        </object>
        <!--<![endif]-->
    </object></td>
  </tr>
  <tr>
    <td class="top1">&nbsp;</td>
    
    <!-- Dette er Menuen/navigationslinjen -->
    <td class="top1"><a href="index.php?id=1&mainid=1">Forside</a> | <a href="index.php?id=2&mainid=2">Nyhedder</a> | <a href="index.php?id=3&mainid=3">Fotos</a> | <a href="index.php?id=4&mainid=4">Links</a> | <a href="index.php?id=5&amp;mainid=5">Kontakt</a></td>
    <!-- /Dette er Menuen/navigationslinjen -->
    
  </tr>
  <tr>
    <td class="left"><p>&nbsp;</p>
      <?php do { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td><a href="index.php?id=<?php echo $row_rsSubmenu['id']; ?>&amp;mainid=<?php echo $row_rsSubmenu['mainid']; ?>"><?php echo $row_rsSubmenu['navn']; ?></a></td>
          </tr>
                </table>
        <?php } while ($row_rsSubmenu = mysqli_fetch_assoc($rsSubmenu)); ?></td>
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
      <br />
      <br />
      <br />
      <table width="600" border="0" cellpadding="5">
    <tr>
      <td><h1><?php echo $row_rsSideindhold['overskrift']; ?>
       </h1></td>
    </tr>
    <tr>
      <td><?php echo $row_rsSideindhold['tekst1']; ?></td>
    </tr>
    <tr>
      <td><?php
	  	if ($row_rsSideindhold['billede']) { 
        echo '<img src="billeder/'.$row_rsSideindhold['billede'].'">';} ?>	</td>
    </tr>
    <tr>
      <td><?php echo $row_rsSideindhold['tekst2']; ?></td>
    </tr>
  </table> </td>
  </tr>
</table>
<div id="footer">Copyright 2002-2018 Tacaly | Cimple CMS |</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</body>
<!--  /Dette er body -->

</html>
<!-- Dette er HTML slut -->

<!-- Dette er hjemmesidens inholds forbinelse med cms.php -->
<?php
mysqli_free_result($rsSideindhold);

mysqli_free_result($rsSubmenu);
?>
