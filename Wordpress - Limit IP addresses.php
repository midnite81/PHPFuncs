<?php 
/**
 * Plugin Name: Keep out External
 * Plugin URI: http://localhost/
 * Description: A plug in to keep out external visitors by IP range (unless using a special key in the querystring)
 * Version: 1.0
 * Author: Simon Rogers
 * Author URI: http://localhost/
 * License: GPL2
 */
 
 /*
This is simply a PHP script for wordpress, there is no admin config page. 
 */

defined('ABSPATH') or die("No script kiddies please!");

class keepOut {
	private $secureIP = '150.30.20.10'; 
	private $secureLocalRegex = '/^(10\.0\.1[0-5]\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5]))$/i';
	private $notAuthedUrl = '/403/not-authorised';
	private $extKey = '92049cjqsalkxm30cnq';
	private $siteKey = '54c83nc04ag£x';
    private $pluginurl = '';
	private $wpweb = 'http://mysite.org/wordpress';
	
	public function __construct() { 
		add_action('wp',array($this, 'stayOrGo'));
		add_action('wp',array($this, 'updateAuthUrl'));
		add_action('save_post',array($this, 'addAuthUrl'));
		add_action('init',array($this, 'rewrite')); 
		$this->pluginurl = plugins_url();
		$this->noCache();
		if (!session_id()) session_start();
		if (isset($_GET['siteKey']) and $_GET['siteKey'] == $this->siteKey) $this->setAuthKey(); 
		
	} 
	
	public function rewrite() { 
		global $wp_rewrite;
		$plugin_url = plugins_url( 'not_authorised.php', __FILE__ );
		$plugin_url = substr( $plugin_url, strlen( home_url() ) + 1 );
		add_rewrite_rule('403/not-authorised$', $plugin_url, 'top');
		if (@$_GET['flusheverything'] == 1) { 
		echo (function_exists('add_rewrite_rule')) ? "Add rewrite rule exists" : "Add rewrite rule doesnt exist"; 
		echo (function_exists('flush_rewrite_rules')) ? "Flush Rewrite Rules exists" : "Flush rewrite rules doesnt exist"; 			
			flush_rewrite_rules(); 
			$wp_rewrite->flush_rules();
			echo "done<br>";
			header('Location: ' . home_url()); 
			die();
		 } 
	} 
	
	public function isAuthenticated() {
		$return = false; 
		if ($_SERVER['REMOTE_ADDR'] == $this->secureIP) { $return = true;  }
		else if (preg_match($this->secureLocalRegex,$_SERVER['REMOTE_ADDR'])){  $return = true; } 
		else if ($_SESSION['extKey'] == $this->extKey) { $return = true; }
		return $return; 
	} 	
	
	public function setAuthKey() { 
		$_SESSION['extKey'] = $this->extKey; 
	} 
	
	public function stayOrGo() {
		if (!$this->isAuthenticated() and (is_page() or is_front_page() or is_home())) {
			header('Location: ' . $this->wpweb. $this->notAuthedUrl);
			 die(); 
		}
	} 
	
	public function addAuthUrl($post_id) { 
		 update_post_meta( $post_id, 'Authorised_Url', $this->wpweb . '/?p=' . $post_id . '&siteKey=' . $this->siteKey );
		 update_post_meta( $post_id, 'General_Url', $this->wpweb . '/?siteKey=' . $this->siteKey );
	} 
	
	public function updateAuthUrl() { 
		if(have_posts()) {
          while(have_posts()) {
           the_post();
		   $id = get_the_id(); 
		   update_post_meta( $id, 'Authorised_Url', $this->wpweb . '/?p=' . $post_id . '&siteKey=' . $this->siteKey);
		   update_post_meta( $id, 'General_Url', $this->wpweb . '/?siteKey=' . $this->siteKey );
          }
		}
	} 
	
	public function noCache() { 
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	} 


} 

$ko = new keepOut();