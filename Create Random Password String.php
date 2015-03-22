<?php 

function createRandom($number_of_digits=1,$type=3){
    /* generate random strings */
    /* type: 1 - numeric, 2 - letters, 3 - mixed */
	$num = "";
	$r = ""; 
    for($x=0;$x<$number_of_digits;$x++){
        while(substr($num,strlen($num)-1,strlen($num)) == $r){
            switch($type){
                case "1":
                $r = rand(0,9);
                break;
               
                case "2":
                $r = chr(rand(0,25)+65);
                break;
               
                case "3":
                if(is_numeric(substr($num,strlen($num)-1,strlen($num)))){
                 $n = rand(0,999);
                 if($n % 2){
                    $r = chr(rand(0,25)+65);
                } else {
                    $r = strtolower(chr(rand(0,25)+65));
                }                    
                } else {
                 $r = rand(0,9);   
                }               
                break;
                }           
        } 
        $num .= $r;
    }
    return $num;
}

echo createRandom(8,3);