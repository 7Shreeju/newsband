<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/userguide3/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method




 */

//front
$route['default_controller'] = 'login';
 $route['404_override'] = '';
// $route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;



//Login route
$route['setup']='Master/setlogin';
$route['loginsetup'] = 'Master/chklogin';
$route['webset-form']='Master/webset';
$route['websitesetting-form']='Master/websitesetting';
$route['privilege-setup']='Master/privilegesetup';
$route['webset-update-form']='Dashboard/webset_update';
$route['security-key']='Dashboard/settings';
$route['websitesetting-update-form']='Dashboard/websitesetting_update';
$route['loginsetup-update'] = 'Dashboard/chklogin_update';
$route['privilege-setup-update']='Dashboard/privilegesetup_update';


$route['master'] = 'login';
$route['call-post'] = 'Login/call_post';
$route['call-post-web'] = 'Login/call_post_web';

$route['Login-chk'] = 'Login/chklogin';
$route['verify-otp'] = 'login/verify_otp';
$route['otp-chk'] = 'login/chk_otp';
$route['forgot-password'] = 'login/forgot_password';
$route['request-password'] = 'login/request_password';
$route['verify-forgot-otp'] = 'login/verify_forgot_otp';
$route['forgot-chk-otp'] = 'login/forgot_chk_otp';
$route['change-password'] = 'login/change_password';
$route['update-password'] = 'login/update_password';
$route['resend-otp'] = 'login/resend_otp';
$route['logout'] = 'login/logout';
$route['profile-settings'] = 'Profile/profile';
$route['edit-profile'] = 'profile/edit_profile';
$route['feset-password'] = 'Login/change_password1';
$route['settings'] = 'Profile/settings';
$route['edit-setting'] = 'profile/edit_setting';



//Dashboard
//$route['dashboard'] = 'dashboard';
$route['dashboard']= 'dashboard';
$route['dashboard/(:any)']= 'dashboard/dash/$1';





//product
//category
$route['datatable'] = 'blog/data_table';
$route['category-list'] = 'product';
$route['add-category'] = 'product/add_category';
$route['retrive-category'] = 'product/fetch_category';
$route['edit-category'] = 'product/edit_category';
$route['delete-category'] = 'product/delete_category';
$route['status-category'] = 'product/status_category';
$route['featured-product'] = 'product/featured';

$route['delete_allprocat'] = 'product/deleteAllprocat'; 
$route['status_allprocat'] = 'product/statusallprocat';

$route['status_allprocatde'] = 'product/statusalldeprocat';

$route['delete_allprosubcat'] = 'Blog/deleteAllprosubcat'; 
$route['status_allprosubcat'] = 'Blog/statusallprosubcat';
$route['status_allprosubcatde'] = 'Blog/statusalldeprosubcat';

$route['delete_allpro'] = 'product/deleteAll'; 
$route['status_allpro'] = 'product/statusall';
$route['status_alldepro'] = 'product/statusallde';

//subcategory

//$route['subcategory-list'] = 'product/subcategory_list';
//$route['add-subcategory'] = 'product/add_subcategory';
//$route['retrive-subcategory'] = 'product/fetch_subcategory';
//$route['edit-subcategory'] = 'product/edit_subcategory';
//$route['delete-subcategory'] = 'product/delete_subcategory';
//$route['status-subcategory'] = 'product/status_subcategory';
$route['fetch-address'] = 'Product/fetch_address';
$route['myformAjax/(:any)'] = 'product/myformAjax/$1';

// Product start


$route['editproductseo/(:any)']='product/editproductseo/$1';
$route['add-product'] = 'product/addproduct';
$route['insert-product'] = 'product/insert_product';
$route['product-list'] = 'product/product_list';
$route['edit-product/(:any)'] = 'product/editproduct/$1';
$route['edit-pro'] = 'product/editproduct1';
$route['delete-product'] = 'product/delete_product';
$route['status-product'] = 'product/status_product';



