<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_groups_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->loadTable('users_groups');
    }

}

