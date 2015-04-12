<?php 

class Nato { 

public $nato = array("a"=>"Alpha", "b"=>"Bravo", "c"=>"Charlie",
					 "d"=>"Delta", "e"=>"Echo", "f"=>"Foxtrot",
					 "g"=>"Golf", "h"=>"Hotel", "i"=>"India",
					 "j"=>"Juliet", "k"=>"Kilo", "l"=>"Lima", 
					 "m"=>"Mike", "n"=>"November", "o"=>"Oscar",
					 "p"=>"Papa", "q"=>"Quebec", "r"=>"Romeo", 
 					 "s"=>"Sierra", "t"=>"Tango", "u"=>"Uniform",
					 "v"=>"Victor", "w"=>"Whiskey", "x"=>"X-Ray",
					 "y"=>"Yankee", "z"=>"Zulu", "0"=>"Zero", 
					 "1"=>"One", "2"=>"Two", "3"=>"Three", 
 					 "4"=>"Four", "5"=>"Five", "6"=>"Six",
					 "7"=>"Seven", "8"=>"Eight", "9"=>"Nine",
					 "-"=>"Dash", " "=>"(Space)");
					 
					 

public function convertToNato($word) {
   
     $natoreturn = array();

     for($i=0; $i < strlen($word); $i++) { 	
          $currentLetter=substr($word,$i,1);
          
		  if (!empty($this->nato[$currentLetter])) {
               $natoletter=strtolower($this->nato[$currentLetter]);
          } 
		  else if (!empty($this->nato[strtolower($currentLetter)])) {
               $natoletter=strtoupper($this->nato[strtolower($currentLetter)]);
		  }
          else {
               $natoletter=$currentLetter;
          }
          $natoreturn[]=$natoletter;
     }

     return implode(" ",$natoreturn);
}

public function oneNatoWordPerLine($word) { 
	$word = $this->convertToNato($word); 
	$word = preg_replace("/\(space\) /is", "<br>" . PHP_EOL, $word); 
	return $word;
}

}
?>

<?php 
// some examples of usage 

$n = new Nato;
$word = (isset($_GET['word'])) ? $_GET['word'] : '';
$string = $n->convertToNato($word); 
$string_newline = $n->oneNatoWordPerLine($word); 
?>

<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
<label for="word">Enter string to convert:</label><input type="text" name="word" id="word" value="<?= $word ?>">
<button type="submit">Convert String</button>
</form>

<div style="margin-bottom: 10px;">
<p><b>Converted string:</b></p>
<p><?= $string . PHP_EOL ?></p>
</div>

<div style="margin-bottom: 10px;">
<p><b>Converted string (one word per line):</b></p>
<p><?= $string_newline . PHP_EOL ?></p>
</div>