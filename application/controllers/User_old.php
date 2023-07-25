<?php

class User_old extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->model('Common_model', 'common');
        $this->load->model('Profile_model', 'pro');
        
        $this->login->is_logged_in();
    }

    public function index() {
        $data['page_name'] = 'User List';
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'user/user_list';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $data['user'] = $this->common->role();
        $this->load->view('admin_template', $data);
    }

    function fetch_privlist() {

        $this->load->model("crud_model");
        $table = "user_login";
        $select_column = array("id", "name", "role", "status");
        $order_column = array(null, "name", "role", "status", null);

        $fetch_data = $this->crud_model->make_datatables1($table, $select_column, $order_column);
        $data = array();
        $count = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->name;
            $sub_array[] = $row->role;
            if ($row->status == 1) {
                $checkstatus = '<label class="switch switch-success">
                <input type="checkbox" checked  data-id="' . $row->id . '" data-status="0" class="switch-input status-subadmin"  />
                             <span class="switch-toggle-slider">
                               <span class="switch-on">
                                 <i class="bx bx-check"></i>
                               </span>
                             </span>';
            } else {
                if ($row->status == 0) {
                    $checkstatus = '<label class="switch switch-success">
                 <input type="checkbox"  data-id="' . $row->id . '" data-status="1" class="switch-input status-subadmin"  />
                 <span class="switch-toggle-slider">
               <span class="switch-off">
                 <i class="bx bx-x" style="color:red;"></i>
               </span>
             </span>
             ';
                }
            }
            $sub_array[] = $checkstatus;
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Basic example">
                           
                              
                                <button type="button" class="btn btn-info addp" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add Privileges" data-id="' . $row->id . '" ><i class="fa fa-plus font-14"></i></button>
                                <a class="btn btn-info" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit Privileges" href="edit-privilege/' . $row->id . '"><i class="far fa-edit font-14"></i></a>
                                </div>';

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud_model->get_all_data1($table),
            "recordsFiltered" => $this->crud_model->get_filtered_data1($table, $select_column, $order_column),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function privilege() {
        $data['page_name'] = 'User List';
        $id = $this->session->userdata('user_id');
        $data['user_detail'] = $this->common->view1();
        $data['privileges'] = $this->common->view('user_login', $id);
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $data['content_view'] = 'user/privilege';

        $this->load->view('admin_template', $data);
    }

    public function add_pri() {
        //  if($this->input->post('submit')){
        $id = $this->input->post('id');
        $result = $this->common->pri($id);
        if ($result == 'already_added') {
            $array = array(
                'error' => 'Already added privileges Go to edit ',
            );
        } else {
            $data = array(
                'user_id' => $this->input->post('id'),
                'catf' => $this->input->post('catf'),
                'addf' => $this->input->post('addf'),
                'listf' => $this->input->post('listf'),
                'addt' => $this->input->post('addt'),
                'listt' => $this->input->post('listt'),
                'cate' => $this->input->post('cate'),
                'adde' => $this->input->post('adde'),
                'liste' => $this->input->post('liste'),
                'catp' => $this->input->post('catp'),
                'subcatp' => $this->input->post('subcatp'),
                'addp' => $this->input->post('addp'),
                'listp' => $this->input->post('listp'),
                'authb' => $this->input->post('authb'),
                'authlistb' => $this->input->post('authlistb'),
                'catb' => $this->input->post('catb'),
                'addb' => $this->input->post('addb'),
                'listb' => $this->input->post('listb'),
                'cats' => $this->input->post('cats'),
                'subcats' => $this->input->post('subcats'),
                'adds' => $this->input->post('adds'),
                'lists' => $this->input->post('lists'),
                'catj' => $this->input->post('catj'),
                'addj' => $this->input->post('addj'),
                'listj' => $this->input->post('listj'),
                'catn' => $this->input->post('catn'),
                'addn' => $this->input->post('addn'),
                'listn' => $this->input->post('listn'),
                'addc' => $this->input->post('addc'),
                'listc' => $this->input->post('listc'),
                'addtest' => $this->input->post('addtest'),
                'listest' => $this->input->post('listest'),
                'addct' => $this->input->post('addct'),
                'listct' => $this->input->post('listct'),
                'catv' => $this->input->post('catv'),
                'addv' => $this->input->post('addv'),
                'listv' => $this->input->post('listv'),
                'addpd' => $this->input->post('addpd'),
                'listpd' => $this->input->post('listpd'),
                'catg' => $this->input->post('catg'),
                'addg' => $this->input->post('addg'),
                'listg' => $this->input->post('listg'),
                'linklis' => $this->input->post('linklis'),
                'addusers' => 1,
                'users' => 1,
                'listusers' => 1,
            );
            $r = $this->db->insert('privilege', $data);
            if ($r) {
                $array = array(
                    'success' => ' Data Added',
                );
            }
        }
        echo json_encode($array);
    }

    public function edit($id) {
        // $id = $this->session->userdata('user_id');
        $data['page_name'] = 'User List';
        $data['edit_details'] = $this->common->view('privilege', $id);
        $data['user_detail'] = $this->common->view1();
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $data['content_view'] = 'user/edit';

        $this->load->view('admin_template', $data);
    }

    public function update() {
        //  if($this->input->post('submit')){
        $id = $this->input->post('id');

        $data = array(
            //'user_id'=> $this->session->userdata('user_id'),
            'catf' => $this->input->post('catf'),
            'addf' => $this->input->post('addf'),
            'listf' => $this->input->post('listf'),
            'addt' => $this->input->post('addt'),
            'listt' => $this->input->post('listt'),
            'cate' => $this->input->post('cate'),
            'adde' => $this->input->post('adde'),
            'liste' => $this->input->post('liste'),
            'catp' => $this->input->post('catp'),
            'subcatp' => $this->input->post('subcatp'),
            'addp' => $this->input->post('addp'),
            'listp' => $this->input->post('listp'),
            'authb' => $this->input->post('authb'),
            'authlistb' => $this->input->post('authlistb'),
            'catb' => $this->input->post('catb'),
            'addb' => $this->input->post('addb'),
            'listb' => $this->input->post('listb'),
            'cats' => $this->input->post('cats'),
            'subcats' => $this->input->post('subcats'),
            'adds' => $this->input->post('adds'),
            'lists' => $this->input->post('lists'),
            'catj' => $this->input->post('catj'),
            'addj' => $this->input->post('addj'),
            'listj' => $this->input->post('listj'),
            'catn' => $this->input->post('catn'),
            'addn' => $this->input->post('addn'),
            'listn' => $this->input->post('listn'),
            'addc' => $this->input->post('addc'),
            'listc' => $this->input->post('listc'),
            'addtest' => $this->input->post('addtest'),
            'listest' => $this->input->post('listest'),
            'addct' => $this->input->post('addct'),
            'listct' => $this->input->post('listct'),
            'catv' => $this->input->post('catv'),
            'addv' => $this->input->post('addv'),
            'listv' => $this->input->post('listv'),
            'addpd' => $this->input->post('addpd'),
            'listpd' => $this->input->post('listpd'),
            'catg' => $this->input->post('catg'),
            'addg' => $this->input->post('addg'),
            'listg' => $this->input->post('listg'),
            'linklis' => $this->input->post('linklis'),
            'addusers' => 1,
            'users' => 1,
            'listusers' => 1,
        );
        $r = $this->common->update_table('privilege', $data, $id);
        //  if($r){ 
        $array = array(
            'success' => 'updated data',
        );
        //  } 
        echo json_encode($array);
    }

    public function add_subadmin() {
        $data['page_name'] = 'Sub Admin List';
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'user/addsubad';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        // $data['user_details'] = $this->common->fetch_data($this->session->userdata('user_id'),'user_login');
        $data['user'] = $this->common->list('user_login');
        $this->load->view('admin_template', $data);
    }

    public function insert_subadmin() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user_login.email]', array('is_unique' => 'This %s already exists.'));
        $this->form_validation->set_rules('role', 'role', 'trim|required');
        // $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run()) {

            $email = $this->input->post('email');
            $result = $this->common->chksub($email);
            if ($result == 'already_exists') {
                $array = array(
                    'error' => 'Sub admin already exist.'
                );
            } else {
                $insert_data = array(
                    'name' => $this->input->post('name'),
                    'role' => $this->input->post('role'),
                    'email' => $this->input->post('email'),
                    'status' => '1',
                    'flag' => '1',
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'createdDate' => DATE
                );

                $id = $this->common->insert_table('user_login', $insert_data);
                $lid = $this->db->insert_id();
                $insertdatap = array(
                    'user_id' => $lid,
                    'addusers' => 1,
                    'users' => 1,
                    'listusers' => 1,
                    'status' => 1,
                );
                $this->db->insert('privilege', $insertdatap);
                $this->db->select('*');
                $this->db->where('user_id',1);
                $query= $this->db->get('admin_panel_setup');
                $row=  $query->row();
                $setupdata= array(
                'user_id'=>$lid,
                'subadmin' => $row->subadmin,
                'product' =>  $row->product,
                'blog' =>  $row->blog,
                'services' =>  $row->services,
                'faq' =>  $row->faq,
                'gallery' =>  $row->gallery,
                'event' =>  $row->event,
                'video' =>  $row->video,
                'job' =>  $row->job,
                'teams' =>  $row->teams,
                'pdf' =>  $row->pdf,
                'news' =>  $row->news,
                'testimonials' =>  $row->testimonials,
                'clientele' =>  $row->clientele,
                );
                $this->db->insert('admin_panel_setup', $setupdata);
                if ($id) {
                    $array = array(
                        'success' => 'Sub Admin data Added successfully.'
                    );
                }
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'role_error' => form_error('role'),
                'password_error' => form_error('password')
            );
        }
        echo json_encode($array);
    }

    public function fetch_subadmin() {
        $data['page_name'] = 'Sub Admin List';
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'user/sublist';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));

        $data['user'] = $this->common->role();
        $this->load->view('admin_template', $data);
    }

    function fetch_subad() {

        $this->load->model("crud_model");
        $table = "user_login";
        $select_column = array("id", "name", "role", "status");
        $order_column = array(null, "name", "role", "status", null);

        $fetch_data = $this->crud_model->make_datatables1($table, $select_column, $order_column);
        $data = array();
        $count = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->name;
            $sub_array[] = $row->role;
            if ($row->status == 1) {
                $checkstatus = '<label class="switch switch-success">
                <input type="checkbox" checked  data-id="' . $row->id . '" data-status="0" class="switch-input status-subadmin"  />
                             <span class="switch-toggle-slider">
                               <span class="switch-on">
                                 <i class="bx bx-check"></i>
                               </span>
                             </span>';
            } else {
                if ($row->status == 0) {
                    $checkstatus = '<label class="switch switch-success">
                 <input type="checkbox"  data-id="' . $row->id . '" data-status="1" class="switch-input status-subadmin"  />
                 <span class="switch-toggle-slider">
               <span class="switch-off">
                 <i class="bx bx-x" style="color:red;"></i>
               </span>
             </span>
             ';
                }
            }
            $sub_array[] = $checkstatus;

            $sub_array[] = '<div class="btn-group" role="group" aria-label="Basic example">
                           
                              
                              
                                <a class="btn btn-info" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Edit Privileges" href="edit-subadmin/' . $row->id . '"><i class="far fa-edit font-14"></i></a>
                                <button type="button" class="btn btn-info delete-subadmin" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" data-bs-original-title="Delete" Parker data-id="' . $row->id . '"><i class="far fa-trash-alt font-14"></i></button>
                                </div>';

            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud_model->get_all_data1($table),
            "recordsFiltered" => $this->crud_model->get_filtered_data1($table, $select_column, $order_column),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function edit_subadmin($id) {
        $data['user_detail'] = $this->common->view1();
        $data['page_name'] = 'Sub Admin List';
        $data['details'] = $this->common->view('user_login', $id);
        $data['content_view'] = 'user/subedit';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $this->load->view('admin_template', $data);
    }

    public function update_subadmin() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('role', 'role', 'trim|required');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id');

            $insert_data = array(
                'name' => $this->input->post('name'),
                'role' => $this->input->post('role'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'createdDate' => DATE
            );
            $id = $this->common->update_table('user_login', $insert_data, $id);
            //  if ($id) {
            $array = array(
                'success' => 'User data Updated successfully.'
            );
            // }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'role_error' => form_error('role'),
            );
        }
        echo json_encode($array);
    }

  
    public function check_strong_password($str) {
        if (preg_match('#[0-9]#', $str) || preg_match('#[A-Z]#', $str) || preg_match('#[a-z]#', $str)) {
            return TRUE;
        }
        $this->form_validation->set_message('check_strong_password', 'The password field must be contains at least uppercase letter and one digit.');
        return FALSE;
    }
    

    public function status() {
        $id = $this->input->post('id');
        $delete_data = array(
            'status' => $this->input->post('status_id'),
        );
        $this->common->update_table('user_login', $delete_data, $id);
        $array = array(
            'success' => 'status data Updated successfully.'
        );
        echo json_encode($array);
    }

    public function delete_subadmin() {


        $id = $this->input->post('id');

        $this->common->delete_table('user_login', $id);
        $this->common->delete_table1('privilege','user_id', $id);
        $this->common->delete_table1('admin_panel_setup','user_id', $id);
        $array = array(
            'success' => 'Data Deleted successfully.'
        );
        echo json_encode($array);
    }

    public function addp() {
        $id = $this->input->post('id');
        $result = $this->common->pri($id);
        if ($result == 'already_added') {
            $array = array(
                'error' => 'Already added privileges Go to edit ',
            );
        } else {
            $array = array(
                'success' => 'Proceed',
            );
            $this->session->set_userdata('sub', $id);
        }
        echo json_encode($array);
    }

    public function practicepage() {
        $data['page_name'] = 'User List';
        $data['user_detail'] = $this->common->view1();
        $data['content_view'] = 'slider/frontpage';
        $data['user_details'] = $this->pro->view('user_login', $this->session->userdata('user_id'));
        $this->load->view('admin_template', $data);
    }

    public function suggest() {
        $data1['legder_report'] = $this->common->lis('blog');
        $data = '';

        foreach ($data1['legder_report'] as $val) {

            $data .= '<div> 
 <span>' . $val['title'] . '</span>
   </div>';
        }
        echo json_encode($data);
    }

}

?>