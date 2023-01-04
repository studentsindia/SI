<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Docparser\Docparser;
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Administ extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
        //$this->excel = new PHPExcel(); 
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->library('m_pdf');
		$this->load->model('administ_model');
		$this->load->library('session');
		//$this->notifications=$this->administ_model->Get_notification();
		$this->require_login();
	}
	private function require_login()
	{
		if($this->session->userdata('login')=="1")
		{
			/*if($this->session->userdata('role')=="Admin"||$this->session->userdata('role')=="admin")
			{
			}else{
				redirect('login/index');
			}*/
		}
		else
		{ redirect('login/index'); }
	}
	function index()
	{	
		$this->session->set_userdata('cpage','home');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/index',$data);
		$this->load->view('manage/footer');
	}
	function syllabus(){
		$this->session->set_userdata('cpage','syllabus');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/syllabus',$data);
		$this->load->view('manage/footer');
	}
	function editions(){
		$this->session->set_userdata('cpage','edition');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['accademicyear']=$this->administ_model->get_accademicyear();
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/editions',$data);
		$this->load->view('manage/footer');
	}
	function annual(){
		$this->session->set_userdata('cpage','annual');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['accademicyear']=$this->administ_model->get_accademicyear();
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/annual',$data);
		$this->load->view('manage/footer');
	} 
	function books(){
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['accademicyear']=$this->administ_model->get_accademicyear();
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		$data['edition']=urldecode($this->uri->segment(3));
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/books',$data);
		$this->load->view('manage/footer');
	}
	function chapters(){
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['edition']=urldecode($this->uri->segment(3));
		$data['book']=urldecode($this->uri->segment(4));
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/chapters',$data);
		$this->load->view('manage/footer');
	}
	function save_syllabus_new(){
		$d2=array();
		$d2['name']=$this->input->post('syllabus');
        $d2['details']=$this->input->post('details');
        $d2['date']=date('Y-m-d h:i:sa');
        $d2['user_id']=$this->session->userdata('stdid');
        $d2['status']=1;
        $d2['active_status']=1;
        $this->administ_model->save_syllabus_new($d2);
        return 1;
	}
	function save_annual_new(){
		$d2=array();
		$d2['syllabus']=$this->input->post('syllabus');
        $d2['medium']=$this->input->post('medium');
        $d2['class']=$this->input->post('classes');
        $d2['details']=$this->input->post('details');
        $d2['annual_year']=$this->input->post('annual_year');
        $d2['mrp']=$this->input->post('mrp');
        $d2['editions']=$this->input->post('editions');
        $d2['digital']=$this->input->post('digital');
        $d2['printed']=$this->input->post('printed');
        $d2['date']=date('Y-m-d');
        $d2['user_id']=$this->session->userdata('stdid');
        $d2['status']=1;
        $this->administ_model->save_annual_new($d2);
        return 1;
	}
	function save_class_new(){
		$d2=array();
		$d2['name']=$this->input->post('classname');
		$d2['medium']=$this->input->post('medium');
		$d2['syllabus']=$this->input->post('syllabus');
        $d2['details']=$this->input->post('details');
        $d2['date']=date('Y-m-d h:i:sa');
        $d2['user_id']=$this->session->userdata('stdid');
        $d2['status']=1;
        $d2['active_status']=1;
        $this->administ_model->save_class_new($d2);
        return 1;
	}
	function save_edition_new(){
		$d2=array();
		$d2['title']=$this->input->post('editions');
		$d2['ac_year']=$this->input->post('accademicyear');
		$d2['date']=date('Y-m-d');
        $d2['status']=1;
        $d2['current']=1;
        $this->administ_model->save_edition_new($d2);
        return 1;
	}
	function get_syllabus(){
		$data=array();
		$sort=$_POST['sort'];
		$data['syllabus']=$this->administ_model->get_syllabus($sort);
		$this->load->view('manage/get_syllabus',$data);
	}
	function get_mediums(){
		$data=array();
		$syllabus=$_POST['syllabus'];
		$data['medium']=$this->administ_model->get_mediums($syllabus);
		$this->load->view('manage/get_mediums',$data);
	}

	function get_editions(){
		$data=array();
		$syllabus=$_POST['syllabus'];
		$data['edition']=$this->administ_model->get_editions();
		$this->load->view('manage/get_editions',$data);
	}
	function delete_syllabus(){
		$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_syllabus($id,$data);
	}
	function delete_edition(){
		$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_edition($id,$data);
	}
	function deactivate_edition(){
		$data=array();
		$id=$_POST['id'];
		$data['current']=1;
		return $this->administ_model->update_edition($id,$data);
	}
	function activate_edition(){
		$data=array();
		$id=$_POST['id'];
		$data['current']=2;
		return $this->administ_model->update_edition($id,$data);
	}

	function deactivate_syllabus(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=0;
		return $this->administ_model->update_syllabus($id,$data);
	}
	function activate_syllabus(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=1;
		return $this->administ_model->update_syllabus($id,$data);
	}
	function get_syllabus_details(){
        $data=array();
		$id=$_POST['id'];
		$data['syllabus']=$this->administ_model->get_syllabus_details($id);
		$this->load->view('manage/get_syllabus_details',$data);
    }

    function update_syllabus(){
    	$d2=array();
    	$id=$_POST['id'];
		$d2['name']=$this->input->post('syllabus');
        $d2['details']=$this->input->post('details');
        $d2['date']=date('Y-m-d h:i:sa');
        $d2['user_id']=$this->session->userdata('stdid');
        return $this->administ_model->update_syllabus($id,$d2);
    }
    function medium(){
		$this->session->set_userdata('cpage','medium');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/medium',$data);
		$this->load->view('manage/footer');
	}
	function save_medium_new(){
		$d2=array();
		$d2['name']=$this->input->post('medium');
		$d2['syllabus']=$this->input->post('syllabus');
        $d2['details']=$this->input->post('details');
        $d2['date']=date('Y-m-d h:i:sa');
        $d2['user_id']=$this->session->userdata('stdid');
        $d2['status']=1;
        $d2['active_status']=1;
        $this->administ_model->save_medium_new($d2);
        return 1;
	}
	function save_subject_new(){
		$d2=array();
		$d2['name']=$this->input->post('subject');
		$d2['class']=$this->input->post('classes');
		$d2['medium']=$this->input->post('medium');
		$d2['syllabus']=$this->input->post('syllabus');
        $d2['details']=$this->input->post('details');
        // $d2['date']=date('Y-m-d h:i:sa');
        // $d2['user_id']=$this->session->userdata('stdid');
        $d2['status']=1;
        // $d2['active_status']=1;
        $this->administ_model->save_subject_new($d2);
        return 1;
	}
	function save_books(){
		$d1=array();
		if (0<$_FILES['file']['error']){
			$d1['cover_image'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/bookcovers/" . $newfilename);
    	    $d1['cover_image'] =$newfilename;
    	}
    		
    		$d1['syllabus']=$_POST['syllabus'];
    		$d1['medium']=$_POST['mediums'];
    		$d1['class']=$_POST['class'];
    		$d1['title']=$_POST['booktitle'];
    		$d1['mrp']=$_POST['mrp'];
    		$d1['printed']=$_POST['printed'];
    		$d1['digital']=$_POST['digital'];
    		$d1['details']=$_POST['details'];
    		$d1['edition']=$_POST['edition'];
    		$d1['date']=date('Y-m-d');
    		$d1['status']=1;
    		$d1['user_id']=$this->session->userdata('uid');

        	return $this->administ_model->save_books($d1);   	
	}
	function get_medium(){
		$data=array();
		$sort=$_POST['sort'];
		$syllabus=$_POST['syllabus'];
		$data['medium']=$this->administ_model->get_medium($sort,$syllabus);
		$this->load->view('manage/get_medium',$data);
	}

	function delete_medium(){
		$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_medium($id,$data);
	}

	function deactivate_medium(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=0;
		return $this->administ_model->update_medium($id,$data);
	}
	function activate_medium(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=1;
		return $this->administ_model->update_medium($id,$data);
	}

	function get_medium_details(){
		$data=array();
		$id=$_POST['id'];
		$data['medium']=$this->administ_model->get_medium_details($id);
		$this->load->view('manage/get_medium_details',$data);
	}
	function update_medium(){
		$d2=array();
    	$id=$_POST['id'];
		$d2['name']=$this->input->post('name');
        $d2['details']=$this->input->post('details');
        $d2['date']=date('Y-m-d h:i:sa');
        $d2['user_id']=$this->session->userdata('stdid');
        return $this->administ_model->update_medium($id,$d2);
	}
	function classes(){
		$this->session->set_userdata('cpage','classes');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/classes',$data);
		$this->load->view('manage/footer');
	}
	function get_classes(){
		$data=array();
		$sort=$_POST['sort'];
		$syllabus=$_POST['syllabus'];
		$medium=$_POST['medium'];
		$data['classes']=$this->administ_model->get_classes($sort,$syllabus,$medium);
		$this->load->view('manage/get_classes',$data);
	}
	function get_classeslist(){
		$data=array();
		$medium=$_POST['medium'];
		$data['classes']=$this->administ_model->get_classeslist($medium);
		$this->load->view('manage/get_classeslist',$data);
	}
	function get_classes_details(){
        $data=array();
		$id=$_POST['id'];
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		
		$data['classes']=$this->administ_model->get_classes_details($id);
		$this->load->view('manage/get_classes_details',$data);
    }
    function delete_classes(){
    	$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_classes($id,$data);
    }
    function activate_classes(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=1;
		return $this->administ_model->update_classes($id,$data);
	}
	 function deactivate_classes(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=0;
		return $this->administ_model->update_classes($id,$data);
	}

	function subjects(){
		$this->session->set_userdata('cpage','subjects');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		$this->load->view('manage/adminhome',$noti);
		$this->load->view('manage/subjects',$data);
		$this->load->view('manage/footer');
	}
	function get_subjects(){
		$data=array();
		$sort=$_POST['sort'];
		$syllabus=$_POST['syllabus'];
		$medium=$_POST['medium'];
		$classes=$_POST['classes'];
		$data['subjects']=$this->administ_model->get_subjects($sort,$syllabus,$medium,$classes);
		$this->load->view('manage/get_subjects',$data);
	}
	function get_annual_price(){
		$data=array();
		$sort=$_POST['sort'];
		$syllabus=$_POST['syllabus'];
		$medium=$_POST['medium'];
		$classes=$_POST['classes'];
		$data['annual']=$this->administ_model->get_annual_price($sort,$syllabus,$medium,$classes);
		$this->load->view('manage/get_annual_price',$data);
	}
	function get_books(){
		$data=array();
		$sort=$_POST['sort'];
		$syllabus=$_POST['syllabus'];
		$medium=$_POST['medium'];
		$classes=$_POST['classes'];
		$edition=$_POST['edition'];
		$data['edition']=$_POST['edition'];
		$data['books']=$this->administ_model->get_books($sort,$syllabus,$medium,$classes,$edition);
		$this->load->view('manage/get_books',$data);
	}
	function get_subjects_details(){
        $data=array();
		$id=$_POST['id'];
		$data['syllabus']=$this->administ_model->get_syllabus_list();
		
		$data['classes']=$this->administ_model->get_classes_details($id);
		$this->load->view('manage/get_subjects_details',$data);
    }
    function delete_subjects(){
    	$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_subjects($id,$data);
    }
    function delete_books(){
    	$data=array();
		$id=$_POST['id'];
		$data['status']=0;
		return $this->administ_model->update_books($id,$data);
    }
    function activate_subjects(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=1;
		return $this->administ_model->update_subjects($id,$data);
	}
	 function deactivate_subjects(){
		$data=array();
		$id=$_POST['id'];
		$data['active_status']=0;
		return $this->administ_model->update_subjects($id,$data);
	}








	function income(){
		$this->session->set_userdata('cpage','income');
		$data=array();
		$params=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/income',$data);
		$this->load->view('crm/footer');
	}
	function reset_password(){
		$this->session->set_userdata('cpage','rspwd');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/reset_password',$data);
		$this->load->view('crm/footer');
	}
	function students_attendance(){
		$this->session->set_userdata('cpage','std_aatd');
		$data=array();
		$params=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/students_attendance',$data);
		$this->load->view('crm/footer');
	}
	function openings(){
		$this->session->set_userdata('cpage','opening');
		$data=array();
		$params=array();
		$data['companies']=$this->administ_model->get_company_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/openings',$data);
		$this->load->view('crm/footer');
	}
	function assigning(){
		$this->session->set_userdata('cpage','assigns');
		$data=array();
		$params=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		$data['companies']=$this->administ_model->get_company_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/assigning',$data);
		$this->load->view('crm/footer');
	}
	function assigning_list(){
		$this->session->set_userdata('cpage','asgn_std');
		$data=array();
		$params=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		$data['companies']=$this->administ_model->get_company_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/assigning',$data);
		$this->load->view('crm/footer');
	}
	function company_management(){
		$this->session->set_userdata('cpage','companies');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/company_management',$data);
		$this->load->view('crm/footer');
	}
	function expenses(){
		$this->session->set_userdata('cpage','expenses');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/expenses',$data);
		$this->load->view('crm/footer');
	}
	function fees_report(){
		$this->session->set_userdata('cpage','fees_report');
		$data=array();
		$params=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/fees_report',$data);
		$this->load->view('crm/footer');
	}
	function salary(){
		$this->session->set_userdata('cpage','salary');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/salary',$data);
		$this->load->view('crm/footer');
	}
	function staff_attendance(){
		$this->session->set_userdata('cpage','st_attendance');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/staff_attendance',$data);
		$this->load->view('crm/footer');
	}
	function enquiry_list(){
		$this->session->set_userdata('cpage','enqury');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['courses']=$this->administ_model->get_course_list('','');
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/enquiry_list',$data);
		$this->load->view('crm/footer');
	}
	function placed_students(){
		$this->session->set_userdata('cpage','placedls');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['companies']=$this->administ_model->get_company_list('','');
		$data['courses']=$this->administ_model->get_course_list('','');
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/placed_students',$data);
		$this->load->view('crm/footer');
	}
	function assigned_list(){
		$this->session->set_userdata('cpage','asgnlist');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$data['courses']=$this->administ_model->get_course_list('','');
		$data['staffs']=$this->administ_model->get_users_list();
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/assigned_list',$data);
		$this->load->view('crm/footer');
	}
	function course_management(){
		$this->session->set_userdata('cpage','coursemgnt');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/course_management',$data);
		$this->load->view('crm/footer');
	}
	function front_office(){
		$this->session->set_userdata('cpage','frntoffice');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/front_office',$data);
		$this->load->view('crm/footer');
	}
	function students(){
		$this->session->set_userdata('cpage','student');
		$data=array();
		$params=array();
		$key='';
		$sort='';
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/students',$data);
		$this->load->view('crm/footer');
	}
	function batch_management(){
		$this->session->set_userdata('cpage','batchmgnt');
		$data=array();
		$key='';
		$sort='';
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/batch_management',$data);
		$this->load->view('crm/footer');
	}
	function fees_management(){
		$this->session->set_userdata('cpage','feemgnt');
		$data=array();
		$key='';
		$sort='';
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/fees_management',$data);
		$this->load->view('crm/footer');
	}
	function fees_remainder(){
		$this->session->set_userdata('cpage','feeremain');
		$data=array();
		$key='';
		$sort='';
		//$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/fees_remainder',$data);
		$this->load->view('crm/footer');
	}
	function user_management(){
		$this->session->set_userdata('cpage','usr_mgnt');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/user_management',$data);
		$this->load->view('crm/footer');
	}
	function view_batch_report(){
		$data=array();
		$data['batch_id']=urldecode($this->uri->segment(3));
		$key='';
		$sort='';
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/view_batch_report',$data);
		$this->load->view('crm/footer');
	}

	function view_emergency_details(){
		$this->load->view('crm/view_emergency_details');
	}
	function search_emergency_details(){
		$data=array();
		$key=$_POST['key'];
		$data['staff']=$this->administ_model->search_emergency_details($key);
		$this->load->view('crm/pop_emergency_details',$data);
	}
	function submit_report(){
		$data=array();
		$id=$_POST['id'];
		$data['id']=$id;
		$this->load->view('crm/pop_submit_report',$data);
	}
	function show_class_report(){
		$data=array();
		$id=$_POST['id'];
		$data['class']=$this->administ_model->show_class_report($id);
		$this->load->view('crm/pop_show_report',$data);
	}
	function get_classes_list_user(){
		$data=array();
		$course_id=$_POST['course'];
		$batch_id=$_POST['batch'];
		$search=$_POST['search'];
		$data['classes']=$this->administ_model->get_classes_list_user($course_id,$batch_id,$search);
		$this->load->view('crm/get_classes_list_user',$data);
	}
	function get_staffs_attendance_list(){
		$data=array();
		$search=$_POST['search'];
		$sorts=$_POST['sorts'];
		$data['staffs']=$this->administ_model->get_staffs_attendance_list($search,$sorts);
		$this->load->view('crm/get_staffs_attendance_list',$data);
	}
	function get_staffs_salary_list(){
		$data=array();
		$search=$_POST['search'];
		$sorts=$_POST['sorts'];
		$data['staffs']=$this->administ_model->get_staffs_attendance_list($search,$sorts);
		$this->load->view('crm/get_staffs_salary_list',$data);
	}
	function get_fee_remainders(){
		$data=array();
		$search=$_POST['search'];
		$sorts=$_POST['sorts'];
		$start=$_POST['start'];
		$end=$_POST['end'];
		$data['remainder']=$this->administ_model->get_fee_remainders($search,$sorts,$start,$end);
		$this->load->view('crm/get_fee_remainders',$data);
	}
	function add_attendance_staff(){
		$data=array();
		$data['id']=$_POST['id'];
		$this->load->view('crm/pop_add_attendance_staff',$data);
	}
	function add_salary_staff(){
		$data=array();
		$data['id']=$_POST['id'];
		$this->load->view('crm/pop_add_salary_staff',$data);
	}
	function get_students_attendance(){
		$data=array();
		$id=$_POST['id'];
		$batch_id=$_POST['batch_id'];
		$data['batch_id']=$batch_id;
		$data['class_id']=$id;
		$search=$_POST['search'];
		$data['student']=$this->administ_model->get_students_attendance($id,$batch_id,$search);
		$this->load->view('crm/get_students_attendance',$data);
	}
	function get_attendance_stats(){
		$data=array();
		$id=$_POST['id'];
		$batch_id=$_POST['batch_id'];
		$totstudent=$this->administ_model->get_students_count($batch_id);
		$present=$this->administ_model->get_students_present_count($batch_id,$id);
		$abscent=$totstudent-$present;
		echo "<center><br /><br /><span class='stsp'>Total Students : ".$totstudent."</span><br />";
		echo "<span class='stsp'>Present : ".$present."</span><br />";
		echo "<span class='stsp'>Abscent : ".$abscent."</span></center>";
		//$this->load->view('crm/get_students_attendance',$data);
	}
	function get_attendance_graph(){
		$data=array();
		$id=$_POST['id'];
		$batch_id=$_POST['batch_id'];
		$totstudent=$this->administ_model->get_students_count($batch_id);
		$present=$this->administ_model->get_students_present_count($batch_id,$id);
		$abscent=$totstudent-$present;
		$data['present']=$present;
		$data['abscent']=$abscent;
		$this->load->view('crm/get_attendance_graph',$data);
	}
	function get_users_details(){
		$data=array();
		$search=$_POST['search'];
		$data['staff']=$this->administ_model->get_users_details($search);
		$this->load->view('crm/get_users_details',$data);
	}
	function grant_access_menu(){
		$data=array();
		$data['uid']=$_POST['uid'];
		$data['menu']=$this->administ_model->grant_access_menu($data['uid']);
		$this->load->view('crm/grant_access_menu',$data);
	}
	
	function get_staffs_details(){
		$data=array();
		$search=$_POST['search'];
		$data['staff']=$this->administ_model->get_staffs_details($search);
		$this->load->view('crm/get_staffs_details',$data);
	}
	function edit_vaccency(){
		$data=array();
		$id=$this->input->post('id');
		$data['companies']=$this->administ_model->get_company_list('','');
		$data['vaccency']=$this->administ_model->edit_vaccency($id);
		$this->load->view('crm/pop_edit_vaccency',$data);
	}
	function get_course_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$data['selected']=$this->input->post('id');
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$this->load->view('crm/data_course_list',$data);
	}
	function get_vaccencies_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$id=$this->input->post('id');
		$data['cmp_id']=$this->input->post('id');
		$data['vaccency']=$this->administ_model->get_vaccencies_list($key,$sort,$id);
		$this->load->view('crm/get_vaccencies_list',$data);
	}
	function get_all_placed_list(){
		$data=array();
		$id=$this->input->post('id');
		$data['cmp_id']=$this->input->post('id');
		$data['placement']=$this->administ_model->get_all_placed_list($id);
		$this->load->view('crm/get_placed_list',$data);
	}
	function get_only_placed_list(){
		$data=array();
		$company_id=$this->input->post('company_id');
		$id=$this->input->post('id');
		$data['cmp_id']=$this->input->post('id');
		$data['placement']=$this->administ_model->get_only_placed_list($id,$company_id);
		$this->load->view('crm/get_placed_list',$data);
	}
	function get_company_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$data['selected']=$this->input->post('id');
		$data['company']=$this->administ_model->get_company_list($key,$sort);
		$this->load->view('crm/get_company_list',$data);
	}
	function assgn_student_pop(){
		$data=array();
		$data['id']=$this->input->post('id');
		$data['courses']=$this->administ_model->get_course_list('','');
		$this->load->view('crm/pop_assgn_student',$data);
	}
	function get_course_details_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$data['selected']=$this->input->post('id');
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$this->load->view('crm/get_course_details_list',$data);
	}
	function get_assn_studentslist(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$data['id']=$this->input->post('id');
		$data['students']=$this->administ_model->get_assn_studentslist($key,$sort,$data['id']);
		$this->load->view('crm/get_assn_studentslist',$data);
	}
	function get_batch_list(){
		$data=array();
		$key=$_POST['key'];
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$filter=$this->input->post('filter');
		$data['selected']=$_POST['id'];
		$data['courses']=$this->administ_model->get_course_list('','');
		$data['batches']=$this->administ_model->get_batch_list($key,$sort,$sorts,$filter);
		$this->load->view('crm/data_batch_list',$data);
	}
	function get_opening_list(){
		$data=array();
		$key=$_POST['key'];
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$filter=$this->input->post('filter');
		$data['openings']=$this->administ_model->get_opening_list($key,$sort,$sorts,$filter);
		$this->load->view('crm/get_opening_list',$data);
	}
	function get_opening_lists(){
		$data=array();
		$key=$_POST['key'];
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$data['selected']=$this->input->post('id');
		$data['openings']=$this->administ_model->get_opening_lists($key,$sort,$sorts);
		$this->load->view('crm/get_opening_lists',$data);
	}
	function get_fees_collection_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_fees_collection_list($key,$sort,$batches,$start,$end);
		$this->load->view('crm/data_fees_collection_list',$data);
	}
	function get_other_income_list(){
		$data=array();
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_other_income_list($start,$end);
		$this->load->view('crm/get_other_income_list',$data);
	}
	function get_expense_list(){
		$data=array();
		$key=$this->input->post('key');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_expense_list($start,$end,$key);
		$this->load->view('crm/get_expense_list',$data);
	}
	function get_income_chart(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_income_chart($key,$sort,$batches,$start,$end);
		$data['retamount']=$this->administ_model->get_return_chart($key,$sort,$batches,$start,$end);
		$data['others']=$this->administ_model->get_other_income_chart($start,$end);
		$this->load->view('crm/get_income_chart',$data);
	}
	function get_admission_chart(){
		$data=array();
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['students']=$this->administ_model->get_admission_chart($start,$end);
		$this->load->view('crm/get_admission_chart',$data);
	}
	function load_fees_chart(){
		$data=array();
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_income_chart('','','',$start,$end);
		$data['retamount']=$this->administ_model->get_return_chart('','','',$start,$end);
		$this->load->view('crm/load_fees_chart',$data);
	}
	function print_fees_bill(){
		$data=array();
		$id=urldecode($this->uri->segment(3));
		$student_id=urldecode($this->uri->segment(4));
		$data['bill']=$this->administ_model->print_fees_bill($id,$student_id);
		$data['totfees']=$this->administ_model->get_student_totfees($student_id);
		$data['totpaid']=$this->administ_model->get_student_totfeespaid($student_id);
		$data['emicount']=$this->administ_model->get_student_totfeesemi($student_id);
		$mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('crm/print_fees_bill',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
	}
	function print_certificate(){
		$data=array();
		$student_id=urldecode($this->uri->segment(3));
		
		//$data['bill']=$this->administ_model->print_fees_bill($id,$student_id);
		//$html=$this->load->view('user3/certificate',$data,true);
		//$html='<html><body>Hello World</body></html>';
		$mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('crm/print_certificate',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
	}
	function get_expense_chart(){
		$data=array();
		$key=$this->input->post('key');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_expense_chart($key,$start,$end);
		$this->load->view('crm/get_expense_chart',$data);
	}
	function get_total_expense_report(){
		$data=array();
		$key=$this->input->post('key');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['today']=$this->administ_model->get_expense_chart($key,date('Y-m-d'),date('Y-m-d'));
		$data['month']=$this->administ_model->get_expense_chart($key,date('Y-m-01'),date('Y-m-d'));
		$data['range']=$this->administ_model->get_expense_chart($key,$start,$end);
		$this->load->view('crm/get_total_expense_report',$data);
	}
	function get_income_chart1(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_income_chart($key,$sort,$batches,$start,$end);
		$data['retamount']=$this->administ_model->get_return_chart($key,$sort,$batches,$start,$end);
		$this->load->view('crm/get_income_chart1',$data);
	}
	function load_active_students_count(){
		$students=$this->administ_model->load_active_students_count();
		echo $students;
	}
	function load_active_batches_count(){
		$batches=$this->administ_model->load_active_batches_count();
		echo $batches;
	}
	function load_new_batches_count(){
		$batches=$this->administ_model->load_new_batches_count();
		echo $batches;
	}
	function load_nbatch_count(){
		$batches=$this->administ_model->load_nbatch_count();
		echo '<br />'.'Admissions : '.$batches;
	}
	function load_nbatchfee_count(){
		$students=$this->administ_model->load_nbatchfee_count();
		echo '<br />'.'Total Batch Fees : ₹ '.$students.'<br />';
		$coll=$this->administ_model->load_nbatchfee_collected();
		echo 'Total Collected Fees : ₹ '.$coll;
	}
	function load_todays_income_count(){
		$start=date('Y-m-d');
		$end=date('Y-m-d');
		$data1=$this->administ_model->get_income_chart('','','',$start,$end);
		$data2=$this->administ_model->get_return_chart('','','',$start,$end);
		$data3=$this->administ_model->get_other_income_chart($start,$end);

		$income=0;
		if(!empty($data1)){
			$income=$income+$data1[0]['feeamount'];
		}
		if(!empty($data2)){
			$income=$income-$data2[0]['feeamount'];
		}
		if(!empty($data3)){
			$income=$income+$data3[0]['feeamount'];
		}
		//($data['fees'][0]['feeamount']+$data['others'][0]['feeamount'])-$data['retamount'][0]['feeamount'];
		echo '₹ '.$income;
	}
	function load_income_count(){
		$start=date('01-m-d');
		$end=date('Y-m-d');
		$data1=$this->administ_model->get_income_chart('','','',$start,$end);
		$data2=$this->administ_model->get_return_chart('','','',$start,$end);
		$data3=$this->administ_model->get_other_income_chart($start,$end);

		$income=0;
		if(!empty($data1)){
			$income=$income+$data1[0]['feeamount'];
		}
		if(!empty($data2)){
			$income=$income-$data2[0]['feeamount'];
		}
		if(!empty($data3)){
			$income=$income+$data3[0]['feeamount'];
		}
		//($data['fees'][0]['feeamount']+$data['others'][0]['feeamount'])-$data['retamount'][0]['feeamount'];
		echo 'This Month : ₹ '.$income.'<br />';
		if(!empty($data1)){
			echo 'Fees Collection : ₹ '.$data1[0]['feeamount'].'<br />';
		}
		if(!empty($data2)){
			echo 'Returned : ₹ '.$data2[0]['feeamount'].'<br />';
		}
		if(!empty($data3)){
			echo 'Other Incomes : ₹ '.$data3[0]['feeamount'];
		}

	}

	function get_total_income_report(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_income_chart($key,$sort,$batches,$start,$end);
		$data['retamount']=$this->administ_model->get_return_chart($key,$sort,$batches,$start,$end);
		$data['others']=$this->administ_model->get_other_income_chart($start,$end);
		$this->load->view('crm/get_total_income_report',$data);
	}
	
	function get_total_income_report1(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_income_chart($key,$sort,$batches,$start,$end);
		$data['retamount']=$this->administ_model->get_return_chart($key,$sort,$batches,$start,$end);
		$this->load->view('crm/get_total_income_report1',$data);
	}
	function get_fees_return_list(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_fees_return_list($key,$sort,$batches,$start,$end);
		$this->load->view('crm/data_fees_return_list',$data);
	}
	function get_fees_return_lists(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$batches=$this->input->post('batches');
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['fees']=$this->administ_model->get_fees_return_list($key,$sort,$batches,$start,$end);
		$this->load->view('crm/data_fees_return_lists',$data);
	}
	function get_assigned_details(){
		$data=array();
		$key=$_POST['key'];
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$batches=$this->input->post('batches');
		$staffs=$this->input->post('staffs');
		$data['details']=$this->administ_model->get_assigned_details($key,$sort,$sorts,$staffs,$batches,$start,$end);
		$this->load->view('crm/data_assigned_details',$data);
	}
	
	function get_batch_listfee(){
		$data=array();
		if(isset($_POST['selected'])){
			$data['selected']=$_POST['selected'];
		}else{
			$data['selected']='';
		}
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$filter=$this->input->post('filter');
		$data['courses']=$this->administ_model->get_course_list('','');
		$data['batches']=$this->administ_model->get_batch_list($key,$sort,$sorts,$filter);
		$this->load->view('crm/data_batch_listfee',$data);
	}
	function get_syllabus_content(){
		$data=array();
		$id=$_POST['id'];
		$data['course']=$this->administ_model->edit_course($id);
		$data['syllabus']=$this->administ_model->get_syllabus_content($id);
		$this->load->view('crm/get_syllabus_content',$data);
	}
	function get_syllabus_areas(){
		$data=array();
		$id=$_POST['id'];
		$data['course']=$this->administ_model->edit_course($id);
		$data['syllabus']=$this->administ_model->get_syllabus_content($id);
		$data['batch']=$this->administ_model->get_batch_content_open($id);
		$this->load->view('crm/get_course_syllabus_det',$data);
	}
	function get_batch_content(){
		$data=array();
		$id=$_POST['id'];
		$data['course']=$this->administ_model->edit_course($id);
		$data['batch']=$this->administ_model->get_batch_content($id);
		$this->load->view('crm/get_batch_content',$data);
	}
	function add_stdent_profile(){
		$data=array();
		$data['batch_id']=$_POST['batch_id'];
		if(!empty($_POST['course_id'])){
			$data['course_id']=$_POST['course_id'];
		}else{
			$data['course_id']=$this->administ_model->get_course_id($data['batch_id']);
		}
		$data['fees']=$this->administ_model->get_batch_content($data['batch_id']);
		$this->load->view('crm/pop_add_stdent_profile',$data);
	}
	function add_stdent_profilenew(){
		$data=array();
		$data['courses']=$this->administ_model->get_course_list('','');
		//$data['fees']=$this->administ_model->get_batch_content($data['batch_id']);
		$this->load->view('crm/pop_add_stdent_profilenew',$data);
	}
	function get_batches_fees_structure(){
		$data=array();
		$data['batch_id']=$_POST['batch_id'];
		$data['fees']=$this->administ_model->get_batch_content($data['batch_id']);
		$this->load->view('crm/get_batches_fees_structure',$data);
	}
	function add_emi_details(){
		$data=array();
		$this->load->view('crm/add_emi_details',$data);
	}
	function assign_staff(){
		$data=array();
		$data['batch_id']=$_POST['batch_id'];
		if(!empty($_POST['course_id'])){
			$data['course_id']=$_POST['course_id'];
		}else{
			$data['course_id']=$this->administ_model->get_course_id($data['batch_id']);
		}
		$key='';
		$sort='';
		$data['staffs']=$this->administ_model->get_all_staffs($key,$sort);
		$data['syllabus']=$this->administ_model->get_syllabus_content($data['course_id']);
		$this->load->view('crm/pop_assign_staff',$data);
	}
	function assign_staff_topics(){
		$data=array();
		$data['batch_id']=$_POST['batch_id'];
		$data['staff_id']=$_POST['staff_id'];
		$data['course_id']=$this->administ_model->get_course_id($data['batch_id']);
		$data['syllabus']=$this->administ_model->get_syllabus_content($data['course_id']);
		$this->load->view('crm/pop_assign_staff1',$data);
	}
	function get_syllabus_area(){
		$data=array();
		$data['id']=$_POST['id'];
		$this->load->view('crm/get_course_syllabus',$data);
	}
	
	function staffs_list(){
		$this->session->set_userdata('cpage','staffprofile');
		$data=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('crm/adminhome',$noti);
		$this->load->view('crm/staffs_list');
		$this->load->view('crm/footer');
	}
	function get_staffs_list(){
		$data=array();
		$key=$_POST['key'];
		$sort=$_POST['sort'];
		$data['staffs']=$this->administ_model->get_all_staffs($key,$sort);
		$this->load->view('crm/data_staffs_list',$data);
	}
	function view_staff_profile(){
		$data=array();
		$id=$_POST['id'];
		$data['staff']=$this->administ_model->view_staff_profile($id);
		$this->load->view('crm/pop_staff_profile',$data);
	}
	function view_student_profile(){
		$data=array();
		$student_id=$_POST['student_id'];
		$batch_id=$_POST['batch_id'];
		$data['student']=$this->administ_model->view_student_profile($student_id);
		$this->load->view('crm/pop_student_profile',$data);
	}
	function show_attendance_stf(){
		$data=array();
		$staff_id=$_POST['id'];
		$data['staff_id']=$staff_id;
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['attendance']=$this->administ_model->show_attendance_stf($staff_id,$start,$end);
		$this->load->view('crm/show_attendance_stf',$data);
	}
	function show_salary_stf(){
		$data=array();
		$staff_id=$_POST['id'];
		$data['staff_id']=$staff_id;
		$data['salary']=$this->administ_model->show_salary_stf($staff_id);
		$this->load->view('crm/show_salary_stf',$data);
	}
	function show_student_fees_details(){
		$data=array();
		$student_id=$_POST['student_id'];
		$data['fees']=$this->administ_model->show_student_fees_details($student_id);
		$data['details']=$this->administ_model->show_student_course_details($student_id);
		$this->load->view('crm/show_student_fees_details',$data);
	}

	function show_attendance_stf_report(){
		$data=array();
		$staff_id=$_POST['id'];
		$data['staff_id']=$staff_id;
		$start=$this->input->post('start');
		$end=$this->input->post('end');
		$data['attendance']=$this->administ_model->show_attendance_stf($staff_id,$start,$end);
		$this->load->view('crm/show_attendance_stf_report',$data);
	}
	function view_enquiry_profile(){
		$data=array();
		$student_id=$_POST['student_id'];
		$data['student']=$this->administ_model->view_enquiry_profile($student_id);
		$this->load->view('crm/pop_enquiry_profile',$data);
	}
	function move_to_admission(){
		$data=array();
		$id=$_POST['student_id'];
		$data['course_id']=$_POST['course_id'];
		if($data['course_id']!=0){
			$data['courses']=$this->administ_model->get_course_list('','');
			$data['student']=$this->administ_model->view_enquiry_profile($id);
			$data['batches']=$this->administ_model->get_batches_lists($data['course_id']);
		}
		
		$this->load->view('crm/pop_move_to_admission',$data);
	}
	function edit_student_profile(){
		$data=array();
		$student_id=$_POST['student_id'];
		$data['student']=$this->administ_model->view_student_profile($student_id);
		$data['fees']=$this->administ_model->get_student_fees($student_id);
		$data['bfees']=$this->administ_model->edit_batch($data['fees'][0]['batch_id']);
		$this->load->view('crm/pop_edit_student_profile',$data);
	}
	function edit_company_profile(){
		$data=array();
		$id=$_POST['id'];
		$data['company']=$this->administ_model->view_company_profile($id);
		$this->load->view('crm/pop_edit_company',$data);
	}
	function edit_enquiry_profile(){
		$data=array();
		$student_id=$_POST['student_id'];
		$data['student']=$this->administ_model->view_enquiry_profile($student_id);
		$data['courses']=$this->administ_model->get_course_list('','');
		$this->load->view('crm/pop_edit_enquiry_profile',$data);
	}
	function edit_staff_profile(){
		$data=array();
		$id=$_POST['id'];
		$data['staff']=$this->administ_model->view_staff_profile($id);
		$this->load->view('crm/pop_edit_staff_profile',$data);
	}
	function edit_course(){
		$data=array();
		$id=$_POST['id'];
		$data['courses']=$this->administ_model->edit_course($id);
		$this->load->view('crm/pop_edit_course',$data);
	}
	function view_batch_details(){
		$data=array();
		$batch_id=$this->input->post('batch_id');;
		if(!empty($_POST['course_id'])){
			$data['course_id']=$_POST['course_id'];
		}else{
			$data['course_id']=$this->administ_model->get_course_id($batch_id);
		}
		
		$data['course']=$this->administ_model->edit_course($data['course_id']);
		$data['batch']=$this->administ_model->edit_batch($batch_id);
		$data['staffs']=$this->administ_model->get_staffs_syllabus($batch_id);
		$data['students']=$this->administ_model->get_batch_students($batch_id,'');
		$this->load->view('crm/pop_view_batch_details',$data);
	}
	function get_batch_details(){

		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['course_title']=$this->administ_model->get_course_title($data['batch_id']);
		$data['batch']=$this->administ_model->edit_batch($data['batch_id']);
		$data['staffs']=$this->administ_model->get_staffs_syllabus($data['batch_id']);
		//$data['students']=$this->administ_model->get_batch_students($batch_id);
		$this->load->view('crm/data_get_batch_details',$data);
	}
	function get_students_list(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$search=$this->input->post('search');
		$data['students']=$this->administ_model->get_batch_students($data['batch_id'],$search);
		$this->load->view('crm/data_get_students_list',$data);
	}
	function selected_interview(){
		$data=array();
		$data['stud_id']=$this->input->post('stud_id');
		$data['vaccency_id']=$this->input->post('opening_id');
		$data['job_position']=$this->administ_model->get_job_position($data['vaccency_id']);
		$this->load->view('crm/pop_selected_interview',$data);
	}
	function get_students_details(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$filter=$this->input->post('filter');
		$data['students']=$this->administ_model->get_students_details($key,$sort,$sorts,$filter);
		$this->load->view('crm/data_students_details',$data);
	}
	function get_openingstudents_list(){
		$data=array();
		$id=$this->input->post('id');
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$data['id']=$id;
		$data['students']=$this->administ_model->get_openingstudents_list($id,$key,$sort,$sorts);
		$this->load->view('crm/get_openingstudents_list',$data);
	}
	function get_selected_candidates_list(){
		$data=array();
		$course=$this->input->post('coursed');
		$batch=$this->input->post('batch');
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$data['students']=$this->administ_model->get_selected_candidates_list($key,$sort,$sorts,$course,$batch);
		$this->load->view('crm/get_selected_candidates_list',$data);
	}
	function get_enquiry_details(){
		$data=array();
		$key=$this->input->post('key');
		$sort=$this->input->post('sort');
		$sorts=$this->input->post('sorts');
		$filter=$this->input->post('filter');
		$data['students']=$this->administ_model->get_enquiry_details($key,$sort,$sorts,$filter);
		$this->load->view('crm/data_enquiry_details',$data);
	}
	function get_batches_list_user(){
		$data=array();
		$course=$this->input->post('course');
 		$role=$this->session->userdata('role');
 		$id=$this->session->userdata('stdid');
 		if($role==1){
 			$data['batches']=$this->administ_model->get_batches_list_admin($course);
 		}else{
 			$data['batches']=$this->administ_model->get_batches_list_u1($course,$id);
 		}
		$this->load->view('crm/option_get_batches_list_user',$data);
	}

	function get_batches_list(){
		$data=array();
		$sort=$this->input->post('sort');
		$data['batches']=$this->administ_model->get_batches_list($sort);
		$this->load->view('crm/option_get_batches_list',$data);
	}
	function get_batches_lists(){
		$data=array();
		$course_id=$this->input->post('course_id');
		$data['batches']=$this->administ_model->get_batches_lists($course_id);
		$this->load->view('crm/option_get_batches_list',$data);
	}
	function get_students_list_fees(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$search=$this->input->post('search');
		$data['students']=$this->administ_model->get_batch_students($data['batch_id'],$search);
		$this->load->view('crm/data_get_students_list_fees',$data);
	}
	function collect_fees(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['student_id']=$this->input->post('student_id');
		$data['student_fees']=$this->administ_model->get_student_fee($data['student_id'],$data['batch_id']);
		$data['fee']=$this->administ_model->collect_fees($data['student_id'],$data['batch_id']);
		$this->load->view('crm/pop_collect_fees',$data);
	}
	function collect_feeses(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['student_id']=$this->input->post('student_id');
		$data['student_fees']=$this->administ_model->get_student_fee($data['student_id'],$data['batch_id']);
		$data['fee']=$this->administ_model->collect_fees($data['student_id'],$data['batch_id']);
		$this->load->view('crm/pop_collect_feeses',$data);
	}
	function show_emi_det(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['student_id']=$this->input->post('student_id');
		$data['emi']=$this->administ_model->show_emi_det($data['student_id'],$data['batch_id']);
		$this->load->view('crm/pop_show_emi_det',$data);
	}

	function change_batch(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['student_id']=$this->input->post('student_id');
		$data['batches']=$this->administ_model->get_silmilar_batches($data['batch_id']);
		$this->load->view('crm/pop_change_batch',$data);
	}
	function refund_fees(){
		$data=array();
		$data['batch_id']=$this->input->post('batch_id');
		$data['student_id']=$this->input->post('student_id');
		$this->load->view('crm/pop_refund_fees',$data);
	}
	function collect_certificate(){
		$data=array();
		$data['student_id']=$this->input->post('student_id');
		$data['student_files']=$this->administ_model->get_student_certificates($data['student_id']);
		$this->load->view('crm/pop_collect_certificate',$data);
	}
	function edit_syllabus(){
		$data=array();
		$id=$_POST['id'];
		$data['syllabus']=$this->administ_model->edit_syllabus($id);
		$this->load->view('crm/pop_edit_syllabus',$data);
	}
	function show_certificate(){
		$data=array();
		$data['certificate']=$_POST['certificate'];
		$this->load->view('crm/pop_show_certificate',$data);
	}
	function edit_batch(){
		$data=array();
		$batch_id=$_POST['batch_id'];
		if(!empty($_POST['course_id'])){
			$data['course_id']=$_POST['course_id'];
		}else{
			$data['course_id']=$this->administ_model->get_course_id($batch_id);
		}
		$data['batch']=$this->administ_model->edit_batch($batch_id);
		$this->load->view('crm/pop_edit_batch',$data);
	}
	function edit_batches(){
		$data=array();
		$batch_id=$_POST['batch_id'];
		if(!empty($_POST['course_id'])){
			$data['course_id']=$_POST['course_id'];
		}else{
			$data['course_id']=$this->administ_model->get_course_id($batch_id);
		}
		$key='';
		$sort='';
		$data['courses']=$this->administ_model->get_course_list($key,$sort);
		$data['batch']=$this->administ_model->edit_batch($batch_id);
		$this->load->view('crm/pop_edit_batch1',$data);
	}
	function delete_staff(){
		$id=$_POST['id'];
		return $this->administ_model->delete_staff($id);
	}
	function delete_staff_attendance(){
		$id=$_POST['id'];
		return $this->administ_model->delete_staff_attendance($id);
	}
	function delete_staff_salary(){
		$id=$_POST['id'];
		return $this->administ_model->delete_staff_salary($id);
	}
	function move_to_users(){
		$data=array();
		$data['staff_key']=$_POST['id'];
		$data['username']=$_POST['mobile'];
		$data['password']=$_POST['mobile'];
		$data['role']=2;
		$data['status']=1;
		return $this->administ_model->move_to_users($data);
	}
	function delete_placed(){
		$id=$_POST['id'];
		return $this->administ_model->delete_placed($id);
	}
	function delete_job_appoinment(){
		$id=$_POST['asid'];
		return $this->administ_model->delete_job_appoinment($id);
	}
	function delete_vaccency(){
		$id=$_POST['id'];
		return $this->administ_model->delete_vaccency($id);
	}
	function delete_company(){
		$id=$_POST['id'];
		return $this->administ_model->delete_company($id);
	}
	function delete_expense(){
		$id=$_POST['id'];
		return $this->administ_model->delete_expense($id);
	}
	function remove_fees_element(){
		$id=$_POST['id'];
		$data=array();
		$data['status']=0;
		return $this->administ_model->remove_fees_element($id,$data);
	}
	function remove_topic_staff(){
		$id=$_POST['id'];
		return $this->administ_model->remove_topic_staff($id);
	}
	function delete_staff_from_batch(){
		$batch_id=$_POST['batch_id'];
		$stid=$_POST['stid'];
		return $this->administ_model->delete_staff_from_batch($batch_id,$stid);
	}
	function delete_batch(){
		$id=$_POST['batch_id'];
		return $this->administ_model->delete_batch($id);
	}
	function delete_course(){
		$id=$_POST['id'];
		return $this->administ_model->delete_course($id);
	}
	function delete_student(){
		$student_id=$_POST['student_id'];
		return $this->administ_model->delete_student($student_id);
	}
	function delete_enquiry(){
		$student_id=$_POST['student_id'];
		return $this->administ_model->delete_enquiry($student_id);
	}
	function discontinue_student(){
		$student_id=$_POST['student_id'];
		return $this->administ_model->discontinue_student($student_id);
	}
	function reactivate_student(){
		$student_id=$_POST['student_id'];
		return $this->administ_model->reactivate_student($student_id);
	}
	function update_student(){
		$data=array();
		$d1=array();
		$d2=array();
		if (!$_FILES['file']){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/users/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	}
    		$id=$_POST['id'];
    		$data['status']=1;
    		//$data['rollno']=$_POST['rollno'];
    		$rno=$this->administ_model->get_last_student_id();
    		$data['rollno']='LUM'.$rno;//+1;
    		$data['name']=$_POST['name'];
    		$data['place']=$_POST['place'];
    		$data['pin']=$_POST['pin'];
    		$data['address']=$_POST['address'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['pin']=$_POST['pin'];
    		$data['phone_number']=$_POST['phone_number'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['email']=$_POST['email'];
    		$data['gender']=$_POST['gender'];
    		$data['dob']=$_POST['dob'];
    		$data['age']=$_POST['age'];
    		$data['date_of_join']=$_POST['date_of_join'];
    		$data['college_name']=$_POST['college_name'];
    		$data['qualification']=$_POST['qualification'];
    		$data['year_of_passout']=$_POST['year_of_passout'];
    		$data['marks_scored']=$_POST['marks_scored'];
        	$this->administ_model->update_student($data,$id);
        	
        	if($d1['photo']!=''){
        		$this->administ_model->insert_student_image($d1,$id);
        	}
        	$batch_stid=$_POST['batch_stid'];
        	$d2['mode_of_pay']=$_POST['mode_of_pay'];
        	$d2['batch_fees']=$_POST['batch_fees'];
        	$d2['fees']=$_POST['fees'];
        	$d2['details']=$_POST['details'];
        	$this->administ_model->update_student_to_batch($d2,$batch_stid);

        	return 1;
	}
	function save_placed_confirm(){
		$d2=array();
		$d2['company_id']=$_POST['company_id'];
        $d2['student_id']=$_POST['student_id'];
        $d2['vaccency_id']=$_POST['vaccency_id'];
        $d2['job_position']=$_POST['job_position'];
        $d2['salary']=$_POST['salary'];
        $d2['details']=$_POST['details'];
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['date']=date('Y-m-d');
        $d2['user']=$this->session->userdata('uid');
        $d2['status']=1;
        $this->administ_model->save_placed_confirm($d2);
        return 1;
	}
	function update_password(){
		$data=array();
		$id=$this->session->userdata('uid');
		$data['password']=$_POST['password'];
		$this->administ_model->update_password($data,$id);
		return 1;
	}
	function save_menu_access(){
		$d2=array();
		$d2['user_id']=$_POST['uid'];
        $d2['date']=date('Y-m-d');
        $d2['dash_board']=$_POST['dash_board'];
		$d2['student_management']=$_POST['student_management'];
		$d2['students_list']=$_POST['students_list'];
		$d2['students_attendance']=$_POST['students_attendance'];
		$d2['placement_control']=$_POST['placement_control'];
		$d2['course_management']=$_POST['course_management'];
		$d2['courses']=$_POST['courses'];
		$d2['batches']=$_POST['batches'];
		$d2['fees_management']=$_POST['fees_management'];
		$d2['fees_remainder']=$_POST['fees_remainder'];
		$d2['staff_management']=$_POST['staff_management'];
		$d2['profiles']=$_POST['profiles'];
		$d2['attendance']=$_POST['attendance'];
		$d2['salary_management']=$_POST['salary_management'];
		$d2['reports']=$_POST['reports'];
		$d2['income']=$_POST['income'];
		$d2['expenses']=$_POST['expenses'];
		$d2['fees_collection']=$_POST['fees_collection'];
		$d2['enquiry_management']=$_POST['enquiry_management'];
		$d2['enquiry_list']=$_POST['enquiry_list'];
		$d2['assigned_list']=$_POST['assigned_list'];
		$d2['front_office']=$_POST['front_office'];
		$d2['company_management']=$_POST['company_management'];
		$d2['companies']=$_POST['companies'];
		$d2['opening_details']=$_POST['opening_details'];
		$d2['assign_to_students']=$_POST['assign_to_students'];
		$d2['selection_list']=$_POST['selection_list'];
		$d2['settings']=$_POST['settings'];
		$d2['user_management']=$_POST['user_management'];
		$d2['reset_password']=$_POST['reset_password'];
		$d2['email_configuration']=$_POST['email_configuration'];
		$d2['whatsapp_configuration']=$_POST['whatsapp_configuration'];
		$this->administ_model->remove_menu_access($d2['user_id']);
        $this->administ_model->save_menu_access($d2);
        return 1;
	}
	function save_staff_attendance(){
		$d2=array();
		$d2['date']=$this->input->post('date');
        $d2['staff_id']=$_POST['staff_id'];
        $d2['stime']=$_POST['stime'];
        $d2['etime']=$_POST['etime'];
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['user']=$this->session->userdata('stdid');
        $d2['status']=1;
        $this->administ_model->save_staff_attendance($d2);
        return 1;
	}
	function save_staff_salary(){
		$d2=array();
		$d2['fdate']=$this->input->post('fdate');
		$d2['tdate']=$this->input->post('tdate');
        $d2['staff_id']=$_POST['staff_id'];
        $d2['salary']=$_POST['salary'];
        $d2['incentives']=$_POST['incentives'];
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['date']=date('Y-m-d');
        $d2['user']=$this->session->userdata('stdid');
        $d2['status']=1;
        $this->administ_model->save_staff_salary($d2);
        return 1;
	}

	function save_nw_emi(){
		$d2=array();
		$d2['rem_date']=$this->input->post('rem_date');
		$d2['amount']=$this->input->post('amount');
        $d2['student_id']=$_POST['student_id'];
        $d2['batch_id']=$_POST['batch_id'];
        $d2['date_time']=date('Y-m-d');
        //$d2['user']=$this->session->userdata('stdid');
        $d2['contact_status']=1;
        $this->administ_model->save_emi_dates($d2);
        return 1;
	}
	function add_new_certificates(){
		$data=array();

		if (!$_FILES['file1']){
    	} else {
    		$temp = explode(".", $_FILES["file1"]["name"]);
			$newfilename = 'A'.round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file1"]["tmp_name"], "./assets/images/certificates/" . $newfilename);
    	    $data['sslc'] =$newfilename;
    	}

    	if (!$_FILES['file2']){
    	} else {
    		$temp = explode(".", $_FILES["file2"]["name"]);
			$newfilename = 'B'.round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file2"]["tmp_name"], "./assets/images/certificates/" . $newfilename);
    	    $data['plus_two'] =$newfilename;
    	}

    	if (!$_FILES['file3']){
    	} else {
    		$temp = explode(".", $_FILES["file3"]["name"]);
			$newfilename = 'C'.round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file3"]["tmp_name"], "./assets/images/certificates/" . $newfilename);
    	    $data['degree'] =$newfilename;
    	}

    	if (!$_FILES['file4']){
    	} else {
    		$temp = explode(".", $_FILES["file4"]["name"]);
			$newfilename = 'D'.round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file4"]["tmp_name"], "./assets/images/certificates/" . $newfilename);
    	    $data['person_id'] =$newfilename;
    	}

    		$id=$_POST['id'];
    		$data['sslc_status']=$_POST['sslc_status'];
    		$data['plus_two_status']=$_POST['plus_two_status'];
    		$data['degree_status']=$_POST['degree_status'];
    		$data['person_id_status']=$_POST['person_id_status'];
    
        	$this->administ_model->update_student($data,$id);
        	return 1;
	}
	function importstudents(){
		$data=array();
		$d1=array();
		//$d1['course_id']=$this->input->post('course_id');
		$d1['batch_id']=$this->input->post('batch_id');
		$upload_file=$_FILES['upload_file']['name'];
		$extension=pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension=='csv')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if($extension=='xls')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata=$spreadsheet->getActiveSheet()->toArray();
		$sheetcount=count($sheetdata);
		
		if($sheetcount>1)
		{
			for ($i=1; $i < $sheetcount; $i++) { 
				$data['time_stamp']=$sheetdata[$i][0];
				$data['name']=$sheetdata[$i][1];
				$data['phone_number']=$sheetdata[$i][2];
				$data['whatsapp']=$sheetdata[$i][3];
				$data['parent_number']=$sheetdata[$i][4];
				$data['email']=$sheetdata[$i][5];
    			$data['address']=$sheetdata[$i][6];
    			$data['pin']=$sheetdata[$i][7];
    			$data['place']=$sheetdata[$i][8];
    			$data['qualification']=$sheetdata[$i][10].' '.$sheetdata[$i][11];;
    			$data['marks_scored']=$sheetdata[$i][12];
    			$data['college_name']=$sheetdata[$i][13];
    			$data['year_of_passout']=$sheetdata[$i][14];
    			$data['source']=$sheetdata[$i][20];
				$data['status']=1;
    			$data['date_time']=date('Y-m-d');
    			$rno=$this->administ_model->get_last_student_id();
    			$data['rollno']='LUM'.$rno;//+1;

    			//$data['pin']=$_POST['pin'];
    			//$data['gender']=$_POST['gender'];
    			//$data['dob']=$_POST['dob'];
    			//$data['age']=$_POST['age'];
    			$data['date_of_join']=date('Y-m-d');
    		
    			$data['added_user']=$this->session->userdata('uid');
    			if($data['name']!=''){
    				$id=$this->administ_model->insert_student($data);
    				$d1['student_id']=$id;
        			//$d1['mode_of_pay']=$_POST['mode_of_pay'];
        			//$d1['batch_fees']=$_POST['batch_fees'];
        			//$d1['fees']=$_POST['fees'];
        			$d1['added_date']=date('Y-m-d');
        			//$d1['details']=$_POST['details'];
        			$d1['status']=1;
        			$this->administ_model->insert_student_to_batch($d1);
    			}
        		
				//$product_qty=$sheetdata[$i][2];
				//$product_price=$sheetdata[$i][3];
				//$data['question']=$question;
				//$inserdata=$this->administ_model->importtesttable($data);
			}
		}
		redirect('administ/students/');
	}
	function save_student(){
		$data=array();
		$d1=array();
		$d2=array();
		$d3=array();
		if (0<$_FILES['file']['error']){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/users/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	}
    		$data['status']=1;
    		$data['date_time']=date('Y-m-d');
    		$rno=$this->administ_model->get_last_student_id();
    		$data['rollno']='LUM'.$rno;//+1;
    		//$data['rollno']=$_POST['rollno'];
    		$data['name']=$_POST['name'];
    		$data['place']=$_POST['place'];
    		$data['pin']=$_POST['pin'];
    		$data['address']=$_POST['address'];
    		$data['source']=$_POST['source'];
    		$data['pin']=$_POST['pin'];
    		$data['phone_number']=$_POST['phone_number'];
    		$data['parent_number']=$_POST['parent_number'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['email']=$_POST['email'];
    		$data['gender']=$_POST['gender'];
    		$data['dob']=$_POST['dob'];
    		$data['age']=$_POST['age'];
    		$data['date_of_join']=$_POST['date_of_join'];
    		$data['college_name']=$_POST['college_name'];
    		$data['qualification']=$_POST['qualification'];
    		$data['year_of_passout']=$_POST['year_of_passout'];
    		$data['marks_scored']=$_POST['marks_scored'];
    		$data['added_user']=$this->session->userdata('uid');
        	$id=$this->administ_model->insert_student($data);
        	
        	if($d1['photo']!=''){
        		$this->administ_model->insert_student_image($d1,$id);
        	}
        	$d2['student_id']=$id;
        	$d2['batch_id']=$_POST['batch_id'];
        	$d2['mode_of_pay']=$_POST['mode_of_pay'];
        	$d2['batch_fees']=$_POST['batch_fees'];
        	$d2['fees']=$_POST['fees'];
        	$d2['added_date']=date('Y-m-d');
        	$d2['details']=$_POST['details'];
        	$d2['status']=1;
        	$this->administ_model->insert_student_to_batch($d2);
        	$emidate=$_POST['emidate'];
        	$emiamount=$_POST['emiamount'];

        	if($_POST['mode_of_pay']=='EMI'){
        		$d3['student_id']=$id;
        		$d3['batch_id']=$_POST['batch_id'];
        		$d3['date_time']=date('Y-m-d');
        		$d3['contact_status']=1;
        		if(!empty($emidate)){
					$str_arr1 = explode (",", $emidate); 
					$str_arr2 = explode (",", $emiamount); 
					$n1=count($str_arr1);
    				$i1=0;
    				while($i1<$n1){
    					$d3['rem_date']=$str_arr1[$i1];
    					$d3['amount']=$str_arr2[$i1];
    					$rq=$this->administ_model->save_emi_dates($d3);
    					$i1++;
    				}
    			}
        	}
        	

        	return 1;
	}
	function save_new_opening(){
		$d2=array();
        $d2['company_id']=$_POST['company_id'];
        $d2['post_name']=$_POST['post_name'];
        $d2['vaccencies']=$_POST['vaccencies'];
        $d2['email']=$_POST['email'];
        $d2['phone_no']=$_POST['phone_no'];
        $d2['start_date']=$_POST['start_date'];
        $d2['ending_date']=$_POST['ending_date'];
        $d2['details']=$_POST['details'];

        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['user']=$this->session->userdata('uid');
        $d2['status']=1;
        return $this->administ_model->save_new_opening($d2);
	}
	function move_to_vaccency(){
		$d2=array();
        $d2['student_id']=$this->input->post('stud_id');
        $d2['opening_id']=$this->input->post('opening_id');
        $d2['company_id']=$this->administ_model->get_opening_company_id($_POST['opening_id']);
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['date']=date('Y-m-d');
        $d2['user']=$this->session->userdata('uid');
        $d2['status']=1;
        return $this->administ_model->move_to_vaccency($d2);
	}
	function update_opening(){
		$d2=array();
		$id=$_POST['id'];
        $d2['company_id']=$_POST['company_id'];
        $d2['post_name']=$_POST['post_name'];
        $d2['vaccencies']=$_POST['vaccencies'];
        $d2['email']=$_POST['email'];
        $d2['phone_no']=$_POST['phone_no'];
        $d2['start_date']=$_POST['start_date'];
        $d2['ending_date']=$_POST['ending_date'];
        $d2['details']=$_POST['details'];

        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['user']=$this->session->userdata('uid');
        $d2['status']=1;
        return $this->administ_model->update_opening($d2,$id);
	}
	function save_students1(){
		$data=array();
		$d2=array();
		$d3=array();
    		$data['status']=1;
    		$data['date_time']=date('Y-m-d');
    		$rno=$this->administ_model->get_last_student_id();
    		$data['rollno']='LUM'.$rno;//+1;
    		//$data['rollno']=$_POST['rollno'];
    		$data['name']=$_POST['name'];
    		$data['place']=$_POST['place'];
    		$data['pin']=$_POST['pin'];
    		$data['address']=$_POST['address'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['pin']=$_POST['pin'];
    		$data['phone_number']=$_POST['phone_number'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['email']=$_POST['email'];
    		$data['gender']=$_POST['gender'];
    		$data['dob']=$_POST['dob'];
    		$data['age']=$_POST['age'];
    		$data['date_of_join']=$_POST['date_of_join'];
    		$data['college_name']=$_POST['college_name'];
    		$data['qualification']=$_POST['qualification'];
    		$data['year_of_passout']=$_POST['year_of_passout'];
    		$data['marks_scored']=$_POST['marks_scored'];
    		$data['added_user']=$_POST['added_user'];
        	$id=$this->administ_model->insert_student($data);
        	
        	$d2['student_id']=$id;
        	$d2['batch_id']=$_POST['batch_id'];
        	$d2['mode_of_pay']=$_POST['mode_of_pay'];
        	$d2['batch_fees']=$_POST['batch_fees'];
        	$d2['fees']=$_POST['fees'];
        	$d2['added_date']=date('Y-m-d');
        	$d2['details']=$_POST['details'];
        	$d2['status']=1;
        	$this->administ_model->insert_student_to_batch($d2);

        	$d3['staff_id']=$this->session->userdata('uid');
        	$d3['student_id']=$id;
        	$d3['added_user']=$_POST['added_user'];
        	$d3['moved_user']=$this->session->userdata('uid');
        	$d3['date_time']=date('Y-m-d h:i:sa');
        	$d3['course']=$this->administ_model->get_course_id($_POST['batch_id']);
        	$d3['batch']=$_POST['batch_id'];
        	$d3['date']=date('Y-m-d');
        	$d3['status']=1;
        	$this->administ_model->add_student_admit_user($d3);
        	return 1;
	}
	function save_enquiry(){
		$data=array();
    		$data['status']=1;
    		$data['date_time']=date('Y-m-d');
    		$data['name']=$_POST['name'];
    		$data['course_id']=$_POST['course_id'];
    		$data['place']=$_POST['place'];
    		$data['pin']=$_POST['pin'];
    		$data['address']=$_POST['address'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['pin']=$_POST['pin'];
    		$data['phone_number']=$_POST['phone_number'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['email']=$_POST['email'];
    		$data['gender']=$_POST['gender'];
    		$data['dob']=$_POST['dob'];
    		$data['age']=$_POST['age'];
    		$data['college_name']=$_POST['college_name'];
    		$data['qualification']=$_POST['qualification'];
    		$data['year_of_passout']=$_POST['year_of_passout'];
    		$data['marks_scored']=$_POST['marks_scored'];
    		$data['enquiry_status']=$_POST['enquiry_status'];
    		$data['appoinment_date']=$_POST['appoinment_date'];
    		$data['appoinment']=$_POST['appoinment'];
    		$data['notes']=$_POST['details'];
    		$data['notify']=$_POST['notify'];
    		$data['added_user']=$this->session->userdata('uid');
    		$data['update_user']=$this->session->userdata('uid');

        	$this->administ_model->save_enquiry($data);
        	return 1;
	}
	function update_enquiry(){
		$data=array();
    		$id=$_POST['id'];
    		$data['date_time']=date('Y-m-d');
    		$data['name']=$_POST['name'];
    		$data['course_id']=$_POST['course_id'];
    		$data['place']=$_POST['place'];
    		$data['pin']=$_POST['pin'];
    		$data['address']=$_POST['address'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['pin']=$_POST['pin'];
    		$data['phone_number']=$_POST['phone_number'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['email']=$_POST['email'];
    		$data['gender']=$_POST['gender'];
    		$data['dob']=$_POST['dob'];
    		$data['age']=$_POST['age'];
    		$data['college_name']=$_POST['college_name'];
    		$data['qualification']=$_POST['qualification'];
    		$data['year_of_passout']=$_POST['year_of_passout'];
    		$data['marks_scored']=$_POST['marks_scored'];
    		$data['enquiry_status']=$_POST['enquiry_status'];
    		$data['appoinment_date']=$_POST['appoinment_date'];
    		$data['appoinment']=$_POST['appoinment'];
    		$data['notes']=$_POST['details'];
    		$data['notify']=$_POST['notify'];
    		$data['update_user']=$this->session->userdata('uid');

        	$this->administ_model->update_enquiry($data,$id);
        	return 1;
	}
	function add_new_fees(){
		$d2=array();
        $d2['batch_id']=$_POST['batch_id'];
        $d2['student_id']=$_POST['student_id'];
        $d2['amount']=$_POST['amount'];
        $d2['mode']=$_POST['mode'];
        $d2['user']=$this->session->userdata('uid');
        $d2['date_time']=date('Y-m-d');
        $d2['record_date']=date('Y-m-d h:i:sa');
        $d2['status']=1;
        $d2['type']=0;
        $this->administ_model->add_new_fees($d2);
	}
	function save_addon_income(){
		$d2=array();
        $d2['title']=$_POST['title'];
        $d2['amount']=$_POST['amount'];
        $d2['date']=$_POST['date'];
        $d2['user']=$this->session->userdata('uid');
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['status']=1;
        return $this->administ_model->save_addon_income($d2);
	}
	function save_addon_expense(){
		$d2=array();
        $d2['title']=$_POST['title'];
        $d2['amount']=$_POST['amount'];
        $d2['date']=$_POST['date'];
        $d2['user']=$this->session->userdata('uid');
        $d2['date_time']=date('Y-m-d h:i:sa');
        $d2['status']=1;
        return $this->administ_model->save_addon_expense($d2);
	}
	function returning_fees(){
		$d2=array();
        $d2['batch_id']=$_POST['batch_id'];
        $d2['student_id']=$_POST['student_id'];
        $d2['amount']='-'.$_POST['amount'];
        $d2['notes']=$_POST['notes'];
        $d2['user']=$this->session->userdata('uid');
        $d2['date_time']=date('Y-m-d');
        $d2['record_date']=date('Y-m-d h:i:sa');
        $d2['status']=1;
        $d2['type']=1;
        $this->administ_model->add_new_fees($d2);
	}
	function change_student_batch(){
		$d2=array();
        $d2['batch_id']=$_POST['batch_id'];
        $student_id=$_POST['student_id'];
        return $this->administ_model->change_student_batch($d2,$student_id);
	}
	function save_staff(){
		$data=array();
		$d1=array();
		if (0<$_FILES['file']['error']){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/users/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	}
    		$data['status']=1;
    		$data['name']=$_POST['staff_name'];
    		$data['staff_id']=$_POST['staff_id'];
    		$data['dob']=$_POST['dob'];
    		$data['gender']=$_POST['gender'];
    		$data['email']=$_POST['email'];
    		$data['mobile']=$_POST['mobile'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['blood_group']=$_POST['blood'];
    		$data['parent_mobile']=$_POST['pmobile'];
    		$data['address']=$_POST['haddress'];
    		$data['local_address']=$_POST['laddress'];
    		$data['qualification']=$_POST['qualifications'];
    		$data['details']=$_POST['details'];
    		$data['designation']=$_POST['designation'];
    		$data['date_of_join']=$_POST['doj'];
        	$id=$this->administ_model->insert_staff($data);
        	
        	if($d1['photo']!=''){
        		$this->administ_model->insert_staff_image($d1,$id);
        	}
        	//echo 'Added';
	}
	function save_syllabus_contents(){
		$data=array();
    	$data['status']=1;
    	$data['syllabus_topic']=$_POST['syllabus_title'];
    	$data['course_id']=$_POST['course_id'];
    	$data['syllabus_content']=$_POST['contents'];
    	$data['duration']=$_POST['duration'];
    	$data['created_date']=date('Y-m-d');
        return $this->administ_model->save_syllabus_contents($data);
	}
	function assign_staff_syllabus(){
		$data=array();
		$d1=array();
    	$data['status']=1;
    	$data['date']=date('Y-m-d');
    	$data['batch_id']=$_POST['batch_id'];
    	$data['staff_id']=$_POST['staff'];
    	$this->administ_model->assign_staff_batch($data);

    	$d1['staff_id']=$_POST['staff'];
    	$d1['batch_id']=$_POST['batch_id'];
    	$d1['status']=1;
    	$d1['date']=date('Y-m-d');
    	$topic_id=$_POST['topic_id'];
    	$n=0;
    	if(!empty($topic_id)){
			$str_arr = explode (",", $topic_id); 
			$n=count($str_arr);
    		$i=0;
    		while($i<$n){
    			$d1['topic_id']=$str_arr[$i];
    			//print_r($str_arr[$i]);
    			$this->administ_model->assign_staff_syllabus($d1);
    			$i++;
    		}
    	}
        return $topic_id;
	}
	function save_attendance(){
		$data=array();
		$d1=array();
    	$data['status']=1;
    	$data['date']=date('Y-m-d');
    	$data['batch_id']=$_POST['batch_id'];
    	$data['class_id']=$_POST['class_id'];

    	$data['user']=$this->session->userdata('uid');
    	$data['date_time']=date('Y-m-d h:i:sa');
    	$students=$_POST['students'];
    	$abstudents=$_POST['abstudents'];
    	$n=0;
    	if(!empty($abstudents)){
			$str_arr1 = explode (",", $abstudents); 
			$n1=count($str_arr1);
    		$i1=0;
    		while($i1<$n1){
    			$r1=$this->administ_model->remove_attandance_history($data['batch_id'],$data['class_id'],$str_arr1[$i1]);
    			$i1++;
    		}
    	}
    	if(!empty($students)){
			$str_arr = explode (",", $students); 
			$n=count($str_arr);
    		$i=0;
    		while($i<$n){
    			$r2=$this->administ_model->remove_attandance_history($data['batch_id'],$data['class_id'],$str_arr[$i]);
    			$data['student_id']=$str_arr[$i];
    			$this->administ_model->save_attendance($data);
    			$i++;
    		}
    	}
        return 1;
	}
	function assign_staff_topic(){
		$d1=array();
    	$d1['staff_id']=$_POST['staff'];
    	$d1['batch_id']=$_POST['batch_id'];
    	$d1['status']=1;
    	$d1['date']=date('Y-m-d');
    	$topic_id=$_POST['topic_id'];
    	$n=0;
    	if(!empty($topic_id)){
			$str_arr = explode (",", $topic_id); 
			$n=count($str_arr);
    		$i=0;
    		while($i<$n){
    			$d1['topic_id']=$str_arr[$i];
    			print_r($str_arr[$i]);
    			$this->administ_model->assign_staff_syllabus($d1);
    			$i++;
    		}
    	}
        return $topic_id;
	}
	function save_batch_contents(){
		$data=array();
		$data['created_date']=date('Y-m-d');
    	$data['status']=1;
    	$data['course_id']=$_POST['course_id'];
    	$data['batch_name']=$_POST['batch_name'];
    	$data['starting_date']=$_POST['starting_date'];
    	$data['ending_date']=$_POST['ending_date'];
    	$data['batch_status']=$_POST['batch_status'];
    	$data['total_fees']=$_POST['total_fees'];
    	$data['discounted_fee']=$_POST['discounted_fee'];
    	$data['emi_total_pay']=$_POST['emi_total_pay'];
    	$data['details']=$_POST['details'];
    	
        return $this->administ_model->save_batch_contents($data);
	}
	function update_batch_contents(){
		$data=array();
		$id=$_POST['batch_id'];
    	$data['batch_name']=$_POST['batch_name'];
    	$data['starting_date']=$_POST['starting_date'];
    	$data['ending_date']=$_POST['ending_date'];
    	$data['batch_status']=$_POST['batch_status'];
    	$data['total_fees']=$_POST['total_fees'];
    	$data['discounted_fee']=$_POST['discounted_fee'];
    	$data['emi_total_pay']=$_POST['emi_total_pay'];
    	$data['details']=$_POST['details'];
    	
        return $this->administ_model->update_batch_contents($data,$id);
	}
	function update_batch_content(){
		$data=array();
		$id=$_POST['batch_id'];
		$data['course_id']=$_POST['course_id'];
    	$data['batch_name']=$_POST['batch_name'];
    	$data['starting_date']=$_POST['starting_date'];
    	$data['ending_date']=$_POST['ending_date'];
    	$data['batch_status']=$_POST['batch_status'];
    	$data['total_fees']=$_POST['total_fees'];
    	$data['discounted_fee']=$_POST['discounted_fee'];
    	$data['emi_total_pay']=$_POST['emi_total_pay'];
    	$data['details']=$_POST['details'];
    	
        return $this->administ_model->update_batch_contents($data,$id);
	}
	function upload_report(){
		$data=array();
		$id=$this->input->post('id');
		$data['report']=$this->input->post('report');
        return $this->administ_model->upload_report($data,$id);
	}


	function delete_emi(){
		$id=$this->input->post('id');
        return $this->administ_model->delete_emi($id);
	}
	function save_course(){
		$data=array();
		$d1=array();
		if (0<$_FILES['file']['error']){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/courses/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	}
    		$data['status']=1;
    		$data['course_name']=$_POST['course_name'];
    		$data['duration']=$_POST['duration'];
    		$data['created_date']=date('Y-m-d');
        	$id=$this->administ_model->insert_course($data);
        	
        	if($d1['photo']!=''){
        		$this->administ_model->insert_course_image($d1,$id);
        	}
	}
	function save_company(){
		$data=array();
		$d1=array();
		if (0<$_FILES['file']['error']){
			$d1['logo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/company/" . $newfilename);
    	    $d1['logo'] =$newfilename;
    	}
    		
    		$data['name']=$_POST['name'];
    		$data['address']=$_POST['address'];
    		$data['place']=$_POST['place'];
    		$data['email']=$_POST['email'];
    		$data['phone_no']=$_POST['phone'];
    		$data['mobile']=$_POST['mobile'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['contact_person1']=$_POST['contact_person1'];
    		$data['contact_person2']=$_POST['contact_person2'];
    		$data['details']=$_POST['details'];

    		$data['user']=$this->session->userdata('uid');
    		$data['date']=date('Y-m-d h:i:sa');
    		$data['status']=1;
        	$id=$this->administ_model->insert_company($data);
        	
        	if($d1['logo']!=''){
        		$this->administ_model->insert_company_image($d1,$id);
        	}
        	return 1;
	}
	function update_company(){
		$data=array();
		$d1=array();
		if (empty($_FILES)){
			$d1['logo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/company/" . $newfilename);
    	    $d1['logo'] =$newfilename;
    	}
    		$id=$_POST['id'];
    		$data['name']=$_POST['name'];
    		$data['address']=$_POST['address'];
    		$data['place']=$_POST['place'];
    		$data['email']=$_POST['email'];
    		$data['phone_no']=$_POST['phone'];
    		$data['mobile']=$_POST['mobile'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['contact_person1']=$_POST['contact_person1'];
    		$data['contact_person2']=$_POST['contact_person2'];
    		$data['details']=$_POST['details'];

    		$data['user']=$this->session->userdata('uid');
    		$data['date']=date('Y-m-d h:i:sa');
    		$data['status']=1;
        	$this->administ_model->update_company($data,$id);
        	
        	if($d1['logo']!=''){
        		$this->administ_model->insert_company_image($d1,$id);
        	}
        	return 1;
	}
	function update_staff(){
		$data=array();
		$id=$_POST['id'];
		$d1=array();
		if ($_FILES["file"]["name"]==''){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/users/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	    $this->administ_model->insert_staff_image($d1,$id);
    	}
    		$data['status']=1;
    		$data['name']=$_POST['staff_name'];
    		$data['staff_id']=$_POST['staff_id'];
    		$data['dob']=$_POST['dob'];
    		$data['gender']=$_POST['gender'];
    		$data['email']=$_POST['email'];
    		$data['mobile']=$_POST['mobile'];
    		$data['whatsapp']=$_POST['whatsapp'];
    		$data['blood_group']=$_POST['blood'];
    		$data['parent_mobile']=$_POST['pmobile'];
    		$data['address']=$_POST['haddress'];
    		$data['local_address']=$_POST['laddress'];
    		$data['qualification']=$_POST['qualifications'];
    		$data['details']=$_POST['details'];
    		$data['designation']=$_POST['designation'];
    		$data['date_of_join']=$_POST['doj'];
        	$this->administ_model->update_staff($data,$id);
	}
	function update_course(){
		$data=array();
		$id=$_POST['id'];
		$d1=array();
		if ($_FILES["file"]["name"]==''){
			$d1['photo'] ='';
    	} else {
    		$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/images/courses/" . $newfilename);
    	    $d1['photo'] =$newfilename;
    	    $this->administ_model->insert_course_image($d1,$id);
    	}
    		$data['status']=1;
    		$data['course_name']=$_POST['course_name'];
    		$data['duration']=$_POST['duration'];
        	$this->administ_model->update_course($data,$id);
	}
	function update_syllabus_content(){
		$data=array();
		$id=$_POST['id'];
	
    	$data['syllabus_topic']=$_POST['syllabus_topic'];
    	$data['duration']=$_POST['duration'];
    	$data['syllabus_content']=$_POST['syllabus_content'];
        return $this->administ_model->update_syllabus_content($data,$id);
	}



}	