//author
$route['add-author'] = 'Blog/author';
$route['insert-author'] = 'Blog/add_author';
$route['author-list'] = 'Blog/author_list';
$route['edit-author/(:any)'] = 'Blog/edit_author/$1';
$route['delete-author'] = 'Blog/delete_author';
$route['status-author'] = 'Blog/status_author';
$route['comment-list']= 'Blog/comments';
//blog List

$route['articlecategory-list'] = 'Blog';
$route['add-blogcategory'] = 'Blog/add_blogcategory';
$route['retrive-blogcategory'] = 'Blog/fetch_blogcategory';

$route['edit-blogcategory'] = 'Blog/edit_blogcategory';
$route['delete-blogcategory'] = 'Blog/delete_blogcategory';
$route['status-blogcategory'] = 'Blog/status_blogcategory';

$route['getCityDepartment'] = 'blog/getCityDepartment';
$route['subcategory-list'] = 'Blog/subcategory_list';
$route['add-subcategory'] = 'Blog/add_subcategory';
$route['retrive-subcategory'] = 'Blog/fetch_subcategory';
$route['edit-subcategory'] = 'Blog/edit_subcategory';
$route['delete-subcategory'] = 'Blog/delete_subcategory';
$route['status-subcategory'] = 'Blog/status_subcategory';
$route['feature-blog'] = 'Blog/feature_blog';
//blog
$route['add-article'] = 'Blog/addblog';
$route['article-list'] = 'Blog/blog_list';
$route['edit-article/(:any)'] = 'Blog/edit_blog/$1';
$route['editblogupdate'] = 'Blog/editblog';

$route['insert-blog'] = 'Blog/insert_blog';
$route['retrive-blog'] = 'Blog/fetch_blog';
$route['delete-blog'] = 'Blog/delete_blog';
$route['status-blog'] = 'Blog/status_blog';
$route['upload_ckeditor'] = 'Blog/upload';
$route['ckeditor_images'] = 'Blog/ckimg_view';
$route['add-seo'] = 'Blog/addseo';
$route['edit-blogseo/(:any)'] = 'Blog/editseo/$1';

$route['status_allblogcat'] = 'Blog/statusallblogcat';
$route['status_allblogcatde'] = 'Blog/statusalldeblogcat';
$route['delete_allblogcat'] = 'Blog/deleteAllblogcat'; 
$route['status_allblog'] = 'Blog/statusallblog';
$route['status_allblogde'] = 'Blog/statusalldeblog';
$route['delete_allblog'] = 'Blog/deleteAllblog'; 


//Faq Category

$route['faqcategory-list'] = 'Faq';
$route['fetch-faqcategory'] = 'Faq/fetch_faqcat';
$route['retrive-faqcategory'] = 'Faq/fetch_faqcategory';
$route['add-faqcategory'] = 'Faq/add_faqcategory';
$route['edit-faqcategory'] = 'Faq/edit_faqcategory';
$route['delete-faqcategory'] = 'Faq/delete_faqcategory';
$route['status-faqcategory'] = 'Faq/status_faqcategory';


$route['delete_allfaqcat'] = 'Faq/deleteAllc'; 
$route['status_allfaqcat'] = 'Faq/statusallc';
$route['status_allfaqcatde'] = 'Faq/statusalldec';

$route['delete_allfaq'] = 'Faq/deleteAll'; 
$route['status_allfaq'] = 'Faq/statusall';
$route['status_allfaqde'] = 'Faq/statusallde';
//Faqlist

$route['faq-list'] = 'Faq/faq_list';
$route['fetch-faq'] = 'Faq/fetch_faqlist';
$route['add-faqq'] = 'Faq/addfaq';
$route['retrive-faq'] = 'Faq/fetch_faq';
$route['edit-faq/(:any)'] = 'Faq/editfaq/$1';
$route['add-faq'] = 'Faq/add_faq';
$route['edit-faq'] = 'Faq/edit_faq';
$route['delete-faq'] = 'Faq/delete_faq';
$route['status-faq'] = 'Faq/status_faq';

//service list

