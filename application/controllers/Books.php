<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Docparser\Docparser;
require FCPATH.'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Books extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//require_once APPPATH.'third_party/phpexcel/PHPExcel/IOFactory.php';
        //$this->excel = new PHPExcel(); 
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->library('m_pdf');
		$this->load->model('books_model');
		$this->load->library('session');
		//$this->notifications=$this->administ_model->Get_notification();
		//$this->require_login();
	}
	
	function index()
	{	
		$this->session->set_userdata('cpage','home');
		$data=array();
		$data['covers']=$this->books_model->get_covers();
		$this->load->view('front/header');
		$this->load->view('front/index',$data);
		$this->load->view('front/footer');
	}
	function about()
	{	
		$this->session->set_userdata('cpage','about');
		$data=array();
		$data['covers']=$this->books_model->get_covers();
		$this->load->view('front/header');
		$this->load->view('front/about',$data);
		$this->load->view('front/footer');
	}
	function contact()
	{	
		$this->session->set_userdata('cpage','contact');
		$data=array();
		$this->load->view('front/header');
		$this->load->view('front/contact',$data);
		$this->load->view('front/footer');
	}
	function syllabus(){
		$this->session->set_userdata('cpage','syllabus');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/syllabus',$data);
		$this->load->view('front/footer');
	}
	function exams(){
		$this->session->set_userdata('cpage','exams');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/exams',$data);
		$this->load->view('front/footer');
	}
	function blog(){
		$this->session->set_userdata('cpage','blog');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/blog',$data);
		$this->load->view('front/footer');
	}
	function kids(){
		$this->session->set_userdata('cpage','kids');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/kids',$data);
		$this->load->view('front/footer');
	}
	function careers(){
		$this->session->set_userdata('cpage','careers');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/careers',$data);
		$this->load->view('front/footer');
	}
	function products(){
		$this->session->set_userdata('cpage','products');
		$data=array();
		$params=array();
		$noti['notification']=[];//$this->notifications;
		$this->load->view('front/header');
		$this->load->view('front/products',$data);
		$this->load->view('front/footer');
	}
	function get_english_books(){
		$data=array();
		$data['books']=$this->books_model->get_english_books();
		$this->load->view('front/engbooks',$data);	
	}
	function get_malayalam_books(){
		$data=array();
		$data['books']=$this->books_model->get_malayalam_books();
		$this->load->view('front/engbooks',$data);
	}
	function get_cbse_books(){
		$data=array();
		$data['books']=$this->books_model->get_cbse_books();
		$this->load->view('front/engbooks',$data);
	}
	function get_quiz(){
		$data=array();
		//$data['books']=$this->books_model->get_cbse_books();
		$this->load->view('front/quizpage',$data);
	}
	function get_kids(){
		$data=array();
		//$data['books']=$this->books_model->get_cbse_books();
		$this->load->view('front/kidspage',$data);
	}
	function get_blogs(){
		$data=array();
		//$data['books']=$this->books_model->get_cbse_books();
		$this->load->view('front/blogpage',$data);
	}


}