<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Convert</title>
</head>

<body>
<div style="font-family: Arial, Helvetica, sans-serif; font-size: 10pt; width: 800px; margin: auto">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
  <p>
  <select name="type">
  <?php $converters = array('base64_encode','base64_decode','serialize','unserialize','querystring') ;
  foreach ($converters as $c) : ?>
    <option value="<?= $c ?>" <?php if (isset($_POST['type']) and $_POST['type'] == $c) echo "selected=\"selected\""; ?>><?= $c ?></option>
  <?php endforeach; ?>
  </select>
  <br />
  <textarea name="convert" id="convert" style="width: 100%; height: 100px"><?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") echo $_POST['convert']; 
  ?></textarea>
  </p>
  <p>
    <input type="submit" name="btnSubmit" id="btnSubmit" value="Convert" />
  </p>
  <p>
	
    <textarea name="result" id="result" style="width: 100%; height: 150px"><?php

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if ($_POST['type'] == "querystring") { 
			$query = preg_replace("/^.*?\?/is","",$_POST['convert']);
			$query = explode("&",$query);

			foreach ($query as $q) { 
			$q = explode("=",$q);
				$qs[$q[0]] = urldecode($q[1]);
			}
			print_r($qs);

		} 
		else { 
		$converted = $_POST['type']($_POST['convert']) ; 
		if (is_array($converted)) print_r($converted) ;
		else echo $converted; 
		}
	} 

	
	?></textarea>
  </p>
</form>
</div>
</body>
</html>