$route['servicecategory-list'] = 'Service';
$route['add-servicecategory'] = 'Service/add_servicecategory';
$route['retrive-servicecategory'] = 'service/fetch_servicecat';
$route['fetch-servicecategory'] = 'service/fetch_servicecategory';
$route['edit-servicecategory'] = 'service/edit_servicecategory';
$route['delete-servicecategory'] = 'service/delete_servicecategory';
$route['status-servicecategory'] = 'service/status_servicecategory';

$route['service-subcategory-list'] = 'service/subcategory_list';
$route['add-servicesubcategory'] = 'service/add_sersubcategory';
$route['retrive-servicesubcategory'] = 'service/fetch_servicesubcat';
$route['edit-servicesubcategory'] = 'service/edit_servicesubcategory';
$route['delete-servicesubcategory'] = 'service/delete_servicesubcategory';
$route['status-sersubcategory'] = 'service/status_servicesubcategory';
$route['getCityDepartment1'] = 'service/getCityDepartment1';
$route['myformAjax1/(:any)'] = 'service/myformAjax1/$1';


$route['add-service'] = 'service/addservice';
$route['insert-service'] = 'service/insert_service';
$route['service-list'] = 'service/service_list';
$route['fetch-service'] = 'service/fetch_service';
$route['edit-service/(:any)'] = 'service/editservice/$1';
$route['editser'] = 'service/editser';
$route['upload'] = 'service/upload';


$route['delete-service'] = 'service/delete_service';
$route['status-service'] = 'service/status_service';
$route['editseo/(:any)'] = 'service/editseo/$1';
$route['featured-service']= 'service/featured_service';

$route['delete_alls'] = 'Service/deleteAll'; 
$route['status_alls'] = 'Service/statusall';
$route['status_allsde'] = 'Service/statusallde';

$route['delete_allsc'] = 'Service/deleteAllc'; 
$route['status_allsc'] = 'Service/statusallc';
$route['status_allscde'] = 'Service/statusalldec';


$route['delete_allsersubcat'] = 'Service/deleteAllsersubcat'; 
$route['status_allsersubcat'] = 'Service/statusallsersubcat';
$route['status_allsersubcatde'] = 'Service/statusalldesersubcat';

//Event Category
$route['eventcategory-list'] = 'Event';
$route['add-eventcategory'] = 'Event/add_eventcategory';
$route['retrive-eventcategory'] = 'Event/fetch_eventcategory';

$route['edit-eventcategory'] = 'Event/edit_eventcategory';
$route['delete-eventcategory'] = 'Event/delete_eventcategory';
$route['status-eventcategory'] = 'Event/status_eventcategory';
$route['feature-event'] = 'Event/feature_event';

//event
$route['add-event'] = 'Event/addevent';
$route['event-list'] = 'Event/event_list';
$route['edit-event/(:any)'] = 'Event/edit_event/$1';
$route['editeventupdate'] = 'Event/editevent';

$route['insert-event'] = 'Event/insert_event';
$route['retrive-event'] = 'Event/fetch_event';
$route['delete-event'] = 'Event/delete_event';
$route['status-event'] = 'Event/status_event';

$route['edit-eventseo/(:any)'] = 'Event/editevntseo/$1';

$route['delete_alleventcat'] = 'Event/deleteAllc'; 
$route['status_alleventcat'] = 'Event/statusallc';
$route['status_alleventcatde'] = 'Event/statusalldec';

$route['delete_allevent'] = 'Event/deleteAll'; 
$route['status_allevent'] = 'Event/statusall';
$route['status_alleventde'] = 'Event/statusallde';

//Job


$route['jobcategory-list'] = 'Job';
$route['add-jobcategory'] = 'Job/add_jobcategory';
$route['retrive-jobcategory'] = 'Job/fetch_jobcategory';

$route['edit-jobcategory'] = 'Job/edit_jobcategory';
$route['delete-jobcategory'] = 'Job/delete_jobcategory';
$route['status-jobcategory'] = 'Job/status_jobcategory';

$route['feature-job'] = 'Job/feature_job';
$route['add-job'] = 'Job/addjob';
$route['job-list'] = 'Job/job_list';
$route['edit-job/(:any)'] = 'Job/edit_job/$1';
$route['editjobupdate'] = 'Job/editjob';

