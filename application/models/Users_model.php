<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

	const group_admins = 1;
	const group_members = 2;

	function __construct()
	{
		parent::__construct();
		$this->loadTable('users');
	}

	function getInfo($uid, $idAsKey = false, $pager = [])
	{
		if (empty($uid))
			return false;
		$multiple = false;
		if (is_array($uid))
		{
			$multiple = true;
			$uid = join(",", $uid);
		}

		$fields = "
            `users_model`.`id` as `id`,  `users_model`.`username`, `users_model`.`email` as `email`,
            `users_model`.`created_on` as `created_on`, `users_model`.`last_login` as `last_login`,
            `users_model`.`active` as `active`, `users_model`.`first_name` as `first_name`,
            `users_model`.`last_name` as `last_name`, `users_model`.`phone` as `phone`, `users_model`.`referral_code` as `referral_code`,
            `users_model`.`status` as `status`, (IF(`users_model`.`verification_code` IS NULL, 0, 1)) as `verified`,
            group_concat(`users_groups_model`.group_id) as `group`,
            group_concat(`users_groups_model`.group_id) as `groups`";

		$joins = array(
			array("users_groups as users_groups_model", "users_groups_model.user_id = users_model.id"),
			'group' => 'users_model.id'
		);

		if (!$multiple)
		{
			$where = array('users_model.id' => $uid);
		}
		else
		{
			$where = "users_model.id IN ($uid)";
		}

		if (!empty($pager))
		{
			$page = 0;
			$perpage = 0;
			if (isset($pager['page']))
				$page = $pager['page'];
			if (isset($pager['perpage']))
				$perpage = $pager['perpage'];

			if (isset($pager['_fields']))
				$fields = $pager['_fields'];

			if ($page < 1)
				$page = 1;
			if ($perpage < 1)
				$perpage = 1000;
		} else
		{
			$page = 1;
			$perpage = 1000;
		}
	
		$data = $this->getAllWithJoins('users_model', $joins, $where, $fields, null, $page, $perpage);
		
		
		if (!$data)
			return false;


		if (!$multiple)
		{
			$info = $data[0];
			$info = $this->parseRowToUserInfo($info);


			$kinfo[$info['id']] = $info;
		}
		else
		{
			$info = $kinfo = array();

			foreach ($data as $d)
			{
				$dd = $d;

				$dd = $this->parseRowToUserInfo($dd);

				$info[] = $dd;
				$kinfo[$dd['id']] = $dd;
			}

			if (!$idAsKey)
				return $info;

			return $kinfo;
		}

		if ($idAsKey)
			return $kinfo;
		//print_r($info);
		return $info;
	}

	function parseRowToUserInfo($info)
	{
		$info['location'] = null;


		if (!empty($info['first_name']))
			$info['details']['firstname'] = $info['first_name'];
		if (!empty($info['last_name']))
			$info['details']['lastname'] = $info['last_name'];
		if (!empty($info['email']))
			$info['details']['email'] = $info['email'];

		if (isset($info['groups']))
		{
			$info['groups'] = array_unique(explode(",", $info['groups']));
			$info['groups'] = array_values($info['groups']);
		}

		if (isset($info['first_name']) && isset($info['last_name']))
		{
			$info['fullname'] = ucwords($info['first_name'] . ' ' . $info['last_name']);
			$info['firstname'] = $info['first_name'];
			$info['lastname'] = $info['last_name'];
		}

		return $info;
	}

}
