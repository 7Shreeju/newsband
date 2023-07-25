<?php

class Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function view1() {
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('id', '1');
        return $this->db->get()->result_array();
    }

//    function cleanStr($string) {
//        // Replaces all spaces with hyphens.
//        $string = str_replace(' ', '-', $string);
//
//        // Removes special chars.
//        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
//        // Replaces multiple hyphens with single one.
//        $string = preg_replace('/-+/', '-', $string);
//
//        return $string;
//    }


         public function roleadmin() {
            $this->db->select('*');
            $this->db->where('id', 1);
            $this->db->from('user_login');
            return $this->db->get()->result_array();
        }



        function visitorDates($date1, $date2) {
        $dates = array();
        $current = strtotime($date1);
        $datetwo = strtotime($date2);
        $stepVal = '+1 day';
        if ($date1 == $date2) {
            $dates = array('00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00');
        } else {
            $format = 'Y-m-d';
            while ($current <= $datetwo) {
                $dates[] = date($format, $current);
                $current = strtotime($stepVal, $current);
            }
        }
        return $dates;
    }

    function pageviewDates($date1, $date2) {
        $dates = array();
        $current = strtotime($date1);
        $datetwo = strtotime($date2);
        $stepVal = '+1 day';
        if ($date1 == $date2) {
            $dates = array('00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00');
        } else {
            $format = 'M d';
            while ($current <= $datetwo) {
                $dates[] = date($format, $current);
                $current = strtotime($stepVal, $current);
            }
        }
        return $dates;
    }

    function pageviewDatesCounts($date1, $date2, $data) {
        $dates = array();
        $current = strtotime($date1);
        $datetwo = strtotime($date2);
        $stepVal = '+1 day';

        if ($date1 == $date2) {
            $dates = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
                '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
            foreach ($dates as $time) {
                if (!empty($data[$time])) {
                    $counts[] = $data[$time];
                } else {
                    $counts[] = '0';
                }
            }
        } else {
            $format = 'Y-m-d';
            while ($current <= $datetwo) {
                $dates = date($format, $current);
                if (!empty($data[$dates])) {
                    $counts[] = $data[$dates];
                } else {
                    $counts[] = '0';
                }
                $current = strtotime($stepVal, $current);
            }
        }
        return $counts;
    }

    function visitorDatesCounts($date1, $date2, $data) {
        $dates = array();
        $current = strtotime($date1);
        $datetwo = strtotime($date2);
        $stepVal = '+1 day';
        if ($date1 == $date2) {
            $dates = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',
                '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
            foreach ($dates as $time) {
                if (!empty($data[$time])) {
                    $counts[] = $data[$time];
                } else {
                    $counts[] = '0';
                }
            }
        } else {
            $format = 'Y-m-d';
            while ($current <= $datetwo) {
                $dates = date($format, $current);
                if (!empty($data[$dates])) {
                    $counts[] = $data[$dates];
                } else {
                    $counts[] = '0';
                }
                $current = strtotime($stepVal, $current);
            }
        }
        return $counts;
    }

    function analitics_data($data, $from, $to) {
        $url = "https://digihostsolutions.com/analytics-platform/public/api/v1/stats/1?name=" . $data . "&from=" . $from . "&to=" . $to . "";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Authorization: Bearer 8ci5TeTw3UrvRbxDwNPNXHokZwFbFGod9SDGX0y0SBIxL5c7jmFqhuKAKR4ylFN1",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        if (!$resp) {
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        // return $resp;
        $fetch_var = '';
        $result = json_decode($resp, true);
        if (is_array($result) || is_object($result)) {

            $finaldata = $result['data'];
        } else {
            $fetch_var = 'Data not found';
        }
        return $finaldata;
        // 	echo json_encode($fetch_var);
    }

    function created_date() {
        $url = "https://digihostsolutions.com/analytics-platform/public/api/v1/websites";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Authorization: Bearer 8ci5TeTw3UrvRbxDwNPNXHokZwFbFGod9SDGX0y0SBIxL5c7jmFqhuKAKR4ylFN1",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        if (!$resp) {
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        $fetch_var = '';
        $result = json_decode($resp, true);
        if (is_array($result) || is_object($result)) {
            $finaldata = $result['data'];
            foreach ($finaldata as $dat_details) {
                $fetch_var = date('Y-m-d', strtotime($dat_details['created_at']));
            }
        } else {
            $fetch_var = 'Data not found';
        }
        return $fetch_var;
        // 	echo json_encode($fetch_var);
    }

    function cleanStr($string) {
        $string = str_replace(' ', '-', $string);
        $string = str_replace('?', '-', $string);
        $string = str_replace('&', '-', $string);
        $string = str_replace('!', '-', $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $string = preg_replace('/-+/', '-', $string);
        return $string;
    }
    function cat_name($id, $column_name, $tbl_name) {
        $this->db->select($column_name);
        $this->db->where('id', $id);
        $this->db->from($tbl_name);
        $name_data = $this->db->get()->result_array();
        foreach ($name_data as $value) {
            return $value[$column_name];
        }
    }

    function insert_table($tbl_name, $data) {
        $this->db->insert($tbl_name, $data);
        return $this->db->insert_id();
    }

    function update_table($tbl_name, $data, $id) {
        $this->db->where('id', $id);
        $this->db->update($tbl_name, $data);
        return $this->db->affected_rows();
    }

    function list($tbl_name) {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }

    function list3($tbl_name, $id) {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }

    function list2($tbl_name) {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->where('status', '1');

        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }

    function list1($tbl_name, $column_name, $fetch_id) {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->where($column_name, $fetch_id);
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }
     function subcat($tbl){
        $this->db->select('*');
        $this->db->where('category_id', '0');
         $this->db->where('status', '1');
        $this->db->from($tbl);
        return $this->db->get()->result_array();
    }

    function count($tbl_name) {
        $this->db->select_sum('title');
        $this->db->where('status', '1');
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }

     function check_unique_order_no($order_no, $tbl_name, $column_name,$id = '') {
         $this->db->where($column_name, $order_no);

         if ($id) {
             $this->db->where_not_in('id', $id);
         }
         return $this->db->get($tbl_name)->num_rows();
     }

    function fetch_data($id, $tbl_name) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from($tbl_name);
        return $this->db->get()->row();
    }

    function view($tbl_name, $id) {
        $this->db->select('*');
        $this->db->where('id', $id);

        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }
    public function statusall12($id, $data, $tbl) {
        $this->db->where_in('category_id', $id);
        $this->db->update($tbl, $data);
    }

    function update_table1($tbl_name, $data, $column_name, $id) {
        $this->db->where($column_name, $id);
        $this->db->update($tbl_name, $data);
        return $this->db->affected_rows();
    }

    function delete_table1($tbl_name, $column_name, $id) {
        $this->db->where($column_name, $id);
        $this->db->delete($tbl_name);
    }

    function delete_table($tbl_name, $id) {
        $this->db->where('id', $id);
        $this->db->delete($tbl_name);
    }

    public function deleteAll($id, $tbl) {
        $this->db->where_in('id', $id);
        $this->db->delete($tbl);
    }

    public function deleteAllcat($id, $tbl) {
        $this->db->where_in('category_id', $id);
        $this->db->delete($tbl);
    }

    public function statusall($id, $data, $tbl) {
        $this->db->where_in('id', $id);
        $this->db->update($tbl, $data);
    }

    public function statusall1($id, $data, $tbl) {
        $this->db->where_in('category_id', $id);
        $this->db->update($tbl, $data);
    }

    function isExit($mobile, $column_name, $tbl_name) {
        $result = $this->db->where([$column_name => $mobile])
                ->get($tbl_name)
                ->row();
        return $result;
    }
  function isExitEdit($mobile, $id,$column_name,$tbl_name) {
        $result = $this->db->where([$column_name => $mobile, 'id !=' => $id])
                ->get($tbl_name)
                ->row();
        return $result;
    }
    
    
     
 function getSubcategoryDependency($postData,$column_name1,$column_name3,$tbl_name) {
        $response = array();

        // Select record
        $this->db->select($column_name1);
        $this->db->where($column_name3, $postData[$column_name3]);
        $this->db->where('status', '1');

        $q = $this->db->get($tbl_name);
        $response = $q->result_array();

        return $response;
    }
  
    function image_upload($file_element_name, $filename, $file_path) {
        $newfilename = '';
        if ($filename != '') {
            $characters = "0123456789";
            for ($i = 0; $i < 6; $i++) {
                $newfilename = $characters[rand(6, 10)];
            }
            $file_name = $filename;
            $file_ext = explode('.', $file_name);
            $file_ext = end($file_ext);

            $config['upload_path'] = $file_path;
            $config['file_name'] = $newfilename . $file_ext;
            $config['allowed_types'] = 'jpg|jpeg|png|JPG|JPEG|PNG';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($file_element_name)) {
                $this->upload->display_errors('', '');
                $assoc_arr = array(
                    'error' => true,
                    'msg' => $this->upload->display_errors()
                );
            } else {
                $data = array('upload_data' => $this->upload->data());
                $assoc_arr = array(
                    'error' => false,
                    'msg' => $data['upload_data']['file_name']
                );
            }
        } else {
            $assoc_arr = array(
                'error' => true,
                'msg' => 'file not select'
            );
        }
        return $assoc_arr;
    }

    public function upload_image($image_data, $num, $path1) {
        $image = md5(date("d-m-y:h:i s")) . "_" . $num;
        if (is_array($image_data)) {
            $file_name = pathinfo(@$image_data['name'], PATHINFO_FILENAME);
            $extension = pathinfo(@$image_data['name'], PATHINFO_EXTENSION);

            if (move_uploaded_file(@$image_data['tmp_name'], $path1 . '' . $image . '.' . $extension)) {
                $image = $image . '.' . $extension;
            } else {
                $image = Null;
            }
        }
        return $image;
    }

    function viewpri($tbl_name, $id) {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }

    public function pri($value) {
        $this->db->select('*');
        $this->db->where('user_id', $value);
        $this->db->from('privilege');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return 'already_added';
        } else {
            return $query->result();
        }
    }

    function impexp($value) {
        $this->db->select('*');
        $this->db->where('comp_name', $value);
        $this->db->from('company_details');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'no_comp';
        }
    }

    public function role() {
        $this->db->select('*');
        $this->db->where('role !=', 'admin');
        $this->db->order_by('id', 'desc');
        $this->db->from('user_login');
        return $this->db->get()->result_array();
    }

    //4
    // public function sidebar($a, $b, $c, $d, $id) {
    //     $this->db->select('*');
    //     $this->db->where($a, 1);
    //     $this->db->where($b, 1);
    //     $this->db->where($c, 1);
    //     $this->db->where($d, 1);
    //     $this->db->where('user_id', $id);
    //     $this->db->from('privilege');
    //     $query = $this->db->get();
    //     return $query;
    // }
    public function adminpriset1($id) {
        $this->db->select('*');
         $this->db->where('user_id', $id);
        $this->db->from('privilege');
       return $this->db->get()->result_array();
    }
    public function adminpriset($a,$id) {
        $this->db->select('*');
        $this->db->where($a, 1);
        $this->db->where('user_id', $id);
        $this->db->from('admin_panel_setup');
        $result = $this->db->get();
        return $result;
    }
  

    //3