$route['insert-job'] = 'Job/insert_job';
$route['retrive-job'] = 'Job/fetch_job';
$route['delete-job'] = 'Job/delete_job';
$route['status-job'] = 'Job/status_job';

$route['add-seo'] = 'Job/addseo';
$route['edit-jobseo/(:any)'] = 'Job/editseo/$1';

$route['delete_alljobcat'] = 'Job/deleteAllc'; 
$route['status_alljobcat'] = 'Job/statusallc';
$route['status_alljobcatde'] = 'Job/statusalldec';

$route['delete_alljob'] = 'Job/deleteAll'; 
$route['status_alljob'] = 'Job/statusall';
$route['status_alljobde'] = 'Job/statusallde';
// Team

$route['add-team'] = 'Team';
$route['insert-teams'] = 'Team/insert_team';
$route['team_list'] = 'Team/team_list';
$route['retrive-team'] = 'Team/fetch_team';
$route['edit-team/(:any)'] = 'Team/edit_team/$1';
$route['delete-team'] = 'Team/delete_team';
$route['status-team'] = 'Team/status_team';

$route['status_allteam'] = 'Team/statusallteam'; 
$route['delete_allteam'] = 'Team/deleteAllteam';
$route['status_allteamde'] = 'Team/statusalldeteam'; 

//Clientele
$route['add-client'] = 'clientele';
$route['insert-clientele'] = 'clientele/add_client';
$route['client-list'] = 'clientele/client_list';
$route['edit-clientele/(:any)'] = 'clientele/editclient/$1';
$route['delete-client'] = 'clientele/delete_client';
$route['status-client'] = 'clientele/status_client';
$route['delete_allclentele'] = 'clientele/deleteAll'; 
$route['status_allclentele'] = 'clientele/statusall';
$route['status_allclentelede'] = 'clientele/statusallde';




//Gallary
$route['gallarycategory-list'] = 'Gallary';
$route['add-gallarycategory'] = 'Gallary/add_galcategory';
$route['retrive-galcategory'] = 'Gallary/fetch_galcat';
$route['fetch-galcategory'] = 'Gallary/fetch_galcategory';
$route['edit-galcategory'] = 'Gallary/edit_galcat';
$route['delete-galcategory'] = 'Gallary/delete_galcat';
$route['status-galcategory'] = 'Gallary/status_galcat';

$route['add-image'] = 'Gallary/addimg';

$route['insert-gal'] = 'Gallary/insert_gal';
$route['gallary-list'] = 'Gallary/gallary';
$route['fetch-gal'] = 'Gallary/fetch_gal';
$route['edit-gallary/(:any)'] = 'Gallary/editgallary/$1';
$route['delete-gallary'] = 'Gallary/delete_gallary';
$route['status-gallary'] = 'Gallary/status_gallary';





$route['delete_allgalcat'] = 'Gallary/deleteAllc'; 
$route['status_allgalcat'] = 'Gallary/statusallc';
$route['status_allgalcatde'] = 'Gallary/statusalldec';

$route['delete_allgal'] = 'Gallary/deleteAll'; 
$route['status_allgal'] = 'Gallary/statusall';
$route['status_allgalde'] = 'Gallary/statusallde';







//News Category
$route['newscategory-list'] = 'News';
$route['add-newscategory'] = 'News/add_newscategory';
$route['retrive-newscategory'] = 'News/fetch_newscategory';

$route['edit-newscategory'] = 'News/edit_newscategory';
$route['delete-newscategory'] = 'News/delete_newscategory';
$route['status-newscategory'] = 'News/status_newscategory';
$route['feature-news'] = 'News/feature_news';

//news
$route['add-news'] = 'News/addnews';
$route['news-list'] = 'News/news_list';
$route['edit-news/(:any)'] = 'News/edit_news/$1';
$route['editnewsupdate'] = 'News/editnews';

