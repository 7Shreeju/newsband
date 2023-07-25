<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Front_model', 'front');
        $this->load->model('Common_model', 'common');
    }

    public function index() {
        $data['page'] = 'Home-page';
        $data['title'] = 'Home-page | Heft';
        $data['metadescription'] = '';
        $data['keywords'] = '';

        $data['schemap'] = '';
        $this->load->view('web/index', $data);
    }

    public function about_us() {
        $data['page'] = 'About-us';

        $data['title'] = 'About-us | Heft';
        $data['metadescription'] = '';
        $data['keywords'] = '';

        $this->load->view('web/about-us', $data);
    }

//services
    public function services() {
        $data['page'] = 'Services';

        $data['title'] = 'Services | Heft';
        $data['metadescription'] = '';
        $data['keywords'] = '';

        $this->load->view('web/services', $data);
    }

    public function services1($id) {
        $data['page'] = 'Services';

        $data['cat_list'] = $this->front->cat($id);

        $data['title'] = 'Services | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';

        $this->load->view('web/services', $data);
    }

    public function product($id) {
        $data['page'] = 'Products';
        $data['title'] = 'Products | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $data['cat_list'] = $this->front->procat($id);
        $this->load->view('web/product', $data);
    }

    public function category() {
        $data['page'] = 'Category';
        $data['title'] = 'Category | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';

        $this->load->view('web/category', $data);
    }

   public function services_details() {
        $blog_url = $this->uri->segment(2);

        $meta_title = $this->front->single_details('services', 'url="' . $blog_url . '"', 'meta_title', 'id', 'ASC');
        if ($meta_title == "") {
            $title = $this->front->single_details('services', 'url="' . $blog_url . '"', 'name', 'id', 'ASC');
        } else {
            $title = $meta_title;
        }

        $this->db->select('*');
        $this->db->where('old_url', $blog_url);
        $this->db->where('type', 'service');
        $this->db->from('url_redirections');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            redirect("service/" . $row->new_url);
        } else {
            $data['page'] = 'Service';
            $data['services_details'] = $this->front->single_data($blog_url);

            if (!empty($data['services_details'])) {

                $data['og_url'] = base_url() . 'service/' . $blog_url;
                $data['title'] = $title;
                $data['image_url'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'main_imgurl', 'id', 'ASC');
                $data['metadescription'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'meta_description', 'id', 'ASC');
                $data['canonical'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'url', 'id', 'ASC');
                $data['alt_main_img'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'alt_tag_main_img', 'id', 'ASC');
                $data['alt_tag_featured_img'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'alt_tag_featured_img', 'id', 'ASC');
                $data['schemap'] = $this->front->single_details('services', 'url="' . $blog_url . '"', 'schemap', 'id', 'ASC');
                $this->load->view('web/service-details', $data);
            } else {
                redirect('index.html');
            }
        }
    }

    public function product_details() {
        $pro_url = $this->uri->segment(2);

        $meta_title = $this->front->single_details('product', 'url="' . $pro_url . '"', 'meta_title', 'id', 'ASC');
        if ($meta_title == "") {
            $title = $this->front->single_details('product', 'url="' . $pro_url . '"', 'name', 'id', 'ASC');
        } else {
            $title = $meta_title;
        }
        $data['page'] = 'Product';
        $data['product_details'] = $this->front->single_data_product($pro_url);

        $data['og_url'] = base_url() . 'product-details/' . $pro_url;
        $data['title'] = $title;
        $data['image_url'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'image_url', 'id', 'ASC');
        $data['metadescription'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'meta_description', 'id', 'ASC');
        $data['canonical'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'con_url', 'id', 'ASC');
        $data['alt_main_img'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'alt_tag_main_img', 'id', 'ASC');
        $data['alt_tag_featured_img'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'alt_tag_featured_img', 'id', 'ASC');
        $data['schemap'] = $this->front->single_details('product', 'url="' . $pro_url . '"', 'schemap', 'id', 'ASC');
        $this->load->view('web/product-details', $data);
    }

//certification

    public function certifications() {
        $data['page'] = 'certifications';
        $this->load->view('web/certifications', $data);
    }

//Gallery

    public function gallery() {
        $data['page'] = 'Gallery';
        $data['title'] = 'Gallery | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/gallery', $data);
    }

    public function faq() {
        $data['page'] = 'FAQ.' . 's';
        $data['title'] = 'FAQs | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/faq', $data);
    }