//     public function sidebar1($a, $b, $c, $id) {
//         $this->db->select('*');
//         $this->db->where($a, 1);
//         $this->db->where($b, 1);
//         $this->db->where($c, 1);
//         $this->db->where('user_id', $id);
//         $this->db->from('privilege');
//         $query = $this->db->get();
//         return $query;
//     }

//     //2
//     public function sidebar4($a, $b, $id) {
//         $this->db->select('*');
//         $this->db->where($a, 1);
//         $this->db->where($b, 1);
//         $this->db->where('user_id', $id);
//         $this->db->from('privilege');
//         $query = $this->db->get();
//         return $query;
//     }
//   public function sidebar5($a, $id) {
//         $this->db->select('*');
//         $this->db->where($a, 1);
//         $this->db->where('user_id', $id);
//         $this->db->from('privilege');
//         $query = $this->db->get();
//         return $query;
//     }
//     //for blog 5
//     public function sidebar2($a, $b, $c, $d, $e, $id) {
//         $this->db->select('*');
//         $this->db->where($a, 1);
//         $this->db->where($b, 1);
//         $this->db->where($c, 1);
//         $this->db->where($d, 1);
//         $this->db->where($e, 1);
//         $this->db->where('user_id', $id);
//         $this->db->from('privilege');
//         $query = $this->db->get();
//         return $query;
//     }