$route['insert-news'] = 'News/insert_news';
$route['retrive-news'] = 'News/fetch_news';
$route['delete-news'] = 'News/delete_news';
$route['status-news'] = 'News/status_news';
$route['edit-newsseo/(:any)'] = 'News/editseo/$1';

$route['delete_allnewscat'] = 'News/deleteAllc'; 
$route['status_allnewscat'] = 'News/statusallc';
$route['status_allnewscatde'] = 'News/statusalldec';

$route['delete_allnews'] = 'News/deleteAll'; 
$route['status_allnews'] = 'News/statusall';
$route['status_allnewsde'] = 'News/statusallde';


//Video

$route['videocategory-list'] = 'Video';
$route['add-videocategory'] = 'Video/add_videocategory';
$route['retrive-videocategory'] = 'Video/fetch_videocategory';

$route['edit-videocategory'] = 'Video/edit_videocategory';
$route['delete-videocategory'] = 'Video/delete_videocategory';
$route['status-videocategory'] = 'Video/status_videocategory';
$route['feature-video'] = 'Video/feature_video';


$route['add-video'] = 'Video/addvideo';
$route['video-list'] = 'Video/video_list';
$route['edit-video/(:any)'] = 'Video/edit_video/$1';
$route['editvideoupdate'] = 'Video/editvideo';

$route['insert-video'] = 'Video/insert_video';
$route['retrive-video'] = 'Video/fetch_video';
$route['delete-video'] = 'Video/delete_video';
$route['status-video'] = 'Video/status_video';
$route['edit-videoseo/(:any)'] = 'Video/editvideoseo/$1';


$route['delete_allvideocat'] = 'Video/delete_allvideocat'; 
$route['status_allvideocat'] = 'Video/status_allvideocat';
$route['status_allvideocatde'] = 'Video/status_allvideocatde';
$route['delete_allvideo'] = 'Video/delete_allvideo'; 
$route['status_allvideo'] = 'Video/status_allvideo';
$route['status_allvideode'] = 'Video/status_allvideode';





//pdf


$route['pdf-add'] = 'Pdf';
$route['add-pdf'] = 'Pdf/add_pdf';
$route['pdf-list'] = 'Pdf/pdf_list';
$route['fetch-pdf'] ='Pdf/fetch_pdf';

$route['editpdf'] = 'Pdf/editpdf';

$route['delete-pdf'] = 'Pdf/delete_pdf';
$route['status-pdf'] = 'Pdf/status_pdf';

$route['delete_allpdf'] = 'Pdf/delete_allpdf';
$route['status_allpdf'] = 'Pdf/status_allpdf'; 
$route['status_allpdfdde'] = 'Pdf/status_allpdfdde';









//Coupon
$route['add-couponn'] = 'Coupon/index';
$route['coupon-list'] = 'coupon/coupon_list';
$route['fetch-coupon'] = 'coupon/fetch_coupon';
$route['add-coupon'] = 'coupon/add_coupon';
$route['edit-coupon/(:any)'] = 'coupon/edit_coupon/$1';
$route['delete-coupon'] = 'coupon/delete_coupon';
$route['status-coupon'] = 'coupon/status_coupon';

// Testimonials
$route['add-testimonials'] = 'testinomial';
$route['insert-testimonials'] = 'testinomial/insert_testimonials';
$route['testimonial_list'] = 'testinomial/testimonial_list';
$route['edit-testimonial/(:any)'] = 'testinomial/edit_testimonial/$1';
$route['edit-testimonial'] = 'testinomial/edittestimonial';
$route['delete-testimonial'] = 'testinomial/delete_testimonial';
$route['status-testimonial'] = 'testinomial/status_testimonial';
$route['retrive-test'] = 'Testinomial/fetch_test';
$route['delete_alltest'] = 'Testinomial/deleteAll'; 
$route['status_alltest'] = 'Testinomial/statusall';
$route['status_alltestde'] = 'Testinomial/statusallde';

$route['delete_allcl'] = 'Clientele/deleteAll'; 
$route['status_allcl'] = 'Clientele/statusall';
$route['status_allclde'] = 'Clientele/statusallde';







