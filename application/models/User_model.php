<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	function get_user($usename, $pwd)
	{
		$this->db->select('staff_login.*,staff.name,staff.photo,staff.whatsapp,staff.designation,staff.mobile,staff.staff_id,staff.staff_id');
        $this->db->from('staff_login');
        $this->db->join("staff","staff.id=staff_login.staff_key");
		$this->db->where('staff_login.username', $usename);
		$this->db->where('staff_login.password', $pwd);
        $res=$this->db->get()->result();
        return $res;
	}
	function get_menu($uid){
		$this->db->select('*');
        $this->db->from('menu_control');
		$this->db->where('user_id', $uid);
        $res=$this->db->get()->result();
        return $res;
	}
	
	// get user
	function get_user_by_id($id)
	{
		$this->db->where('id', $id);
        $query = $this->db->get('user');
		return $query->result();
	}
	
	
	function insert_user($data)
    {
		return $this->db->insert('users', $data);
	}
	
	function get_UserById($userid)
	{
		$res=$this->db->get_where('users',array('id'=> $userid))->result();
		return $res[0];
	}
	function Update_user($data,$id)
	{
	   $this->db->where('id',$id);
       $this->db->update('users',$data);
       return $this->db->affected_rows();
	}
	
}?>