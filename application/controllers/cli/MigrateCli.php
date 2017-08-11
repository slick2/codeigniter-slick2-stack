<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( PHP_SAPI !== 'cli' ) exit('No web access allowed');

class MigrateCli extends CI_Controller
{
        public function __construct(){
            parent::__construct();
            $this->load->library('migration');
        }

        public function index()
        {

                if ($this->migration->current() === FALSE)
                {
                        show_error($this->migration->error_string());
                }else{
                    echo 'Migration Version: '.$this->migration->current();
                    echo PHP_EOL;

                }
        }

        /* this should not be called on production, this will erase all data
         * FOR DEVELOPMENT PURPOSE ONLY
         **/


        public function rollback($version=0){
            echo $this->migration->version($version);
            echo PHP_EOL;
        }

}