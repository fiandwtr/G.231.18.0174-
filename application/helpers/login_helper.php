<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
	function is_logged_in() {
	    // ambil instance Codeigniter yang ada
	    $CI =& get_instance();
	    
	    $user = $CI->session->userdata('logged_in');
	    if (!isset($user)) { return false; } else { return true; }
	}
}