//Blogs

    public function blogs() {
        $data['page'] = 'Blogs';
        $data['title'] = 'Blogs | Fazal Rahman Coaching and Consulting ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $data['blog_data'] = $this->front->blog_list_all('blog');
        $this->load->view('web/blogs', $data);
    }

    public function blogs1() {
        $blog_url = $this->uri->segment(2);
        $data['page'] = 'Blogs';
        $data['title'] = 'Blogs | Fazal Rahman Coaching and Consulting ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $data['blog_data'] = $this->front->single_data_blog1($blog_url);
        $this->load->view('web/blogs', $data);
    }

// public function ser() {
//  $blog_url = $this->uri->segment(2);
//        $data['page'] = 'service'; 
//        $data['service_data'] = $this->front->single_service_data($blog_url);
//        
//        $this->load->view('web/service', $data);
//    }

    public function blog_details() {
        $blog_url = $this->uri->segment(2);
        $this->db->select('*');
        $this->db->where('old_url', $blog_url);
        $this->db->where('type', 'blog');
        $this->db->from('url_redirections');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            redirect("blog-details/" . $row->new_url);
        } else {

            $meta_title = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'meta_title', 'id', 'ASC');
            if ($meta_title == "") {
                $title = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'title', 'id', 'ASC');
            } else {
                $title = $meta_title;
            }

            $data['page'] = 'Blog';
            if (!empty($data['blog_details'])) {
                $data['blog_details'] = $this->front->single_data_blog($blog_url);
                $data['blog_details1'] = $this->front->single_data_blog($blog_url);
                $data['og_url'] = base_url() . 'blog/' . $blog_url;
                $data['title'] = $title;
                $data['image_url'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'main_imageurl', 'id', 'ASC');
                $data['metadescription'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'meta_description', 'id', 'ASC');
                $data['canonical'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'canonical', 'id', 'ASC');
                $data['alt_main_img'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'alt_tag_main_img', 'id', 'ASC');
                $data['alt_tag_featured_img'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'alt_tag_featured_img', 'id', 'ASC');
                $data['schemap'] = $this->front->single_details('blog', 'blog_url="' . $blog_url . '"', 'schemap', 'id', 'ASC');
                $this->load->view('web/blog-details', $data);
            } else {
                redirect('index.html');
            }
        }
    }

//contact us

    public function contact_us() {
        $data['page'] = 'Contact-us';
        $data['title'] = 'Contact-us | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/contact', $data);
    }

//Thank you

    public function thank_you() {
        $data['page'] = 'Thank-you';
        $data['title'] = 'Thank-you | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/thank-you', $data);
    }

    public function history() {
        $data['page'] = 'Company History';
        $data['title'] = 'Company History | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/history', $data);
    }

    public function policy() {
        $data['page'] = 'HSC Policy';
        $data['title'] = 'HSC Policy | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/policy', $data);
    }

    public function clients() {
        $data['page'] = 'Our Clients';
        $data['client_category'] = $this->front->client_with_service();

        $data['title'] = 'Our Clients | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/clients', $data);
    }

    public function certificates() {
        $data['page'] = 'Certificates';
        $data['title'] = 'Certificates | Heft ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/certificates', $data);
    }

    public function testimonials() {
        $data['testinomials_details'] = $this->common->list('testimonial');
        $data['page_name'] = 'Testimonials';
        $data['title'] = 'Testimonials | Fazal Rahman Coaching and Consulting ';
        $data['metadescription'] = '';
        $data['keywords'] = '';
        $this->load->view('web/testimonials', $data);
    }

    public function valid_mobile($mobile = '') {
        $mobile = trim($mobile);
        $regex_lowercase = '/[0-9]/';

        if (empty($mobile)) {
            $this->form_validation->set_message('valid_mobile', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $mobile) < 1) {
            $this->form_validation->set_message('valid_mobile', 'The {field} field must be onlu numbers.');
            return FALSE;
        }

        return TRUE;
    }

    public function insert_contact() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required|numeric|exact_length[10]');
        if ($this->form_validation->run()) {
            $insert_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
//                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
                'date' => DATE
            );
            $email1 = 'digihost2021@gmail.com';

            $email = $this->input->post('email');
            $name = $this->input->post('name');

            $mobile = $this->input->post('mobile');

            $message = $this->input->post('message');

