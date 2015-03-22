<?
/* 
This is my take on the infamous FizzBuzz test. There are many different ways you can do it, 
whether transactionally or whether you do it in a more modular way for change of business logic at a later stage
*/


/* 
First method 
Using if, else if and else statements
*/

for($i=1;$i<=100;$i++){
  if($i%15==0){ echo "FizzBuzz<br>\n"; }
  else if($i%3==0){ echo "Fizz<br>\n"; }
  else if($i%5==0){ echo "Buzz<br>\n"; }
  else { echo $i."<br>\n"; }
}

/* 
Second method 
Using ternary operators
*/


for ($i=1;$i<=100;$i++)
    echo (($x=($i%3?'':'Fizz').($i%5?'':'Buzz'))?$x:$i)."<br>\n";
	
	
/*
Third Method
Modularise the process
*/

function Fizzbuzz($i) { 
	if ($i % 15 == 0) return true;
	else return false; 
} 
function Fizz($i) { 
	if ($i % 3 == 0) return true;
	else return false; 
} 
function Buzz($i) { 
	if ($i % 5 == 0) return true;
	else return false; 
} 
function DisplayOutput($i) {
	$nl = "<br>\n";
	if (Fizzbuzz($i)) return "Fizzbuzz" . $nl;
	elseif (Fizz($i)) return "Fizz" . $nl; 
	elseif (Buzz($i)) return "Buzz" . $nl;
	else return $i . $nl; 
} 

for($i=1;$i<=100;$i++){
  	echo DisplayOutput($i); 
}