//     //1 for each pages
//     public function sidebar3($a, $id) {
//         $this->db->select('*');
//         $this->db->where($a, 1);
//         $this->db->where('user_id', $id);
//         $this->db->from('privilege');
//         $query = $this->db->get();
//         return $query;
//     }

    public function un($id, $tbl) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from($tbl);
        $query = $this->db->get();
        return $query;
    }

    public function chksub($email) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->from('user_login');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return 'already_exists';
        } else {

            return $query;
        }
    }
    public function subside($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->where('role!=', 'admin');
        $this->db->from('user_login');
        $query = $this->db->get();
        return $query;
    }
    


    function selectivename($id, $select, $tblname) {
        $this->db->select($select);
        $this->db->where('id', $id);
        $this->db->from($tblname);
        $name_data = $this->db->get()->result_array();
        foreach ($name_data as $value) {
            return $value[$select];
        }
    }
    function selectivename2($id, $select, $tblname,$w) {
        $this->db->select($select);
        $this->db->where($w, $id);
        $this->db->from($tblname);
        $name_data = $this->db->get()->result_array();
        foreach ($name_data as $value) {
            return $value[$select];
        }
    }
    function enq($ss){
        $this->db->select('*');
        $this->db->order_by('id','desc');
        $this->db->where('whereis',$ss);
        $this->db->from('newsletter');
        return $this->db->get()->result_array();
    }

    function lis($tbl_name) {
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->from($tbl_name);
        return $this->db->get()->result_array();
    }
 public function unique($value, $params)
    {
        // Allow for more than 1 parameter.
        $fields = explode(',', $params);

        // Extract the table and field from the first parameter.
        list($table, $field) = explode('.', $fields[0], 2);

        // Setup the db request.
        $this->db->select($field)
                     ->from($table)
                     ->where($field, $value)
                     ->limit(1);

        // Check whether a second parameter was passed to be used as an
        // "AND NOT EQUAL" where clause
        // eg "select * from users where users.name='test' AND users.id != 4
        if (isset($fields[1])) {
            // Extract the table and field from the second parameter
            list($where_table, $where_field) = explode('.', $fields[1], 2);

            // Get the value from the post's $where_field. If the value is set,
            // add "AND NOT EQUAL" where clause.
            $where_value = $this->input->post($where_field);
            if (isset($where_value)) {
                $this->db->where("{$where_table}.{$where_field} <>", $where_value);
            }
        }

        // If any rows are returned from the database, validation fails
        $query = $this->db->get();
        if ($query->row()) {
            //$this->CI->form_validation->set_message('unique', lang('bf_form_unique'));
            $this->form_validation->set_message('unique', $this->lang->line('form_validation_is_unique'));
            return false;
        }

        return true;
    }
    
    public function eachcheckpri($a,$role){
        $this->db->select('*');
        $this->db->from('privilege');
        $this->db->where($a,1);
        $this->db->where('user_id',$role);
        $query = $this->db->get();
        return $query;
    }
    
    
    //bulkimport
      function getRows($tb, $params = array()){
      //$this->db->select('company_details.comp_name, company_details.address, company_details.contact, company_details.gst, , company_details.gst, company_details.alias, company_details.date_financial, company_details.image, company_details.date_books, image.image');
     $this->db->select('*');
        //$this->db->from($this->table); 
        // $this->db->join('image', 'image.name = company_details.comp_name');

        // $this->db->select('name,status,briefintro,details');
         $this->db->from($tb);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
               // $this->db->order_by($this->table.id, 'desc');
                // if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                //     $this->db->limit($params['limit'],$params['start']);
                // }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                //     $this->db->limit($params['limit']);
                // }
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($tb, $data = array()) {
        if(!empty($data)){
           
            // Insert member data
            $insert = $this->db->insert($tb, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $condition array filter data
     */
    public function update($tb, $data, $condition = array()) {
        if(!empty($data)){
          
            // Update member data
            $update = $this->db->update($tb, $data, $condition);
             // Return the status
            return $update?true:false;
        }
        return false;
    }
    public function checkpripage($input,$id){
        $this->db->select('*');
        $this->db->where('user_id','admin');
        $this->db->from('privilege');
        $query= $this->db->get()->result_array();
        foreach($query as $row):
            $this->db->select('*');
            if($row['addf'] == 1){
            $this->db->where('addf', 1);
            $this->db->where('editf', 1);
            $this->db->where('delf', 1);
            $this->db->where('listf', 1);
        }
        if($row['addcf'] == 1){
            $this->db->where('addcf', 1);
            $this->db->where('editcf', 1);
            $this->db->where('delcf', 1);
            $this->db->where('catf', 1);
        }
        if($row['addv'] == 1){
            $this->db->where('addv', 1);
            $this->db->where('editv', 1);
            $this->db->where('delv', 1);
            $this->db->where('listv', 1);
        }
        if($row['addcv'] == 1){
            $this->db->where('addcv', 1);
            $this->db->where('editcv', 1);
            $this->db->where('delcv', 1);
            $this->db->where('catv', 1);
        }
        if($row['addp'] == 1){ 
            $this->db->where('addp', 1);
            $this->db->where('editp', 1);
            $this->db->where('delp', 1);
            $this->db->where('listp', 1);
        }
        if($row['addscp'] == 1){ 
            $this->db->where('addscp', 1);
            $this->db->where('editscp', 1);
            $this->db->where('delscp', 1);
            $this->db->where('subcatp', 1);
        }
        if($row['addb'] == 1){ 
            $this->db->where('addb', 1);
            $this->db->where('editb', 1);
            $this->db->where('delb', 1);
            $this->db->where('listb', 1);
        }
        if($row['addcb'] == 1){  
            $this->db->where('addcb', 1);
            $this->db->where('editcb', 1);
            $this->db->where('delcb', 1);
            $this->db->where('catb', 1);
        }
        if($row['adds'] == 1){  
            $this->db->where('adds', 1);
            $this->db->where('edits', 1);
            $this->db->where('dels', 1);
            $this->db->where('lists', 1);
        }
        if($row['addscs'] == 1){
            $this->db->where('addscs', 1);
            $this->db->where('editscs', 1);
            $this->db->where('delscs', 1);
            $this->db->where('subcats', 1);
        }
        if($row['adde'] == 1){
            $this->db->where('adde', 1);
            $this->db->where('edite', 1);
            $this->db->where('dele', 1);
            $this->db->where('liste', 1);
        }
        if($row['addce'] == 1){
            $this->db->where('addce', 1);
            $this->db->where('editce', 1);
            $this->db->where('delce', 1);
            $this->db->where('cate', 1);
        }
        if($row['addj'] == 1){  
            $this->db->where('addj', 1);
            $this->db->where('editj', 1);
            $this->db->where('delj', 1);
            $this->db->where('listj', 1);
        }
        if($row['addcj'] == 1){ 
            $this->db->where('addcj', 1);
            $this->db->where('editcj', 1);
            $this->db->where('delcj', 1);
            $this->db->where('catj', 1);
        }
        if($row['addn'] == 1){ 
            $this->db->where('addn', 1);
            $this->db->where('editn', 1);
            $this->db->where('deln', 1);
            $this->db->where('listn', 1);
        }
        if($row['addcn'] == 1){ 
            $this->db->where('addcn', 1);
            $this->db->where('editcn', 1);
            $this->db->where('delcn', 1);
            $this->db->where('catn', 1);
        }
        if($row['addg'] == 1){  
            $this->db->where('addg', 1);
            $this->db->where('editg', 1);
            $this->db->where('delg', 1);
            $this->db->where('listg', 1);
        }
        if($row['addcg'] == 1){   
            $this->db->where('addcg', 1);
            $this->db->where('editcg', 1);
            $this->db->where('delcg', 1);
            $this->db->where('catg', 1);
        }
        if($row['addtest'] == 1){  
            $this->db->where('addtest', 1);
            $this->db->where('edittest', 1);
            $this->db->where('deltest', 1);
            $this->db->where('listest', 1);
        }
        if($row['addct'] == 1){ 
            $this->db->where('addct', 1);
            $this->db->where('editct', 1);
            $this->db->where('delct', 1);
            $this->db->where('listct', 1);
        }
        if($row['addpd'] == 1){  
            $this->db->where('addpd', 1);
            $this->db->where('editpd', 1);
            $this->db->where('delpd', 1);
            $this->db->where('listpd', 1);
        }
        if($row['addt'] == 1){  
            $this->db->where('addt', 1);
            $this->db->where('editt', 1);
            $this->db->where('delt', 1);
            $this->db->where('listt', 1);
        }
        if($row['addlink'] == 1){  
            $this->db->where('addlink', 1);
            $this->db->where('editlink', 1);
            $this->db->where('dellink', 1);
            $this->db->where('link', 1);
        }
            $this->db->where('id', $id);
            $this->db->from('privilege');
            $query=  $this->db->get();  
            if($query->num_rows() > 0){
               $delete_data['allpri']= 1;
               $this->common->update_table('privilege', $delete_data, $id); 
            }
        endforeach;
        }

    }

