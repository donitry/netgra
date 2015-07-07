<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展Control
 * @author don
 */

class MR_Controller extends CI_Controller {
    
    function __construct() {
        parent::__construct ();
        $this->load->library('session');
    }
}