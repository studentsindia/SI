<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get_covers()
	{
		$this->db->select('*');
		$this->db->from('banners');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
    function save_syllabus_new($data){
        return  $this->db->insert('syllabus', $data);
    }
    function get_syllabus($sort){
        $this->db->select('*');
        $this->db->from('syllabus');
        $this->db->where('status',1);
        if($sort!=''){
            $this->db->order_by($sort,'ASC');
        }else{
            $this->db->order_by('id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function update_syllabus($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('syllabus',$data);
    }
    function get_english_books(){
        $data=array();
        $this->db->select('*');
        $this->db->from('editions');
        $this->db->where('current',2);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $this->db->select('books.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname,editions.title as edtitle');
            $this->db->from('books');
            $this->db->join('syllabus','books.syllabus=syllabus.id');
            $this->db->join('medium','books.medium=medium.id');
            $this->db->join('classes','books.class=classes.id');
            $this->db->join('editions','books.edition=editions.id');
            $this->db->where('books.edition',$res[0]['id']);
            $this->db->where('books.medium',1);
            $this->db->where('books.status',1);
            return $this->db->get()->result_array();
        }
    }
    function get_malayalam_books(){
        $data=array();
        $this->db->select('*');
        $this->db->from('editions');
        $this->db->where('current',2);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $this->db->select('books.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname,editions.title as edtitle');
            $this->db->from('books');
            $this->db->join('syllabus','books.syllabus=syllabus.id');
            $this->db->join('medium','books.medium=medium.id');
            $this->db->join('classes','books.class=classes.id');
            $this->db->join('editions','books.edition=editions.id');
            $this->db->where('books.edition',$res[0]['id']);
            $this->db->where('books.medium',2);
            $this->db->where('books.status',1);
            return $this->db->get()->result_array();
        }
    }
    function get_cbse_books(){
        $data=array();
        $this->db->select('*');
        $this->db->from('editions');
        $this->db->where('current',2);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $this->db->select('books.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname,editions.title as edtitle');
            $this->db->from('books');
            $this->db->join('syllabus','books.syllabus=syllabus.id');
            $this->db->join('medium','books.medium=medium.id');
            $this->db->join('classes','books.class=classes.id');
            $this->db->join('editions','books.edition=editions.id');
            $this->db->where('books.edition',$res[0]['id']);
            $this->db->where('books.medium',3);
            $this->db->where('books.status',1);
            return $this->db->get()->result_array();
        }
    }
}