<?php
$str = @$_POST['sql'];
$pattern = "/INSERT INTO (.*?) \((.*?)\) VALUES \((.*?)\)/si";
$match = preg_match($pattern,$str,$matches); 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>INSERT to UPDATE</title>
<style>
body { 
	font-family: Arial, Helvetica, sans-serif; 
	font-size: 1em; 
} 
.noMargin p { 
	margin: 0;
	padding: 0;
	margin-bottom: 5px; 
} 
label { 
	font-weight: bold;
} 
</style>
</head>

<body>
<h1 style="text-align: center; color: #69C">Convert insert to update</h1>
	<?php //echo ($match) ? "Matches Found" : "Matches Not Found"; echo "<br>"; ?>
	<?php //print_r($matches); echo "<br>"; ?>
    <?php 
		$table = @$matches[1]; 
		$colsr = @$matches[2];
		$cols = @explode(',',$matches[2]); 
		$values = @explode(',',$matches[3]);
		
		//print_r($cols);
		
		$sqlresult = "UPDATE " . $table . " SET ";
		
		for ($i = 0; $i < count($cols); $i++) { 
			if ($i > 0) $sqlresult .= ", ";
			$sqlresult .= $cols[$i] . " = " . $values[$i]; 
		} 
		
		$sqlresult .= " WHERE 1"; 
?>
   <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" name="insertSelect" id="insertSelect" style="width: 800px; margin: auto;">

       <label for="sql">Insert Statement</label>
       <br>
       <textarea name="sql" id="sql" style="width: 100%; height: 100px"><?php if ($_SERVER['REQUEST_METHOD'] == "POST") echo $str; ?></textarea>
       <br><br>
       <label for="sqlresult">Generated Update Statement</label>
       <br>
     <textarea name="sqlresult" id="sqlresult" style="width: 100%; height: 100px"><?php if ($_SERVER['REQUEST_METHOD'] == "POST") echo $sqlresult; ?></textarea>

     <p>
       <input type="submit" name="submit" id="submit" value="Submit">
       <input type="reset" name="reset" id="reset" value="Reset">
     </p>
   </form>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$('textarea').focus(function() { $(this).select(); });
	<?php if ($_SERVER['REQUEST_METHOD'] == "POST") : ?>
    $("#sqlresult").select();
	<?php endif; ?>
});
</script>
</html>