//            $subject = "New Contact Enquiry from  " . $name . " on " . PRINTDATE . "\n";
//            $content = 'Dear Admin' . ",\n\r";
//            $content .= "You have received a new contact enquiry  from " . $name . ". Below are the details received from the contact enquiry :" . "\n";
//            $content .= "\n\r";
//            $content .= "Name: " . $name . "\n\r";
//            $content .= "Email ID: " . $email . "\n\r";
//            $content .= "Contact Number: " . $mobile . "\n\r";
//            $content .= "Message: " . $message . "\n\r";
//            $content .= "Regards," . "\n";
//            $content .= "Team Heft." . "\n";
//            $header12 .= "From:" . $email1 . "\n";
//            $mail_status = mail($email1, $subject, $content, $header12);

            $id = $this->front->insert_table('contact', $insert_data);

            if ($id) {
                $array = array(
                    'success' => 'Contact Add successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'mobile_error' => form_error('mobile'), //author variable name
            );
        }
        echo json_encode($array);
    }

    public function insert_contactus() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('mobile', 'mobile', 'trim|required|numeric|exact_length[10]');
        if ($this->form_validation->run()) {
            $insert_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'message' => $this->input->post('message'),
                'date' => DATE
            );
            $email1 = 'digihost2021@gmail.com';

            $email = $this->input->post('email');
            $name = $this->input->post('name');

            $mobile = $this->input->post('mobile');

            $message = $this->input->post('message');

//            $subject = " New Contact Enquiry from  " . $name . " on " . PRINTDATE . "\n";
//            $content = 'Dear Admin' . ",\n\r";
//            $content .= "You have received a new enquiry from " . $name . ". below are the details received from the enquiry: " . "\n";
//            $content .= "\n\r";
//            $content .= "Name: " . $name . "\n\r";
//            $content .= "Email ID: " . $email . "\n\r";
//            $content .= "Contact Number: " . $mobile . "\n\r";
//            $content .= "Service Name: " . $message . "\n\r";
//            $content .= "Regards," . "\n";
//            $content .= "Team Heft." . "\n";
//            $header12 .= "From:" . $email1 . "\n";
//            $mail_status = mail($email1, $subject, $content, $header12);
// $subject = 'New Contact Enquiry from  ';
// 	   $email_content = '<h2 style="margin: 0 0 15px 0; color: #212832; text-align:justify; font-family: Raleway, sans-serif; line-height: 36px; font-size: 28px;">Dear '.$name.',</h2>
//                                     <p style="margin: 10px 0;font-size: 18px;color: #212832;font-weight: 600;">
//                                     Greetings for the day!!
//                                 </p>
//                                 <p style="margin: 0 0 10px 0;font-size: 18px;color: #212832;font-weight: 600;">
//                                     We, at Heft, are pleased to receive your enquiry for the conatct.
//                                 </p>
//                                 <p style="margin: 0 0 10px 0;font-size: 18px;color: #212832;font-weight: 600;">
//                                     Our relationship manager shall soon be in touch with you on the contact details provided by you in the above enquiry, to take this forward.
//                                 </p>
//                                 <p style="margin: 0 0 10px 0;font-size: 18px;color: #212832;font-weight: 600;">
//                                 We wish you a pleasant day ahead.
//                                 </p>
//                                 ';
// $tomail= $email;
//$this->load->view('List/mailer');
//              $this->load->library('phpmailer_lib');
//    
//            // PHPMailer object
//            $mail = $this->phpmailer_lib->load();
//    
//            // SMTP configuration
//            $mail->isSMTP();
//            $mail->Host     = 'smtp.example.com';
//            $mail->SMTPAuth = true;
//            $mail->Username = 'rajashri.chougule@digihost.in';
//            $mail->Password = '********';
//            $mail->SMTPSecure = 'ssl';
//            $mail->Port     = 465;
//    
//            $mail->setFrom('rajashri.chougule@digihost.in', 'CodexWorld');
//            $mail->addReplyTo('rajashri.chougule@digihost.in', 'CodexWorld');
//    
//            // Add a recipient
//            $mail->addAddress('john.doe@gmail.com');
//    
//           
//    
//            // Email subject
//            $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
//    
//            // Set email format to HTML
//            $mail->isHTML(true);
//    
//            // Email body content
//            $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
//                <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
//            $mail->Body = $mailContent;
//    
//            // Send email
//            if(!$mail->send()){
//                echo 'Message could not be sent.';
//                echo 'Mailer Error: ' . $mail->ErrorInfo;
//            }else{
//                echo 'Message has been sent';
//            }
//        
//         
//         

