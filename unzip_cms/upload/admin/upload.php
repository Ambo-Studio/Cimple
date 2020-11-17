<?php require_once('../Connections/cms.php');
mysqli_select_db($database_cms, $cms);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload billede</title>
</head>

<body>
<?php

if (isset($_FILES['filnavn'])) {
	print "Fil, der er blevet overført:  {$_FILES['filnavn']['name']}<p>\n";
	
$query = "INSERT INTO billeder SET billednavn='".$_FILES['filnavn']['name']."'"; 
	
	$Result1 = mysql_query($query, $cms) or die(mysql_error());
} 

if (isset($_FILES['filnavn'])){ 
$tempfile = $_FILES['filnavn']['tmp_name'];
$destination = "../billeder/{$_FILES['filnavn']['name']} ";
copy($tempfile, $destination);

}

?>
<form action="upload.php" method="post" enctype="multipart/form-data" name="upload" id="upload">
  Fil, der skal overf&oslash;res: 
  <label>
  <input name="filnavn" type="file" id="filnavn" />
  </label>
  <p>
    <label>
    <input type="submit" name="Submit" value="Overf&oslash;r" />
    </label>
  </p>
</form>
</body>
</html>
