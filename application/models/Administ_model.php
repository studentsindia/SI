<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administ_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function Get_notification()
	{
		$user=$this->session->userdata('uid');
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('id_to',$user);
		$this->db->order_by("id", "DESC");
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
    function get_syllabus_details($id){
        $this->db->select('*');
        $this->db->from('syllabus');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_classes_details($id){
        $this->db->select('*');
        $this->db->from('classes');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_syllabus_list(){
        $this->db->select('*');
        $this->db->from('syllabus');
        $this->db->where('status',1);
        $this->db->where('active_status',1);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function save_medium_new($d2){
        return  $this->db->insert('medium', $d2);
    }
    function save_annual_new($d2){
        return  $this->db->insert('annual_pricing', $d2);
    }
    function save_books($data){
        return  $this->db->insert('books', $data);
    }
    function save_subject_new($d2){
        return  $this->db->insert('subjects', $d2);
    }
    function save_class_new($d2){
        return  $this->db->insert('classes', $d2);
    }
    function save_edition_new($d2){
        return  $this->db->insert('editions', $d2);
    }
    function get_medium($sort,$syllabus){
        $this->db->select('medium.*,syllabus.name as syllabusname');
        $this->db->from('medium');
        $this->db->join('syllabus','medium.syllabus=syllabus.id');
        $this->db->where('medium.status',1);

        if($syllabus!=''){
            $this->db->where('medium.syllabus',$syllabus);
        }
        if($sort!=''){
            $this->db->order_by('medium.'.$sort,'ASC');
        }else{
            $this->db->order_by('medium.id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_editions(){
        $this->db->select('editions.*,academic_year.title as acyear');
        $this->db->from('editions');
        $this->db->join('academic_year','editions.ac_year=academic_year.id');
        $this->db->where('editions.status',1);
        $res=$this->db->get()->result_array();

        return $res;
    }
    function get_accademicyear(){
        $this->db->select('*');
        $this->db->from('academic_year');
        $this->db->where('active_status',1);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function update_medium($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('medium',$data); 
    }
    function update_books($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('books',$data); 
    }
    function get_medium_details($id){
        $this->db->select('*');
        $this->db->from('medium');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_mediums($syllabus){
        $this->db->select('*');
        $this->db->from('medium');
        $this->db->where('syllabus',$syllabus);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_classeslist($classes){
        $this->db->select('*');
        $this->db->from('classes');
        $this->db->where('medium',$classes);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_subjects($sort,$syllabus,$medium,$classes){
        $this->db->select('subjects.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname');
        $this->db->from('subjects');
        $this->db->join('syllabus','subjects.syllabus=syllabus.id');
        $this->db->join('medium','subjects.medium=medium.id');
        $this->db->join('classes','subjects.class=classes.id');
        $this->db->where('subjects.status',1);
        if($syllabus!=''){
            $this->db->where('subjects.syllabus',$syllabus);
        }
        if($medium!=''){
            $this->db->where('subjects.medium',$medium);
        }
        if($classes!=''){
            $this->db->where('subjects.class',$classes);
        }
        if($sort!=''){
            $this->db->order_by('subjects.'.$sort,'ASC');
        }else{
            $this->db->order_by('subjects.id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_annual_price($sort,$syllabus,$medium,$classes){
        $this->db->select('annual_pricing.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname');
        $this->db->from('annual_pricing');
        $this->db->join('syllabus','annual_pricing.syllabus=syllabus.id');
        $this->db->join('medium','annual_pricing.medium=medium.id');
        $this->db->join('classes','annual_pricing.class=classes.id');
        $this->db->where('annual_pricing.status',1);
        if($syllabus!=''){
            $this->db->where('annual_pricing.syllabus',$syllabus);
        }
        if($medium!=''){
            $this->db->where('annual_pricing.medium',$medium);
        }
        if($classes!=''){
            $this->db->where('annual_pricing.class',$classes);
        }
        if($sort!=''){
            $this->db->order_by('annual_pricing.'.$sort,'ASC');
        }else{
            $this->db->order_by('annual_pricing.id','ASC');
        }
        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        return $res;
    }
    function get_books($sort,$syllabus,$medium,$classes,$edition){
        $this->db->select('books.*,classes.name as clsname,syllabus.name as syllabusname,medium.name as mname');
        $this->db->from('books');
        $this->db->join('syllabus','books.syllabus=syllabus.id');
        $this->db->join('medium','books.medium=medium.id');
        $this->db->join('classes','books.class=classes.id');
        $this->db->where('books.status',1);
        if($syllabus!=''){
            $this->db->where('books.syllabus',$syllabus);
        }
        if($medium!=''){
            $this->db->where('books.medium',$medium);
        }
        if($classes!=''){
            $this->db->where('books.class',$classes);
        }
        if($sort!=''){
            $this->db->order_by('books.'.$sort,'ASC');
        }else{
            $this->db->order_by('books.id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_classes($sort,$syllabus,$medium){
        $this->db->select('classes.*,syllabus.name as syllabusname,medium.name as mname');
        $this->db->from('classes');
        $this->db->join('syllabus','classes.syllabus=syllabus.id');
        $this->db->join('medium','classes.medium=medium.id');
        $this->db->where('medium.status',1);

        if($syllabus!=''){
            $this->db->where('classes.syllabus',$syllabus);
        }
        if($medium!=''){
            $this->db->where('classes.medium',$medium);
        }
        if($sort!=''){
            $this->db->order_by('classes.'.$sort,'ASC');
        }else{
            $this->db->order_by('classes.id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function update_classes($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('classes',$data); 
    }
    function update_edition($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('editions',$data);
    }















    function get_all_staffs($key,$sort){
        $this->db->select('*');
        $this->db->from('staff');
        if($key!=''){
            $this->db->like('name',$key);
        }
        if($sort!=''){
            $this->db->order_by($sort,'ASC');
        }else{
            $this->db->order_by('id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_course_list($key,$sort){
        $this->db->select('*');
        $this->db->from('course');
        if($key!=''){
            $this->db->like('course_name',$key);
        }
        if($sort!=''){
            $this->db->order_by($sort,'ASC');
        }else{
            $this->db->order_by('id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_company_list($key,$sort){
        $this->db->select('*');
        $this->db->from('company');
        if($key!=''){
            $this->db->like('name',$key);
        }
        if($sort!=''){
            $this->db->order_by($sort,'ASC');
        }else{
            $this->db->order_by('id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_vaccencies_list($key,$sort,$id){
        $this->db->select('*');
        $this->db->from('vaccency');
        $this->db->where("company_id",$id);
        if($key!=''){
            $this->db->like('post_name',$key);
        }
        if($sort!=''){
            $this->db->order_by($sort,'ASC');
        }else{
            $this->db->order_by('id','ASC');
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_all_placed_list($id){
        $this->db->select('placed_list.*,students.name,students.photo');
        $this->db->from('placed_list');
        $this->db->where("placed_list.company_id",$id);
        $this->db->join("students",'placed_list.student_id=students.id');
        $this->db->order_by('placed_list.date','DESC');
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_only_placed_list($id,$company_id){
        $this->db->select('placed_list.*,students.name,students.photo');
        $this->db->from('placed_list');
        $this->db->where("placed_list.company_id",$company_id);
        $this->db->where("placed_list.vaccency_id",$id);
        $this->db->join("students",'placed_list.student_id=students.id');
        $this->db->order_by('placed_list.date','DESC');
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_batches_list($sort){
        $this->db->select('*');
        $this->db->from('batches');
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("course_id",$sort[$m]);
                }else{
                    $this->db->or_where("course_id",$sort[$m]);
                }
                $m++;
            }
        }
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_batches_list_admin($course){
        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where("course_id",$course);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_batches_list_u1($course,$id){
        $this->db->select('batch_staffs.batch_id,batches.*');
        $this->db->from('batch_staffs');
        $this->db->join('batches','batch_staffs.batch_id=batches.id');
        $this->db->where("batch_staffs.staff_id",$id);
        $this->db->where("batches.course_id",$course);
        $this->db->where("batches.batch_status",2);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_batches_lists($course_id){
        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where("course_id",$course_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_users_list(){
        $this->db->select('login.id,staff.staff_id,staff.name');
        $this->db->from('login');
        $this->db->join("staff",'login.staff_key=staff.id');
        $res=$this->db->get()->result_array();
        return $res;
    }
    
    function get_students_details($key,$sort,$sorts,$filter){
        $data=array();
        $this->db->select('batch_stdents.id,batch_stdents.batch_id,batch_stdents.student_id,batch_stdents.mode_of_pay,batch_stdents.fees,batch_stdents.details,students.address,students.place,students.pin,students.name,students.photo,students.phone_number,students.whatsapp,students.parent_number,students.gender,students.sslc_status,students.plus_two_status,students.degree_status,students.person_id_status,students.sslc,students.plus_two,students.degree,students.person_id,students.status,course.course_name,course.id as csid,batches.course_id,batches.batch_name');
        $this->db->from('batch_stdents');
        $this->db->join("students",'batch_stdents.student_id=students.id');
        $this->db->join("batches",'batch_stdents.batch_id=batches.id');
        $this->db->join("course",'batches.course_id=course.id');
        //$this->db->where('batch_stdents.batch_id',$batch_id);
        if($key!=''){
            $this->db->like('students.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->or_where("course.id",$sort[$m]);
                }else{
                    $this->db->or_where("course.id",$sort[$m]);
                }
                $m++;
            }
        }
        if(!empty($filter)){
                $this->db->where("batches.id",$filter);
        }
        if($sorts!=''){
            $this->db->order_by($sorts,'ASC');
        }else{
            $this->db->order_by("course.id",'ASC');
        }
        if(!empty($search)){
            $this->db->like('students.name',$search);
        }
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['batch_id']=$r['batch_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['course_name']=$r['course_name'];
                $data[$i]['student_id']=$r['student_id'];
                $data[$i]['mode_of_pay']=$r['mode_of_pay'];
                $data[$i]['fees']=$r['fees'];
                $data[$i]['status']=$r['status'];

                $data[$i]['sslc_status']=$r['sslc_status'];
                $data[$i]['plus_two_status']=$r['plus_two_status'];
                $data[$i]['degree_status']=$r['degree_status'];
                $data[$i]['person_id_status']=$r['person_id_status'];

                $data[$i]['sslc']=$r['sslc'];
                $data[$i]['plus_two']=$r['plus_two'];
                $data[$i]['degree']=$r['degree'];
                $data[$i]['person_id']=$r['person_id'];

                $data[$i]['details']=$r['details'];
                $data[$i]['name']=$r['name'];
                $data[$i]['address']=$r['address'];
                $data[$i]['place']=$r['place'];
                $data[$i]['pin']=$r['pin'];
                $data[$i]['photo']=$r['photo'];
                $data[$i]['parent_number']=$r['parent_number'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['gender']=$r['gender'];

                $data[$i]['collected']=$this->get_student_students_collected($r['id']);
                $data[$i]['returned']=$this->get_batch_students_returned($r['id']);
                $i++;
            }
        }
        return $data;
    }
    function get_assigned_details($key,$sort,$sorts,$staffs,$batches,$start,$end){
        $data=array();
        $this->db->select('student_admit_user.*,students.name,students.phone_number,students.whatsapp,students.email,batches.batch_name,course.course_name,batch_stdents.mode_of_pay,batch_stdents.batch_fees,batch_stdents.fees,batch_stdents.added_date,staff.name as stname,login.id as logid');
        $this->db->from('student_admit_user');
        $this->db->join("students",'student_admit_user.student_id=students.id');
        $this->db->join("batches",'student_admit_user.batch=batches.id');
        $this->db->join("course",'student_admit_user.course=course.id');
        $this->db->join("batch_stdents",'students.id=batch_stdents.student_id');
        $this->db->join("login",'student_admit_user.staff_id=login.id');
        $this->db->join("staff",'login.staff_key=staff.id');
        $this->db->where("student_admit_user.date >",$start);
        $this->db->where("student_admit_user.date <",$end);
        if($key!=''){
            $this->db->like('students.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("student_admit_user.course",$sort[$m]);
                }else{
                    $this->db->or_where("student_admit_user.course",$sort[$m]);
                } 
                $m++;
            }
        }
        if(!empty($batches)){
        $this->db->where("student_admit_user.batch",$batches);
        }
        if(!empty($staffs)){
            $n1=count($staffs);$m1=0;
            while ($m1 <$n1) {
                if($m1==0){
                    $this->db->where("student_admit_user.added_user",$staffs[$m1]);
                }else{
                    $this->db->or_where("student_admit_user.added_user",$staffs[$m1]);
                } 
                $m1++;
            }
        }
        if($sorts!=''){
            $this->db->order_by($sorts,'ASC');
        }else{
            $this->db->order_by("staff",'ASC');
        }
        
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course'];
                $data[$i]['batch_id']=$r['batch'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['course_name']=$r['course_name'];
                $data[$i]['date']=$r['date'];
                $data[$i]['name']=$r['name'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['email']=$r['email'];
                $data[$i]['fees']=$r['fees'];
                $data[$i]['mode_of_pay']=$r['mode_of_pay'];
                $data[$i]['batch_fees']=$r['batch_fees'];
                $data[$i]['added_date']=$r['added_date'];
                $data[$i]['stname']=$r['stname'];
               
                $i++;
            }
        }
        return $data;
    }
    function get_selected_candidates_list($key,$sort,$sorts,$course,$batch){
        $data=array();
        
        $this->db->select('students.*,batch_stdents.batch_id,batches.batch_name,course.course_name,placed_list.date,placed_list.id asid,placed_list.vaccency_id as opening_id,placed_list.job_position,placed_list.salary,placed_list.details,placed_list.company_id');
        $this->db->from('placed_list');
        $this->db->join("students",'placed_list.student_id=students.id');
        $this->db->join("batch_stdents",'batch_stdents.student_id=students.id');
        $this->db->join("batches",'batches.id=batch_stdents.batch_id');
        $this->db->join("course",'course.id=batches.course_id');
        if(!empty($key)){
        $this->db->like('students.name',$key);
        $this->db->or_like('students.phone_number',$key);
        $this->db->or_like('students.whatsapp',$key);
        }
        if(!empty($batch)){
            $this->db->where("batches.id",$batch);
        }
        if(!empty($sort)){
            $n1=count($sort);$m1=0;
            while ($m1 <$n1) {
                if($m1==0){
                    $this->db->where("placed_list.company_id",$sort[$m1]);
                }else{
                    $this->db->or_where("placed_list.company_id",$sort[$m1]);
                } 
                $m1++;
            }
        }
        if(!empty($course)){
            $n=count($course);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("course.id",$course[$m]);
                }else{
                    $this->db->or_where("course.id",$course[$m]);
                } 
                $m++;
            }
        }
        if($sorts!=''){
            $this->db->order_by($sorts,'DESC');
        }else{
            $this->db->order_by("placed_list.id",'DESC');
        }
        
        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        if(!empty($res)){ $i=0;
            foreach($res as $r){
              
                $data[$i]['id']=$r['id'];
                $data[$i]['asid']=$r['asid'];
                $data[$i]['company_id']=$r['company_id'];
                $data[$i]['job_position']=$r['job_position'];
                $data[$i]['salary']=$r['salary'];
                $data[$i]['details']=$r['details'];
                $data[$i]['opening_id']=$r['opening_id'];
                $data[$i]['name']=$r['name'];
                $data[$i]['place']=$r['place'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['email']=$r['email'];
                $data[$i]['qualification']=$r['qualification'];
                $data[$i]['dob']=$r['dob'];
                $data[$i]['gender']=$r['gender'];
                $data[$i]['age']=$r['age'];
                $data[$i]['sslc_status']=$r['sslc_status'];
                $data[$i]['plus_two_status']=$r['plus_two_status'];
                $data[$i]['degree_status']=$r['degree_status'];
                $data[$i]['person_id_status']=$r['person_id_status'];

                $data[$i]['batch_id']=$r['batch_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['course_name']=$r['course_name'];
                $data[$i]['company_name']=$this->get_company_name($r['company_id']);
                $data[$i]['fees']=$this->get_fees_students($r['id']);
                $data[$i]['assigned']=$this->get_assigned_interviews($r['id']);
                $data[$i]['placed']=$this->get_placed_interviews($r['id']);
                $i++;
                
                
            }
         }
        return $data;
    }
    function get_company_name($company_id){
        $this->db->select('name');
        $this->db->from('company');
        $this->db->where('id',$company_id);
        $res=$this->db->get()->result_array();
        return $res[0]['name'];
    }
    function get_openingstudents_list($id,$key,$sort,$sorts){
        $data=array();
        
        $this->db->select('students.*,batch_stdents.batch_id,batches.batch_name,course.course_name,assigned_openings.date,assigned_openings.id asid,assigned_openings.opening_id');
        $this->db->from('assigned_openings');
        $this->db->join("students",'assigned_openings.student_id=students.id');
        $this->db->join("batch_stdents",'batch_stdents.student_id=students.id');
        $this->db->join("batches",'batches.id=batch_stdents.batch_id');
        $this->db->join("course",'course.id=batches.course_id');
        $this->db->where("assigned_openings.opening_id",$id);
        if(!empty($key)){
        $this->db->like('students.name',$key);
        $this->db->or_like('students.phone_number',$key);
        $this->db->or_like('students.whatsapp',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("course.id",$sort[$m]);
                }else{
                    $this->db->or_where("course.id",$sort[$m]);
                } 
                $m++;
            }
        }
        if($sorts!=''){
            $this->db->order_by($sorts,'DESC');
        }else{
            $this->db->order_by("assigned_openings.id",'DESC');
        }
        
        $res=$this->db->get()->result_array();
        if(!empty($res)){ $i=0;
            foreach($res as $r){
              
                $data[$i]['id']=$r['id'];
                $data[$i]['asid']=$r['asid'];
                $data[$i]['opening_id']=$r['opening_id'];
                $data[$i]['name']=$r['name'];
                $data[$i]['place']=$r['place'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['email']=$r['email'];
                $data[$i]['qualification']=$r['qualification'];
                $data[$i]['dob']=$r['dob'];
                $data[$i]['gender']=$r['gender'];
                $data[$i]['age']=$r['age'];
                $data[$i]['sslc_status']=$r['sslc_status'];
                $data[$i]['plus_two_status']=$r['plus_two_status'];
                $data[$i]['degree_status']=$r['degree_status'];
                $data[$i]['person_id_status']=$r['person_id_status'];

                $data[$i]['batch_id']=$r['batch_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['course_name']=$r['course_name'];

                $data[$i]['fees']=$this->get_fees_students($r['id']);
                $data[$i]['assigned']=$this->get_assigned_interviews($r['id']);
                $data[$i]['placed']=$this->get_placed_interviews($r['id']);
                $data[$i]['placemented']=$this->get_thisplaced_status($r['id'],$r['opening_id']);
                $i++;
                
                
            }
         }
        return $data;
    }
    function get_thisplaced_status($student_id,$opening_id){
        $this->db->select('id');
        $this->db->from('placed_list');
        $this->db->where('student_id',$student_id);
        $this->db->where('vaccency_id',$opening_id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return 1;
        }else{
            return 0;
        }  
    }
    function get_job_position($opening_id){
        $this->db->select('post_name,company_id');
        $this->db->from('vaccency');
        $this->db->where('id',$opening_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_assn_studentslist($key,$sort,$id){
        $data=array();
        if(!empty($key)||$sort!=''){
        $this->db->select('students.*,batch_stdents.batch_id,batches.batch_name,course.course_name');
        $this->db->from('students');
        $this->db->join("batch_stdents",'batch_stdents.student_id=students.id');
        $this->db->join("batches",'batches.id=batch_stdents.batch_id');
        $this->db->join("course",'course.id=batches.course_id');
        if(!empty($key)){
        $this->db->like('students.name',$key);
        $this->db->or_like('students.phone_number',$key);
        $this->db->or_like('students.whatsapp',$key);
        }
        if($sort!=''){
            $this->db->where('course.id',$sort);
        }
        
        $res=$this->db->get()->result_array();
        if(!empty($res)){ $i=0;
            foreach($res as $r){
                $rm=$this->get_assign_checked($r['id'],$id);
                if(empty($rm)){
                $data[$i]['id']=$r['id'];
                $data[$i]['name']=$r['name'];
                $data[$i]['place']=$r['place'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['email']=$r['email'];
                $data[$i]['qualification']=$r['qualification'];
                $data[$i]['dob']=$r['dob'];
                $data[$i]['gender']=$r['gender'];
                $data[$i]['age']=$r['age'];
                $data[$i]['sslc_status']=$r['sslc_status'];
                $data[$i]['plus_two_status']=$r['plus_two_status'];
                $data[$i]['degree_status']=$r['degree_status'];
                $data[$i]['person_id_status']=$r['person_id_status'];

                $data[$i]['batch_id']=$r['batch_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['course_name']=$r['course_name'];

                $data[$i]['fees']=$this->get_fees_students($r['id']);
                $data[$i]['assigned']=$this->get_assigned_interviews($r['id']);
                $data[$i]['placed']=$this->get_placed_interviews($r['id']);
                $i++;
                }
                
            }
        }
        return $data;
        }
    }
    function get_placed_interviews($id){
        $this->db->select('count(id)as totalcount');
        $this->db->from('placed_list');
        $this->db->where('student_id',$id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['totalcount'];
        }else{
            return 0;
        }
    }
    function get_opening_company_id($id){
        $this->db->select('company_id');
        $this->db->from('vaccency');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res[0]['company_id'];
    }
    function get_assigned_interviews($id){
        $this->db->select('count(id)as totalcount');
        $this->db->from('assigned_openings');
        $this->db->where('student_id',$id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['totalcount'];
        }else{
            return 0;
        }
    }
    function get_assign_checked($id,$op_id){
        $this->db->select('id');
        $this->db->from('assigned_openings');
        $this->db->where('student_id',$id);
        $this->db->where('opening_id',$op_id);
        return $this->db->get()->result_array();
    }
    function print_fees_bill($id,$student_id){
        $data=array();
        $this->db->select('fees_collection.*,students.name,course.course_name,batches.batch_name');
        $this->db->from('fees_collection');
        $this->db->join('students',"students.id=fees_collection.student_id");
        $this->db->join('batches',"batches.id=fees_collection.batch_id");
        $this->db->join('course',"course.id=batches.course_id");
        $this->db->where('fees_collection.id',$id);
        $this->db->where('fees_collection.student_id',$student_id);
        $this->db->where('fees_collection.status',1);
        return $this->db->get()->result_array();
    }
    function get_student_totfees($student_id){
        $this->db->select('fees');
        $this->db->from('batch_stdents');
        $this->db->where('student_id',$student_id);
        return $this->db->get()->result_array();
    }
    function get_student_totfeespaid($student_id){
        $this->db->select('sum(amount) as tpaid');
        $this->db->from('fees_collection');
        $this->db->where('student_id',$student_id);
        $this->db->where('status',1);
        return $this->db->get()->result_array();
    }
    function get_student_totfeesemi($student_id){
        $this->db->select('count(id) as temi');
        $this->db->from('fees_collection');
        $this->db->where('student_id',$student_id);
        $this->db->where('status',1);
        return $this->db->get()->result_array();
    }
    function get_fees_students($id){
        $status='';
        $this->db->select('fees');
        $this->db->from('batch_stdents');
        $this->db->where('student_id',$id);
        $res=$this->db->get()->result_array();
        $this->db->select('sum(amount) as totalfees');
        $this->db->from('fees_collection');
        $this->db->where('student_id',$id);
        $res1=$this->db->get()->result_array();
        if(!empty($res1)){
            if($res[0]['fees']==$res1[0]['totalfees']){
                $status='Fees Completed';
            }else if($res[0]['fees']>$res1[0]['totalfees']){
                $status='Fees Pending : ₹'.($res[0]['fees']-$res1[0]['totalfees']);
            }else if($res[0]['fees']<$res1[0]['totalfees']){
                $status='Return Amount: ₹'.($res1[0]['totalfees']-$res[0]['fees']);
            }
        }else{
            $status='Pending : ₹'.$res[0]['fees'];        
        }
        
        
        return $status;
    }
    function get_opening_lists($key,$sort,$sorts){
         $data=array();
        $this->db->select('vaccency.*,company.name as company_name,company.logo');
        $this->db->from('vaccency');
        $this->db->join("company",'company.id=vaccency.company_id');
        if($key!=''){
            $this->db->like('vaccency.post_name',$key);
        }
        $this->db->where("vaccency.ending_date >",date('Y-m-d'));
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("vaccency.company_id",$sort[$m]);
                }else{
                    $this->db->or_where("vaccency.company_id",$sort[$m]);
                }
                
                $m++;
            }
        }
        
        if($sorts!=''){
            $this->db->order_by('vaccency.'.$sorts,'ASC');
        }else{
            $this->db->order_by("vaccency.id",'DESC');
        }
        
        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['company_id']=$r['company_id'];
                $data[$i]['company_name']=$r['company_name'];
                $data[$i]['logo']=$r['logo'];
                $data[$i]['post_name']=$r['post_name'];
                $data[$i]['details']=$r['details'];
                $data[$i]['vaccencies']=$r['vaccencies'];
                $data[$i]['email']=$r['email'];
                $data[$i]['phone_no']=$r['phone_no'];
                $data[$i]['start_date']=$r['start_date'];
                $data[$i]['ending_date']=$r['ending_date'];
                $data[$i]['status']=$r['status'];
                $data[$i]['status']=$r['status'];
                $data[$i]['date_time']=$r['date_time'];

                $data[$i]['assigned']=$this->get_assigned_students($r['id']);
                $data[$i]['selected']=$this->getselected_students($r['id']);
                $i++;
            }
        }
        return $data;
    }
    function get_opening_list($key,$sort,$sorts,$filter){
        $data=array();
        $this->db->select('vaccency.*,company.name as company_name,company.logo');
        $this->db->from('vaccency');
        $this->db->join("company",'company.id=vaccency.company_id');
        if($key!=''){
            $this->db->like('vaccency.post_name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("vaccency.company_id",$sort[$m]);
                }else{
                    $this->db->or_where("vaccency.company_id",$sort[$m]);
                }
                
                $m++;
            }
        }
        if(!empty($filter)){
            $n1=count($filter);$m1=0;
            while ($m1 <$n1) {
                if($m1==0){
                    if($filter[$m1]==1){
                    $this->db->where("vaccency.ending_date >",date('Y-m-d'));
                    }
                    if($filter[$m1]==2){
                    $this->db->where("vaccency.ending_date <",date('Y-m-d'));
                    }
                }else{
                    if($filter[$m1]==1){
                    $this->db->or_where("vaccency.ending_date >",date('Y-m-d'));
                    }
                    if($filter[$m1]==2){
                    $this->db->or_where("vaccency.ending_date <",date('Y-m-d'));
                    }
                }
                
                
                $m1++;
            }
        }
        if($sorts!=''){
            $this->db->order_by('vaccency.'.$sorts,'ASC');
        }else{
            $this->db->order_by("vaccency.id",'DESC');
        }
        
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['company_id']=$r['company_id'];
                $data[$i]['company_name']=$r['company_name'];
                $data[$i]['logo']=$r['logo'];
                $data[$i]['post_name']=$r['post_name'];
                $data[$i]['details']=$r['details'];
                $data[$i]['vaccencies']=$r['vaccencies'];
                $data[$i]['email']=$r['email'];
                $data[$i]['phone_no']=$r['phone_no'];
                $data[$i]['start_date']=$r['start_date'];
                $data[$i]['ending_date']=$r['ending_date'];
                $data[$i]['status']=$r['status'];
                $data[$i]['status']=$r['status'];
                $data[$i]['date_time']=$r['date_time'];

                $data[$i]['assigned']=$this->get_assigned_students($r['id']);
                $data[$i]['selected']=$this->getselected_students($r['id']);
                $i++;
            }
        }
        return $data;
    }
    function getselected_students($id){
        $this->db->select('count(*)as total');
        $this->db->from('placed_list');
        $this->db->where('vaccency_id',$id);
        $res=$this->db->get()->result_array();
        $opcount=0;
        if(!empty($res)){
            $opcount=$res[0]['total'];
        }
        return $opcount;
    }
    function get_assigned_students($id){
        $this->db->select('count(*)as total');
        $this->db->from('assigned_openings');
        $this->db->where('opening_id',$id);
        $res=$this->db->get()->result_array();
        $opcount=0;
        if(!empty($res)){
            $opcount=$res[0]['total'];
        }
        return $opcount;
    }
    function get_batch_list($key,$sort,$sorts,$filter){
        $data=array();
        $this->db->select('*');
        $this->db->from('batches');
        if($key!=''){
            $this->db->like('batch_name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                $this->db->or_where("course_id",$sort[$m]);
                $m++;
            }
        }
        if(!empty($filter)){
            $n1=count($filter);$m1=0;
            while ($m1 <$n1) {
                $this->db->or_where("batch_status",$filter[$m1]);
                $m1++;
            }
        }
        if($sorts!=''){
            $this->db->order_by($sorts,'ASC');
        }else{
            $this->db->order_by("course_id",'ASC');
        }
        
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['starting_date']=$r['starting_date'];

                $data[$i]['ending_date']=$r['ending_date'];
                $data[$i]['total_fee']=$r['total_fees'];
                $data[$i]['discounted_fee']=$r['discounted_fee'];
                $data[$i]['emi_total_pay']=$r['emi_total_pay'];
                $data[$i]['batch_status']=$r['batch_status'];
                $data[$i]['details']=$r['details'];
                $data[$i]['status']=$r['status'];
                $data[$i]['created_date']=$r['created_date'];
                $data[$i]['course_name']=$this->get_batch_course_name($r['course_id']);
                $data[$i]['studentscount']=$this->get_batch_students_count($r['id']);
                $data[$i]['total_fees']=$this->get_batch_students_fees($r['id']);
                $data[$i]['collected']=$this->get_batch_students_collected($r['id']);
                $data[$i]['returned']=$this->get_batch_students_returned($r['id']);
                $i++;
            }
        }
        return $data;
    }
    function search_emergency_details($key){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->like('name',$key);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function grant_access_menu($uid){
        $this->db->select('*');
        $this->db->from('menu_control');
        $this->db->where('user_id',$uid);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_users_details($search){
        $this->db->select('login.id as uid,staff.*');
        $this->db->from('login');
        $this->db->join('staff','staff.id=login.staff_key');
        $this->db->like('staff.name',$search);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_staffs_details($key){
        $data=array();
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->like('name',$key);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $i=0;
            foreach($res as $r){
                $log=$this->get_logcheck($r['id']);
                if(empty($log)){
                    $data[$i]['id']=$r['id'];
                    $data[$i]['staff_id']=$r['staff_id'];
                    $data[$i]['name']=$r['name'];
                    $data[$i]['dob']=$r['dob'];
                    $data[$i]['photo']=$r['photo'];
                    $data[$i]['mobile']=$r['mobile'];
                    $data[$i]['designation']=$r['designation'];
                    $i++;
                }
            }

        }
        return $data;
    }
    function get_logcheck($id){
        $this->db->select('id');
        $this->db->from('login');
        $this->db->where('staff_key',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_batch_course_name($course_id){
        $this->db->select('course_name');
        $this->db->from('course');
        $this->db->where('id',$course_id);
        $res=$this->db->get()->result_array();
        $r1=$res[0]['course_name'];
        return $r1;
    }
    
    function get_course_id($batch_id){
        $this->db->select('course_id');
        $this->db->from('batches');
        $this->db->where('id',$batch_id);
        $res=$this->db->get()->result_array();
        $r1=$res[0]['course_id'];
        return $r1;
    }
    function get_student_certificates($student_id){
        $this->db->select('*');
        $this->db->from('students');
        $this->db->where('id',$student_id);
        return $res=$this->db->get()->result_array();
    }
    function get_other_income_list($start,$end){
        $this->db->select('*');
        $this->db->from('other_income');
        $this->db->where('date >',$start);
        $this->db->where('date <',$end);
        return $res=$this->db->get()->result_array();
    }
    function edit_vaccency($id){
        $this->db->select('*');
        $this->db->from('vaccency');
        $this->db->where('id',$id);
        return $res=$this->db->get()->result_array();
    }
    function show_attendance_stf($staff_id,$start,$end){
        $this->db->select('*');
        $this->db->from('staff_attendance');
        $this->db->where('staff_id',$staff_id);
        $this->db->where('date >=',$start);
        $this->db->where('date <=',$end);
        $this->db->order_by('id',"desc");
        return $res=$this->db->get()->result_array();
    }
    function show_student_fees_details($student_id){
        $this->db->select('*');
        $this->db->from('fees_collection');
        $this->db->where('student_id',$student_id);
        $this->db->order_by('id',"desc");
        return $res=$this->db->get()->result_array();
    }
    function show_student_course_details($student_id){
        $this->db->select('batch_stdents.batch_id,batch_stdents.fees,batch_stdents.mode_of_pay,batches.batch_name,course.course_name');
        $this->db->from('batch_stdents');
        $this->db->join('batches',"batches.id=batch_stdents.batch_id");
        $this->db->join('course',"course.id=batches.course_id");
        $this->db->where('batch_stdents.student_id',$student_id);
        return $res=$this->db->get()->result_array();
    }
    function get_fee_remainders($search,$sorts,$start,$end){
        $this->db->select('fees_emi_dates.*,students.id as stid,students.name,students.phone_number,students.whatsapp,students.email');
        $this->db->from('fees_emi_dates');
        $this->db->join('students',"students.id=fees_emi_dates.student_id");
        if(!empty($search)){
            $this->db->where('students.name',$search);
        }
        $this->db->where('fees_emi_dates.rem_date >=',$start);
        $this->db->where('fees_emi_dates.rem_date <=',$end);
        if(!empty($search)){
            $this->db->order_by($sorts);
        }else{
            $this->db->order_by('fees_emi_dates.id');
        }
        return $res=$this->db->get()->result_array();
    }
    
    function show_salary_stf($staff_id){
        $this->db->select('*');
        $this->db->from('staff_salary');
        $this->db->where('staff_id',$staff_id);
        $this->db->order_by('id',"desc");
        return $res=$this->db->get()->result_array();
    }
    function get_expense_list($start,$end,$key){
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('date >',$start);
        $this->db->where('date <',$end);
        if($key!=''){
            $this->db->like('title',$key);
        }
        $this->db->order_by('date','DESC');
        return $res=$this->db->get()->result_array();
    }
    function get_other_income_chart($start,$end){
        $this->db->select('date as date_time,sum(amount)as feeamount');
        $this->db->from('other_income');
        $this->db->where('date >=',$start);
        $this->db->where('date <=',$end);
        $this->db->group_by('date');
        $this->db->order_by('date','DESC');
        return $res=$this->db->get()->result_array();
    }
    function get_classes_list_user($course_id,$batch_id,$search){
        $this->db->select('classes.*,course.course_name,batches.batch_name');
        $this->db->from('classes');
        $this->db->join('course',"classes.course_id=course.id");
        $this->db->join('batches',"classes.batch_id=batches.id");
        $this->db->where('classes.course_id',$course_id);
        if(!empty($batch_id)){
            $this->db->where('classes.batch_id',$batch_id);
        }
        if(!empty($search)){
            $this->db->where('date',$search);
        }
        $this->db->order_by('id','DESC');
        return $res=$this->db->get()->result_array();
    }
    function get_students_attendance($id,$batch_id,$search){
        $data=array();
        $this->db->select('batch_stdents.student_id,students.name');
        $this->db->from('batch_stdents');
        $this->db->join('students',"batch_stdents.student_id=students.id");
        $this->db->where('batch_stdents.batch_id',$batch_id);
        if(!empty($search)){
            $this->db->like('students.name',$search);
        }
        $this->db->order_by('students.name');
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $i=0;
            foreach($res as $re){
                $data[$i]['student_id']=$re['student_id'];
                $data[$i]['name']=$re['name'];
                $data[$i]['atst']=$this->attendance_status($re['student_id'],$id,$batch_id);
                $i++;
            }
        }
        return $data;
    }
    function attendance_status($student_id,$class_id,$batch_id){
        $this->db->select('id as atst');
        $this->db->from('student_attendance');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('class_id',$class_id);
        $this->db->where('student_id',$student_id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['atst'];
        }else{
            return 0;
        }
    }
    function get_last_student_id(){
        $this->db->select('id');
        $this->db->from('students');
        $this->db->order_by('id','DESC');
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['id']+1;
        }else{
            return 0;
        }
    }
    function show_class_report($id){
        $this->db->select('classes.*,course.course_name,batches.batch_name,staff.name');
        $this->db->from('classes');
        $this->db->join('course',"classes.course_id=course.id");
        $this->db->join('batches',"classes.batch_id=batches.id");
        $this->db->join('staff',"classes.user=staff.id");
        $this->db->where('classes.id',$id);
        return $res=$this->db->get()->result_array();
    }
    function get_expense_chart($key,$start,$end){
        $this->db->select('date as date_time,sum(amount)as feeamount');
        $this->db->from('expenses');
        $this->db->where('date >=',$start);
        $this->db->where('date <=',$end);
        if($key!=''){
            $this->db->like('title',$key);
        }
        $this->db->group_by('date');
        $this->db->order_by('date','DESC');
        return $res=$this->db->get()->result_array();
    }
    function insert_staff($data){
        $this->db->insert('staff', $data);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }
    function insert_company($data){
        $this->db->insert('company', $data);
        return $this->db->insert_id();
    }
    function insert_course($data){
        $this->db->insert('course', $data);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function save_syllabus_contents($data){
        return  $this->db->insert('syllabus', $data);
    }
    function save_menu_access($d2){
        return  $this->db->insert('menu_control', $d2);
    }
    function save_emi_dates($d3){
        return  $this->db->insert('fees_emi_dates', $d3);
    }
    function importtesttable($data){
         return  $this->db->insert('test_table', $data);
    }
    function save_staff_attendance($d2){
        return  $this->db->insert('staff_attendance', $d2);
    }
    function save_staff_salary($d2){
        return  $this->db->insert('staff_salary', $d2);
    }
    function save_attendance($data){
        return  $this->db->insert('student_attendance', $data);
    }
 
    function move_to_users($data){
        return  $this->db->insert('login', $data);
    }
    function save_new_opening($d2){
        return  $this->db->insert('vaccency', $d2);
    }
    function save_placed_confirm($d2){
        return  $this->db->insert('placed_list', $d2);
    }
    function move_to_vaccency($d2){
        return  $this->db->insert('assigned_openings', $d2);
    }
    function save_addon_income($d2){
        return  $this->db->insert('other_income', $d2);
    }
    function save_addon_expense($d2){
        return  $this->db->insert('expenses', $d2);
    }
    function add_student_admit_user($d3){
        return  $this->db->insert('student_admit_user', $d3);
    }
    function add_new_fees($d2){
        return  $this->db->insert('fees_collection', $d2);
    }
    function save_batch_contents($data){
        return  $this->db->insert('batches', $data);
    }
    function insert_student_to_batch($d2){
        return  $this->db->insert('batch_stdents', $d2);
    }
    function save_enquiry($data){
        return  $this->db->insert('enquiry', $data);
    }
    function assign_staff_batch($data){
        return  $this->db->insert('batch_staffs', $data);
    }
    function assign_staff_syllabus($data){
        return  $this->db->insert('staff_topics', $data);
    } 
    function insert_student($data){
        $this->db->insert('students', $data);
        return $this->db->insert_id();
    }
    function insert_staff_image($d1,$id){
        $this->db->where('id',$id);
        return $this->db->update('staff',$d1);
    }
    function insert_company_image($d1,$id){
        $this->db->where('id',$id);
        return $this->db->update('company',$d1);
    }
    function update_opening($d2,$id){
        $this->db->where('id',$id);
        return $this->db->update('vaccency',$d2);
    }
    function update_enquiry($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('enquiry',$data);
    }
    function remove_fees_element($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('fees_collection',$data);
    }
    function upload_report($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('classes',$data);
    }
    function insert_student_image($d1,$id){
        $this->db->where('id',$id);
        return $this->db->update('students',$d1);
    }
    function insert_course_image($d1,$id){
        $this->db->where('id',$id);
        return $this->db->update('course',$d1);
    }
    function get_syllabus_content($id){
        $this->db->select('*');
        $this->db->from('syllabus');
        $this->db->where('course_id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    // function move_to_admission($id,$course_id){
    //     return 1;
    // }
    function get_batch_content($id){
        $data=array();
        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where('course_id',$id);
        $this->db->order_by('batch_status','DESC');
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['starting_date']=$r['starting_date'];

                $data[$i]['ending_date']=$r['ending_date'];
                $data[$i]['total_fee']=$r['total_fees'];
                $data[$i]['discounted_fee']=$r['discounted_fee'];
                $data[$i]['emi_total_pay']=$r['emi_total_pay'];
                $data[$i]['batch_status']=$r['batch_status'];
                $data[$i]['details']=$r['details'];
                $data[$i]['status']=$r['status'];
                $data[$i]['created_date']=$r['created_date'];

                $data[$i]['studentscount']=$this->get_batch_students_count($r['id']);
                $data[$i]['total_fees']=$this->get_batch_students_fees($r['id']);
                $data[$i]['collected']=$this->get_batch_students_collected($r['id']);
                $data[$i]['returned']=$this->get_batch_students_returned($r['id']);
                $i++;
            }
        }
        return $data;
    }
    function get_batch_content_open($id){
        $data=array();
        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where('course_id',$id);
        $this->db->where('batch_status',1);
        $this->db->order_by('batch_status','DESC');
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course_id'];
                $data[$i]['batch_name']=$r['batch_name'];
                $data[$i]['starting_date']=$r['starting_date'];

                $data[$i]['ending_date']=$r['ending_date'];
                $data[$i]['total_fee']=$r['total_fees'];
                $data[$i]['discounted_fee']=$r['discounted_fee'];
                $data[$i]['emi_total_pay']=$r['emi_total_pay'];
                $data[$i]['batch_status']=$r['batch_status'];
                $data[$i]['details']=$r['details'];
                $data[$i]['status']=$r['status'];
                $data[$i]['created_date']=$r['created_date'];

                $data[$i]['studentscount']=$this->get_batch_students_count($r['id']);
                $i++;
            }
        }
        return $data;
    }
    
    function get_batch_students($batch_id,$search){
        $data=array();
        $this->db->select('batch_stdents.id,batch_stdents.student_id,batch_stdents.mode_of_pay,batch_stdents.fees,batch_stdents.details,students.name,students.photo,students.phone_number,students.whatsapp,students.gender,students.sslc_status,students.plus_two_status,students.degree_status,students.person_id_status,students.sslc,students.plus_two,students.degree,students.person_id,students.status');
        $this->db->from('batch_stdents');
        $this->db->join("students",'batch_stdents.student_id=students.id');
        $this->db->where('batch_stdents.batch_id',$batch_id);
        if(!empty($search)){
            $this->db->like('students.name',$search);
        }
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['student_id']=$r['student_id'];
                $data[$i]['mode_of_pay']=$r['mode_of_pay'];
                $data[$i]['fees']=$r['fees'];
                $data[$i]['status']=$r['status'];

                $data[$i]['sslc_status']=$r['sslc_status'];
                $data[$i]['plus_two_status']=$r['plus_two_status'];
                $data[$i]['degree_status']=$r['degree_status'];
                $data[$i]['person_id_status']=$r['person_id_status'];

                $data[$i]['sslc']=$r['sslc'];
                $data[$i]['plus_two']=$r['plus_two'];
                $data[$i]['degree']=$r['degree'];
                $data[$i]['person_id']=$r['person_id'];

                $data[$i]['details']=$r['details'];
                $data[$i]['name']=$r['name'];
                $data[$i]['photo']=$r['photo'];
                $data[$i]['phone_number']=$r['phone_number'];
                $data[$i]['whatsapp']=$r['whatsapp'];
                $data[$i]['gender']=$r['gender'];

                $data[$i]['collected']=$this->get_student_students_collected($r['id']);
                $data[$i]['returned']=$this->get_batch_students_returned($r['id']);
                $i++;
            }
        }
        return $data;
    }

    function get_student_students_collected($id){
        $this->db->select('sum(amount) as stdamount');
        $this->db->from('fees_collection');
        $this->db->where('student_id',$id);
        $this->db->where('amount>',0);
        $this->db->where('status',1);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $r1=$res[0]['stdamount'];
        }else{
            $r1=0;
        }
        return $r1;
    }
    function get_staffs_attendance_list($search,$sorts){
        $this->db->select('*');
        $this->db->from('staff');
        if(!empty($search)){
            $this->db->like('name',$search);
        }
        if(!empty($sorts)){
            $this->db->order_by($sorts);
        }
        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        return $res;
    }
    function get_batch_students_collected($batch_id){
        $this->db->select('sum(amount) as stdamount');
        $this->db->from('fees_collection');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('status',1);
        $this->db->where('amount>',0);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $r1=$res[0]['stdamount'];
        }else{
            $r1=0;
        }
        return $r1;
    }
    function get_batch_students_returned($batch_id){
        $this->db->select('sum(amount) as stdamount');
        $this->db->from('fees_collection');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('status',1);
        $this->db->where('amount<',0);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $r1=$res[0]['stdamount'];
        }else{
            $r1=0;
        }
        return $r1;
    }
    function get_batch_students_count($batch_id){
        $this->db->select('count(*) as stdcount');
        $this->db->from('batch_stdents');
        $this->db->where('batch_id',$batch_id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $r1=$res[0]['stdcount'];
        }else{
            $r1=0;
        }
        return $r1;
    }
    function get_batch_students_fees($batch_id){
        $this->db->select('sum(fees) as stdamount');
        $this->db->from('batch_stdents');
        $this->db->where('batch_id',$batch_id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            $r1=$res[0]['stdamount'];
        }else{
            $r1=0;
        }
        return $r1;
    }
    function get_staffs_syllabus($batch_id){
        $data=array();
        $this->db->select('batch_staffs.id,batch_staffs.staff_id,staff.name,staff.id as stid,staff.staff_id as staffid,staff.photo');
        $this->db->from('batch_staffs');
        $this->db->join("staff",'batch_staffs.staff_id=staff.id');
        $this->db->where('batch_staffs.batch_id',$batch_id);
        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['stid']=$r['stid'];
                $data[$i]['staff_id']=$r['staff_id'];
                $data[$i]['name']=$r['name'];
                $data[$i]['staffid']=$r['staffid'];
                $data[$i]['photo']=$r['photo'];
                $data[$i]['staff_topic']=$this->get_staff_topics($r['staff_id'],$batch_id);
                $i++;
            }
        }
        return $data;
    }
    function get_course_title($batch_id){
        $data=array();
        $this->db->select('batches.id,course.course_name');
        $this->db->from('batches');
        $this->db->join("course",'batches.course_id=course.id');
        $this->db->where('batches.id',$batch_id);
        return $res=$this->db->get()->result_array();
    }
    function get_staff_topics($staff_id,$batch_id){
        $this->db->select('staff_topics.id,staff_topics.topic_id,syllabus.syllabus_topic,syllabus.syllabus_content');
        $this->db->from('staff_topics');
        $this->db->join("syllabus",'staff_topics.topic_id=syllabus.id');
        $this->db->where('staff_topics.batch_id',$batch_id);
        $this->db->where('staff_topics.staff_id',$staff_id);
        return $res=$this->db->get()->result_array();
    }
    function get_silmilar_batches($batch_id){
        $this->db->select('course_id');
        $this->db->from('batches');
        $this->db->where('id',$batch_id);
        $res=$this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where('course_id',$res[0]['course_id']);
        $this->db->order_by('id',"DESC");
        return $res1=$this->db->get()->result_array();
    }
    
    function edit_batch($id){
        $this->db->select('*');
        $this->db->from('batches');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function collect_fees($student_id,$batch_id){
        $this->db->select('*');
        $this->db->from('fees_collection');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('student_id',$student_id);
        $this->db->where('status',1);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function view_company_profile($id){
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('id',$id);
        return $this->db->get()->result_array();
    }
    function load_active_students_count(){
        $this->db->select('count(batch_stdents.id) as students');
        $this->db->from('batch_stdents');
        $this->db->join('batches','batches.id=batch_stdents.batch_id');
        $this->db->where('batches.batch_status',2);
        $res=$this->db->get()->result_array();
        return $res[0]['students'];
    }
    function load_nbatchfee_count(){
        $this->db->select('sum(batch_stdents.fees) as students');
        $this->db->from('batch_stdents');
        $this->db->join('batches','batches.id=batch_stdents.batch_id');
        $this->db->where('batches.batch_status',2);
        $res=$this->db->get()->result_array();
        return $res[0]['students'];
    }
    function load_nbatchfee_collected(){
        $this->db->select('sum(fees_collection.amount) as students');
        $this->db->from('fees_collection');
        $this->db->join('batches','batches.id=fees_collection.batch_id');
        $this->db->where('batches.batch_status',2);
        $res=$this->db->get()->result_array();
        return $res[0]['students'];
    }
    function load_nbatch_count(){
        $this->db->select('count(batch_stdents.id) as students');
        $this->db->from('batch_stdents');
        $this->db->join('batches','batches.id=batch_stdents.batch_id');
        $this->db->where('batches.batch_status',1);
        $res=$this->db->get()->result_array();
        return $res[0]['students'];
    }
    function load_active_batches_count(){
        $this->db->select('count(id) as batche');
        $this->db->from('batches');
        $this->db->where('batch_status',2);
        $res=$this->db->get()->result_array();
        return $res[0]['batche'];
    }
    function load_new_batches_count(){
        $this->db->select('count(id) as batche');
        $this->db->from('batches');
        $this->db->where('batch_status',1);
        $res=$this->db->get()->result_array();
        return $res[0]['batche'];
    }
    function get_admission_chart($start,$end){
        $stimestamp = strtotime($start);
        $snew_date = date("Y-m-d", $stimestamp);
        $etimestamp = strtotime($end);
        $enew_date = date("Y-m-d", $etimestamp);
        $this->db->select('count(id) as stdcount,date_of_join');
        $this->db->from('students');
        $this->db->where('date_of_join >=',$snew_date);
        $this->db->where('date_of_join <=',$enew_date);
        $this->db->group_by('date_of_join');
        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        return $res;

    }
    function get_student_fee($student_id,$batch_id){
        $this->db->select('*');
        $this->db->from('batch_stdents');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('student_id',$student_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function show_emi_det($student_id,$batch_id){
        $this->db->select('*');
        $this->db->from('fees_emi_dates');
        $this->db->where('student_id',$student_id);
        $this->db->where('batch_id',$batch_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function update_staff($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('staff',$data);
    }
    function update_company($data,$id){
         $this->db->where('id',$id);
        return $this->db->update('company',$data);
    }
    function update_student($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('students',$data);
    }
    function change_student_batch($d2,$student_id){
        $this->db->where('student_id',$student_id);
        return $this->db->update('batch_stdents',$d2);
    }
    function discontinue_student($student_id){
        $data=array();
        $data['status']=0;
        $this->db->where('id',$student_id);
        return $this->db->update('students',$data);
    }
    function reactivate_student($student_id){
        $data=array();
        $data['status']=1;
        $this->db->where('id',$student_id);
        return $this->db->update('students',$data);
    }
    function update_student_to_batch($d2,$batch_stid){
        $this->db->where('id',$batch_stid);
        return $this->db->update('batch_stdents',$d2);
    }
    function update_batch_contents($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('batches',$data);
    }
    function update_course($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('course',$data);
    }
    function update_syllabus_content($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('syllabus',$data);
    }
    function update_password($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('login',$data);
    }
    function delete_staff($id){
        $this->db->where('id',$id);
        return $this->db->delete('staff');
    }
    function remove_menu_access($user_id){
        $this->db->where('user_id',$user_id);
        return $this->db->delete('menu_control');
    }
    function delete_staff_attendance($id){
        $this->db->where('id',$id);
        return $this->db->delete('staff_attendance');
    }
    function delete_staff_salary($id){
        $this->db->where('id',$id);
        return $this->db->delete('staff_salary');
    }
    function delete_emi($id){
        $this->db->where('id',$id);
        return $this->db->delete('fees_emi_dates');
    }
    function remove_attandance_history($batch_id,$class_id,$student_id){
        $this->db->where('batch_id',$batch_id);
        $this->db->where('class_id',$class_id);
        $this->db->where('student_id',$student_id);
        return $this->db->delete('student_attendance');
    }

    
    function delete_placed($id){
        $this->db->where('id',$id);
        return $this->db->delete('placed_list');
    }
    function delete_job_appoinment($id){
        $this->db->where('id',$id);
        return $this->db->delete('assigned_openings');
    }
    function delete_vaccency($id){
        $this->db->where('id',$id);
        return $this->db->delete('vaccency');
    }
    function delete_company($id){
        $this->db->where('id',$id);
        return $this->db->delete('company');
    }
    function delete_expense($id){
        $this->db->where('id',$id);
        return $this->db->delete('expenses');
    }
    function remove_topic_staff($id){
        $this->db->where('id',$id);
        return $this->db->delete('staff_topics');
    }
    function delete_staff_from_batch($batch_id,$stid){
        $this->db->where('batch_id',$batch_id);
        $this->db->where('staff_id',$stid);
        $this->db->delete('staff_topics');

        $this->db->where('batch_id',$batch_id);
        $this->db->where('staff_id',$stid);
        return $this->db->delete('batch_staffs');
    }
    
    function delete_batch($id){
        $this->db->where('id',$id);
        return $this->db->delete('batches');
    }
    function delete_course($id){
        $this->db->where('id',$id);
        return $this->db->delete('course');
    }
    function delete_student($student_id){
        $this->db->where('id',$student_id);
        return $this->db->delete('students');
    }
    function delete_enquiry($student_id){
        $this->db->where('id',$student_id);
        return $this->db->delete('enquiry');
    }
    function view_staff_profile($id){
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_students_count($batch_id){
        $this->db->select('count(id) as totstudents');
        $this->db->from('batch_stdents');
        $this->db->where('batch_id',$batch_id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['totstudents'];
        }else{
          return 0;  
        }   
    }
    function get_students_present_count($batch_id,$id){
        $this->db->select('count(id) as present');
        $this->db->from('student_attendance');
        $this->db->where('batch_id',$batch_id);
        $this->db->where('class_id',$id);
        $res=$this->db->get()->result_array();
        if(!empty($res)){
            return $res[0]['present'];
        }else{
          return 0;  
        } 
    }
    function get_student_fees($student_id){
        $this->db->select('*');
        $this->db->from('batch_stdents');
        $this->db->where('student_id',$student_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function view_student_profile($student_id){
        $this->db->select('*');
        $this->db->from('students');
        $this->db->where('id',$student_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function view_enquiry_profile($student_id){
        $this->db->select('enquiry.*,course.course_name');
        //$this->db->select('enquiry.*');
        $this->db->from('enquiry');
        $this->db->join('course','course.id=enquiry.course_id','left');
        $this->db->where('enquiry.id',$student_id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function get_enquiry_details($key,$sort,$sorts,$filter){
        $this->db->select('enquiry.*,course.course_name');
        $this->db->from('enquiry');
        $this->db->join('course','enquiry.course_id=course.id','left');
        if($key!=''){
            $this->db->like('enquiry.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                $this->db->or_where("enquiry.course_id",$sort[$m]);
                $m++;
            }
        }
        if(!empty($filter)){
            $n1=count($filter);$m1=0;
            while ($m1 <$n1) {
                $this->db->or_where("enquiry.enquiry_status",$filter[$m1]);
                $m1++;
            }
        }
        
        if($sorts!=''){
            $this->db->order_by('enquiry.'.$sorts,'ASC');
        }else{
            $this->db->order_by("enquiry.course_id",'ASC');
        }
        
        $res=$this->db->get()->result_array();  
        return $res;
    }
    function get_fees_collection_list($key,$sort,$batches,$start,$end){
         $data=array();
        $this->db->select('fees_collection.*,batches.course_id,students.name');
        $this->db->from('fees_collection');
        $this->db->join('batches','fees_collection.batch_id=batches.id');
        $this->db->join('students','fees_collection.student_id=students.id');
        $this->db->where('fees_collection.amount >',0);
        $this->db->where('fees_collection.type',0);
        $this->db->where("fees_collection.date_time >=",$start);
        $this->db->where("fees_collection.date_time <=",$end);
        $this->db->order_by('fees_collection.date_time','DESC');
        if($key!=''){
            $this->db->like('enquiry.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("batches.course_id",$sort[$m]);
                }else{
                    $this->db->or_where("batches.course_id",$sort[$m]);
                } 
                $m++;
            }
        }
        if(!empty($batches)){
        $this->db->where("fees_collection.batch_id",$batches);
        }

        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course_id'];
                $data[$i]['student_id']=$r['student_id'];
                $data[$i]['batch_id']=$r['batch_id'];

                $data[$i]['date_time']=$r['date_time'];
                $data[$i]['record_date']=$r['record_date'];
                $data[$i]['amount']=$r['amount'];
                $data[$i]['course_name']=$this->get_batch_course_name($r['course_id']);
                $data[$i]['batch_name']=$this->get_batch_name($r['batch_id']);
                $data[$i]['student_name']=$r['name'];

                $i++;
            }
        }
        return $data;
    }
    function get_income_chart($key,$sort,$batches,$start,$end){
        $data=array();
        $this->db->select('sum(fees_collection.amount)as feeamount,fees_collection.date_time,batches.course_id,students.name');
        $this->db->from('fees_collection');
        $this->db->join('batches','fees_collection.batch_id=batches.id');
        $this->db->join('students','fees_collection.student_id=students.id');
        $this->db->where('fees_collection.amount >',0);
        $this->db->where('fees_collection.type',0);
        $this->db->where("fees_collection.date_time >=",$start);
        $this->db->where("fees_collection.date_time <=",$end);
        $this->db->group_by('fees_collection.date_time');
        $this->db->order_by('fees_collection.date_time','DESC');
        if($key!=''){
            $this->db->like('enquiry.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("batches.course_id",$sort[$m]);
                }else{
                    $this->db->or_where("batches.course_id",$sort[$m]);
                } 
                $m++;
            }
        }
        if(!empty($batches)){
        $this->db->where("fees_collection.batch_id",$batches);
        }

        $res=$this->db->get()->result_array();
        //echo $this->db->last_query();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['date_time']=$r['date_time'];
                $data[$i]['feeamount']=$r['feeamount'];
                $i++;
            }
        }
        return $data;
    }
    function get_return_chart($key,$sort,$batches,$start,$end){
        $data=array();
        $this->db->select('sum(fees_collection.amount)as feeamount,fees_collection.date_time,batches.course_id,students.name');
        $this->db->from('fees_collection');
        $this->db->join('batches','fees_collection.batch_id=batches.id');
        $this->db->join('students','fees_collection.student_id=students.id');
        $this->db->where('fees_collection.amount <',0);
        $this->db->where('fees_collection.type',1);
        $this->db->where("fees_collection.date_time >=",$start);
        $this->db->where("fees_collection.date_time <=",$end);
        $this->db->group_by('fees_collection.date_time');
        $this->db->order_by('fees_collection.date_time','DESC');
        if($key!=''){
            $this->db->like('enquiry.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("batches.course_id",$sort[$m]);
                }else{
                    $this->db->or_where("batches.course_id",$sort[$m]);
                } 
                $m++;
            }
        }
        if(!empty($batches)){
        $this->db->where("fees_collection.batch_id",$batches);
        }

        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['date_time']=$r['date_time'];
                $data[$i]['feeamount']=($r['feeamount']-$r['feeamount'])-$r['feeamount'];
                $i++;
            }
        }
        return $data;
    }
    function get_fees_return_list($key,$sort,$batches,$start,$end){
         $data=array();
        $this->db->select('fees_collection.*,batches.course_id,students.name');
        $this->db->from('fees_collection');
        $this->db->join('batches','fees_collection.batch_id=batches.id');
        $this->db->join('students','fees_collection.student_id=students.id');
        $this->db->where('fees_collection.amount <',0);
        $this->db->where('fees_collection.type',1);
        $this->db->where("fees_collection.date_time >",$start);
        $this->db->where("fees_collection.date_time <",$end);
        $this->db->order_by('fees_collection.date_time','DESC');
        if($key!=''){
            $this->db->like('enquiry.name',$key);
        }
        if(!empty($sort)){
            $n=count($sort);$m=0;
            while ($m <$n) {
                if($m==0){
                    $this->db->where("batches.course_id",$sort[$m]);
                }else{
                    $this->db->or_where("batches.course_id",$sort[$m]);
                } 
                $m++;
            }
        }
        if(!empty($batches)){
        $this->db->where("fees_collection.batch_id",$batches);
        }

        $res=$this->db->get()->result_array();
        if(!empty($res))
        {
            $i=0;
            foreach($res as $r)
            {
                $data[$i]['id']=$r['id'];
                $data[$i]['course_id']=$r['course_id'];
                $data[$i]['student_id']=$r['student_id'];
                $data[$i]['batch_id']=$r['batch_id'];

                $data[$i]['date_time']=$r['date_time'];
                $data[$i]['record_date']=$r['record_date'];
                $data[$i]['amount']=$r['amount'];
                $data[$i]['course_name']=$this->get_batch_course_name($r['course_id']);
                $data[$i]['batch_name']=$this->get_batch_name($r['batch_id']);
                $data[$i]['student_name']=$r['name'];

                $i++;
            }
        }
        return $data;
    }
    function get_batch_name($batch_id){
        $this->db->select('batch_name');
        $this->db->from('batches');
        $this->db->where('id',$batch_id);
        $res=$this->db->get()->result_array();
        $r1=$res[0]['batch_name'];
        return $r1;
    }
    function get_student_name($student_id){
        $this->db->select('name');
        $this->db->from('students');
        $this->db->where('id',$student_id);
        $res=$this->db->get()->result_array();
        $r1=$res[0]['name'];
        return $r1;
    }
    function edit_course($id){
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }
    function edit_syllabus($id){
        $this->db->select('*');
        $this->db->from('syllabus');
        $this->db->where('id',$id);
        $res=$this->db->get()->result_array();
        return $res;
    }


}    