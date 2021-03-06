<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MY_Controller 
{
    public $uid;
    public $module;
    public $user_type;

    public function __construct() {
    parent::__construct();

    
    $this->module='department';
    $this->uid=$this->session->userdata('uid');
    $this->user_type = $this->session->userdata('user_type');
    }

    public function index()
    {
        if (!$this->CM->checkpermissiontype($this->module, 'index', $this->user_type))
            redirect('error/accessdeny');
        $this->load->model('join_model');
        $data['content_list']=$this->CM->getAll('department');
        $this->load->view('department/index', $data);
    }

    public function add()
    {
      if (!$this->CM->checkpermissiontype($this->module, 'add', $this->user_type))
            redirect('error/accessdeny');
       
        $data['class_list'] = $this->CM->getAll('tbl_class');
               
        $data['name'] = "";
        //$data['status'] = "";
      
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('department/form', $data); 
        }
        else
        {
            
            $datas['name'] = $this->input->post('name'); 
            $datas['class_id'] = $this->input->post('class_name'); 
            $datas['status'] = 1;
            
            $class_list = $this->input->post('class_list');

            $department_id = $this->CM->insert('department',$datas); 

            if ($class_list) 
                                
                foreach ($class_list as $value) {
                   $insert = $this->CM->insert('tbl_department_class_group', array('department_id' => $department_id, 'class_id' => $value));
                }

            if($insert)
            {
                $msg = "Operation Successfull!!";
                $this->session->set_flashdata('success', $msg);
                redirect('department'); 
            }
            else 
            {
                $msg = "There is an error, Please try again!!";
                $this->session->set_flashdata('error', $msg);
                $this->load->view('department/form', $data); 
            }
              redirect('department','refresh'); 
        }
        
    }


    public function edit($id)
    {
         if (!$this->CM->checkpermissiontype($this->module, 'edit', $this->user_type))
            redirect('error/accessdeny');
        
        $content = $this->CM->getInfo('department', $id);

        $this->load->model('join_model') ;
        $data['class_info'] = $this->join_model->get_all_department_where_class_group_info($id);
        
        $data['class_list'] = $this->CM->getAll('tbl_class');
        $data['name'] = $content->name;
        $data['class_name'] = $content->class_id;
        //$data['status'] = $content->status;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules( 'name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
                $this->load->view('department/form', $data); 
        }
        else
        {
            $datas['name'] = $this->input->post('name'); 
            $datas['class_id'] = $this->input->post('class_name'); 
            //$datas['status'] = $this->input->post('status');
            //$datas['entryby']=$this->session->userdata('uid');       
 
            if($this->CM->update('department', $datas, $id)){
            $this->CM->delete('tbl_department_class_group', array('department_id' => $id));
                $class_info = $this->input->post('class_list');
                if ($class_info) 
                                
                    foreach ($class_info as $value) {
                        $insert = $this->CM->insert('tbl_department_class_group', array('department_id' => $id, 'class_id' => $value));
                    }

                    $msg = "Operation Successfull!!";
                    $this->session->set_flashdata('success', $msg);
                    redirect('department'); 
                }
        }
        
    }

    public function delete($id) {
        if (!$this->CM->checkpermissiontype($this->module, 'delete', $this->user_type))
            redirect('error/accessdeny');

        if ($this->CM->delete_db('department', $id)) {
            $msg = "Operation Successfull!!";
            $this->session->set_flashdata('success', $msg);
        } else {
            $msg = "There is an error, Please try again!!";
            $this->session->set_flashdata('error', $msg);
        }

        redirect('department');
    }

    public function getdepartmentbyteacher($teacher){
        $department_list=$this->CM->getAllWhere('department', array('id' => $teacher));
        
//        echo '<pre>';
//        print_r($department_list);
//        exit();
        
        echo json_encode($department_list); 
        
    }


}