//////////////////////////////////////////SEND MAIL WITH ATTACHMENTS//////////////////////////////////////
                // $boundary = uniqid();
                
                // // header information
                // $headers = "From: $from\r\n";
                // $headers .= "MIME-Version: 1.0\r\n";
                // $headers .= "Content-Type: multipart/mixed; boundary=\".$boundary.\"\r\n";
                
                // // attachment
                // $file = $_FILES["attachment"]["tmp_name"];
                // $filename = $_FILES["attachment"]["name"];
                // $attachment = chunk_split(base64_encode(file_get_contents($file)));
                
                // // message with attachment
                // $message = "--".$boundary."\r\n";
                // $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
                // $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
                // $message .= chunk_split(base64_encode($message));
                // $message .= "--".$boundary."\r\n";
                // $message .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
                // $message .= "Content-Transfer-Encoding: base64\r\n";
                // $message .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
                // $message .= $attachment."\r\n";
                // $message .= "--".$boundary."--";    
                // mail($to, $subject, $message, $headers)   
              
            $id = $this->front->insert_table('contactus', $insert_data);

            if ($id) {
                $array = array(
                    'success' => 'Record Add successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'mobile_error' => form_error('mobile'), //author variable name
            );
        }
        echo json_encode($array);
    }

    public function insert_subscribe() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        if ($this->form_validation->run()) {
            $insert_data = array(
                'email' => $this->input->post('email'),
//                'subject' => $this->input->post('subject'),
                'date' => DATE
            );
            $email1 = 'digihost2021@gmail.com';

            $email = $this->input->post('email');
//            
//            $subject = "New Newsletter Enquiry from  on " . PRINTDATE . "\n";
//            $content = 'Dear Admin' . ",\n\r";
//            $content .= "You have received a new newsletter enquiry.Below are the details received from the Newsletter enquiry :" . "\n";
//            $content .= "\n\r";
//            $content .= "Email ID: " . $email . "\n\r";
//            $content .= "Regards," . "\n";
//            $content .= "Team Heft." . "\n";
//            $header12 .= "From:" . $email1 . "\n";
//            $mail_status = mail($email1, $subject, $content, $header12);

            $id = $this->front->insert_table('subscribe', $insert_data);

            if ($id) {
                $array = array(
                    'success' => 'Record Add successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'emailnesletter_error' => form_error('email'),
            );
        }
        echo json_encode($array);
    }

    public function insert_serenq() {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('contact', 'Mobile', 'trim|required|numeric|exact_length[10]');
        if ($this->form_validation->run()) {
            $insert_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'contact' => $this->input->post('contact'),
                'message' => $this->input->post('message'),
                'service_id' => $this->input->post('service_id'),
                'createdDate' => DATE
            );
            $email1 = 'digihost2021@gmail.com';

            $email = $this->input->post('email');
            $service_name = $this->input->post('service_id');

            $name = $this->input->post('name');

            $mobile = $this->input->post('contact');

            $message = $this->input->post('message');

//            $subject = " New Service Enquiry from  " . $name . " on " . PRINTDATE . "\n";
//            $content = 'Dear Admin' . ",\n\r";
//            $content .= "You have received a new enquiry from " . $name . ". below are the details received from the enquiry: " . "\n";
//            $content .= "\n\r";
//            $content .= "Name: " . $name . "\n\r";
//            $content .= "Service Name: " . $service_name . "\n\r";
//
//            $content .= "Email ID: " . $email . "\n\r";
//
//            $content .= "Contact Number: " . $mobile . "\n\r";
//            $content .= "Message: " . $message . "\n\r";
//            $content .= "Regards," . "\n";
//            $content .= "Team Heft." . "\n";
//            $header12 .= "From:" . $email1 . "\n";
//            $mail_status = mail($email1, $subject, $content, $header12);
            $id = $this->front->insert_table('enqury', $insert_data);

            if ($id) {
                $array = array(
                    'success' => 'Record Add successfully.'
                );
            }
        } else {
            $array = array(
                'error' => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'mobile_error' => form_error('contact'), //author variable name
            );
        }
        echo json_encode($array);
    }

}

?>