$route['link-list'] = 'Breaking';
$route['add-link'] = 'Breaking/add_link';
$route['retrive-link'] = 'Breaking/fetch_link';
$route['fetch-link'] = 'Breaking/fetch_links';
$route['edit-link'] = 'Breaking/edit_link';
$route['delete-link'] = 'Breaking/delete_link';
$route['status-link'] = 'Breaking/status_link';

$route['delete_alllinks'] = 'Breaking/delete_alllinks'; 
$route['status_alllinks'] = 'Breaking/status_alllinks';
$route['status_alllinksdde'] = 'Breaking/status_alllinksdde'; 



$route['slider-list'] = 'Slider';
$route['edit-opinion/(:any)'] = 'Slider/editopinion/$1';
$route['unlinkg']='Slider/unlinkg';
$route['edit-contact/(:any)'] = 'Slider/editecontact/$1';

//pri users
$route['users']= 'User';
$route['fetch-privlist']= 'User/fetch_privlist';
$route['addp']= 'User/addp';
$route['add-privilege'] ='User/add_pri';
// $route['add1-privilege/(:any)']='User/privilege/$1';
$route['add1-privilege']='User/privilege';
$route['edit-privilege/(:any)']='User/edit/$1';
$route['update-privilege']='User/update';
$route['subadmin']='User/add_subadmin';
$route['insert-subadmin']='User/insert_subadmin';
$route['subadminlist']='User/fetch_subadmin';
$route['fetch-subad']='User/fetch_subad';
$route['edit-subadmin/(:any)']= 'User/edit_subadmin/$1';
$route['update-subadmin']='User/update_subadmin';
$route['status-subadmin']='User/status';
$route['delete-subadmin']='User/delete_subadmin';

$route['csv']='csvv';
$route['fetch-csv'] = 'csvv/fetch_csv';
$route['import']='csvv/import';
$route['drag'] = 'bulkimage/drop';
$route['bulkimage']='bulkimage';
$route['images/(:any)']='csvv/imageview/$1';
$route['export']='csvv/export_csv';
$route['stats'] = 'csvv/stats';
$route['fet'] = 'csvv/fetch_data';
$route['fileupload']='csvv/file_upload';
$route['practicepage']='User/practicepage';
$route['suggest']='User/suggest';

$route['check-title']='service/chk_tl';
$route['static-add']='Staticmodule';
$route['insert-statseo']='Staticmodule/insert';
$route['static-list']='Staticmodule/list';
$route['delete-page']='Staticmodule/delete';
$route['edit-staticseo/(:any)']='Staticmodule/edit/$1';
$route['edit-staticseo'] = 'Staticmodule/edit';
$route['website-set']='Staticmodule/websitesetting';
$route['insert-settings']='Staticmodule/insertsettings';
$route['deleteem']='Staticmodule/deleteem';
$route['deletecontact']='Staticmodule/deletecontact';
$route['roles']= 'User/roles';
$route['add-role'] = 'User/add_role';
$route['retrive-role'] = 'User/fetch_role';

$route['edit-role'] = 'User/edit_role';
$route['delete-role'] = 'User/delete_role';
//enq list
$route['contact-enq']='Dashboard/contact_enq';
$route['subscribe-enq']='Dashboard/sub_enq';
$route['paidsub-list']='Dashboard/paidsub_list';
$route['paidsub-list']='Dashboard/paidsub_list';
$route['complaint-list']='Dashboard/complaint_list';
$route['user-list']='Dashboard/user_list';
$route['package-list']='Dashboard/package_list';
$route['retrive-cenq']= 'Master/retrivecenq';
$route['loginhistory']='Dashboard/loginhis';
$route['activitylog']='Dashboard/activiloglist';
$route['logoutdevice/(:any)']='login/logoutdevice/$1';
//
$route['status-pri']='User/status_pri';
$route['status-prim']='User/status_prim';
$route['status-priall']='User/statusall_prim';

//import
$route['bulkimage']='Blog/import';
$route['importsecr']='Service/import';
$route['importpro']='Product/import';