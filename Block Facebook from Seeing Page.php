<?php 

//function to prevent facebook from grabbing contents of page
//by redirecting it to another page.
//you could comment out the redirect line should you wish the page 
//to simply 'die'. 


function preventFacebook() {
$ua = $_SERVER['HTTP_USER_AGENT'];
$replacementPage = "otherpage.php";

if (preg_match('/facebookexternalhit/si',$ua)) 
	{ 
	header('Location: ' $replacementPage); 
	die() ; 
	} 
}


preventFacebook(); 
