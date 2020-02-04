<?php

class Migrate extends CI_Controller
{

        function __construct()
        {
            parent::__construct();
                if (!$this->ion_auth->logged_in())
                {
                        redirect('auth/login');
                }
        }


        public function index()
        {
                $this->load->library('migration');

                if ($this->migration->current() === FALSE)
                {
                        show_error($this->migration->error_string());
                }else{
                        echo 'migration Success';
                }
        }

        public function ver($index){
                $this->load->library('migration');
                if ($this->migration->current($index) === FALSE)
                {
                        show_error($this->migration->error_string());
                }else{
                        $this->migration->version($index);
                        echo 'migration Success';
                }
        }

}