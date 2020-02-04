<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realisasi {
		var $template_data = array();
		var $page_title;
		var $page_title_small;



		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
			/*
			//load data template
					function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
					{               
						$this->CI =& get_instance();
						$this->set('page_title', strtoupper($view));
						$this->set('page_title_small', $this->page_title_small);
						$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
						return $this->CI->load->view($template, $this->template_data, $return);
					}
			*/

///////////////////////////////////////////
var $nilai; 
var $mc_lalu; 

var $FISIK; 
var $gatMC; 
var $getUMK; 
var $getRETENSI;

var $pajakPPn; 
var $pajakPPh; 






	function hitung($kelas){

		
		return $nilai;
	}

	function pph($kelas){

	}

	function ppn($kelas){

	}




}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */