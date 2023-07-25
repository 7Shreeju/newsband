<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">



    <div class="app-brand demo ">
        <a href="<?php echo base_url(); ?>" class="app-brand-link">

            <?php
            if (isset($user_detail)) {
                foreach ($user_detail as $value) :
                    ?>
                    <img lass="reduceimg h-auto" src="<?php echo base_url() ?>uploads/img/<?php echo $value['logo']; ?>" style="width: 100%; height: 100%; ">
                    <?php
                endforeach;
            } else {
                ?>
                <img lass="reduceimg h-auto" src="<?php echo base_url() ?>uploads/img/<?php echo $value['pic']; ?>">

            <?php } ?>
        </a>




        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item <?php echo $page_name == 'Dashboard' ? 'active open' : ''; ?>">
            <a href="<?php echo base_url(); ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <!--<img class="h-auto"  src="<?php echo base_url(); ?>template/admin_assets/img/sidebaricon/dashboard.png">-->
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <!-- Layouts -->

      
        <?php
        
       $result =$this->common->adminpriset1($this->session->userdata('brw_logged_type'));
     foreach ($result as $key) {
     
        if($key['catp'] == 1 || $key['subcatp'] == 1 || $key['addp'] == 1 || $key['listp'] == 1){
        ?>
            <li class="menu-item <?php echo $page_name == 'E-Paper List' || $page_name == 'Add SubCategory List' ||  $page_name == 'Product Category List' || $page_name == 'Product SubCategory List' || $page_name == 'Product Feature List' || $page_name == 'Product addOns List' || $page_name == 'Product Payment List' || $page_name == 'Add E-Paper' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxl-product-hunt"></i>
                    <div style="margin-left: 10px;" data-i18n="E-Paper">E-Paper</div>
                </a>
                <ul class="menu-sub">
<?php
                   
                    if ($key['subcatp'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'Product SubCategory List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>subcategory-list" class="menu-link">
                                <div data-i18n="Product Category List">Product Category List</div>
                            </a>
                        </li>-->
                        <?php
                    } else {
                       
                    }
                  
                    if ($key['addp'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add E-Paper' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-product" class="menu-link">
                                <div data-i18n="Add E-Paper ">Add E-Paper</div>
                            </a>
                        </li>
                        <?php
                    } else {
                        
                    }
                  
                    if ($key['listp'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'E-Paper List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>product-list" class="menu-link">
                                <div data-i18n="E-Paper List">E-Paper List</div>
                            </a>
                        </li>
                    <?php 
                    } else {
                        } ?>
                </ul>
            </li>
            <?php
        }
      

            if($key['catb'] == 1||$key['addb'] == 1 || $key['listb'] == 1  ){
            ?>
            <li class="menu-item <?php echo  $page_name == 'Author List'  || $page_name == 'Add Author' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxl-blogger"></i>
                    <div  style="margin-left: 10px;" data-i18n="Author">Author</div>
                </a>
                <ul class="menu-sub">
                  <li class="menu-item <?php echo $page_name == 'Add Author' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-author" class="menu-link">
                                <div data-i18n="Add Author">Add Author</div>
                            </a>
                        </li>
                    
                        <li class="menu-item <?php echo $page_name == 'Author List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>author-list" class="menu-link">
                                <div data-i18n="Author List">Author List</div>
                            </a>
                        </li>
                 
                </ul>
            </li>
            <li class="menu-item <?php echo $page_name == 'Article Category List' || $page_name == 'Breaking News' || $page_name == 'Comments List' ||$page_name == 'Article SubCategory List' || $page_name == 'Article List' || $page_name == 'Edit Article' || $page_name == 'Add Article' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxl-blogger"></i>
                    <div  style="margin-left: 10px;" data-i18n="Article">Article</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['catb'] == 1) {
                        ?><li class="menu-item <?php echo $page_name == 'Article Category List' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>articlecategory-list" class="menu-link">
                            <div data-i18n="Article Category">Article Category</div>
                        </a>
                    </li>
                    <li class="menu-item <?php echo $page_name == 'Article SubCategory List' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>subcategory-list" class="menu-link">
                            <div data-i18n="Article SubCategory">Article SubCategory</div>
                        </a>
                    </li>
                    <?php
                    } else {
                       
                    }
                  
                    if ($key['addb'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Article' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-article" class="menu-link">
                                <div data-i18n="Add Article">Add Article</div>
                            </a>
                        </li>
                        <?php
                    } else {
                      
                    }
                 
                    if ($key['listb'] == 1 ) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Article List' || $page_name == 'Edit Article'  ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>article-list" class="menu-link">
                                <div data-i18n="Article List">Article List</div>
                            </a>
                        </li>
                         <li class="menu-item <?php echo $page_name == 'Comments List'   ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>comment-list" class="menu-link">
                                <div data-i18n="Comments list">Comments list</div>
                            </a>
                        </li>
                        <li class="menu-item <?php echo $page_name == 'Breaking News'   ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>link-list" class="menu-link">
                                <div data-i18n="Breaking News">Breaking News</div>
                            </a>
                        </li>
                    <?php 
                    } else {
                         } ?>
                </ul>
            </li>
            <?php 
            }
      
            if($key['catf'] == 1 || $key['addf'] == 1 ||$key['listf'] == 1 ){
            ?>
            <li class="menu-item <?php echo $page_name == 'Add FAQs' || $page_name == 'FAQs List' || $page_name == 'FAQs Category List' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-question-mark"></i>
                    <div style="margin-left: 10px;" data-i18n="FAQ's">FAQ's</div>
                </a>
                <ul class="menu-sub">
                    <?php
                 
                    if ($key['catf'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'FAQs Category List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>faqcategory-list" class="menu-link">
                                <div data-i18n="FAQ's Category List">FAQ's Category List</div>
                            </a>
                        </li>-->
                        <?php  
                    } else {
                      
                    }
                  
                    if ($key['addf'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add FAQs' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-faqq" class="menu-link">
                                <div data-i18n="Add FAQ's">Add FAQ's</div>
                            </a>
                        </li>
                        <?php
                    } else {
                      
                    }
                  
                    if ($key['listf'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'FAQs List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>faq-list" class="menu-link">
                                <div data-i18n="FAQ's List">FAQ's List</div>
                            </a>
                        </li>
                    <?php
                    } else {
                       } ?>
                </ul>
            </li>
            <?php
             }
    
    
                 if($key['cats'] == 1 || $key['subcats'] == 1 || $key['adds'] == 1 || $key['lists'] == 1){
            ?>
            <li class="menu-item <?php echo $page_name == 'service List' || $page_name == 'Add Category' || $page_name == 'Service Category List' || $page_name == 'Service SubCategory List' || $page_name == 'Add service' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx bx-menu"></i>
                    <div style="margin-left: 10px;" data-i18n="Services">Services</div>
                </a>
                <ul class="menu-sub">
                    <?php
                    if ($key['subcats'] == 1) {
                        ?>
                       <li class="menu-item <?php echo $page_name == 'Service SubCategory List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>service-subcategory-list" class="menu-link">
                                <div data-i18n="Service Category List">Service Category List</div>
                            </a>
                        </li>
                        <?php 
                    } else {
                       
                    }
                  
                    if ($key['adds'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add service' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-service" class="menu-link">
                                <div data-i18n="Add Service">Add Service</div>
                            </a>
                        </li>
                        <?php  
                    } else {
                       
                    }
                  
                    if ($key['lists'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'service List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>service-list" class="menu-link">
                                <div data-i18n="Services List">Services List</div>
                            </a>
                        </li>
                    <?php 
                    } else {
                       } ?>
                </ul>
            </li>

            <?php  
                 }
            
                 if($key['adde'] == 1 || $key['cate'] == 1 || $key['liste'] == 1 ){
            ?>
<!--            <li class="menu-item <?php echo $page_name == 'Event Category List' || $page_name == 'Event List' || $page_name == 'Add Event' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <img class="h-auto"  src="<?php echo base_url(); ?>template/admin_assets/img/sidebaricon/event.png">
                    <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                    <div  style="margin-left: 10px;" data-i18n="Event">Event</div>
                </a>
                <ul class="menu-sub">
                    <?php
                 
                    if ($key['adde'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Event Category List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>eventcategory-list" class="menu-link">
                                <div data-i18n="Event Category">Event Category</div>
                            </a>
                        </li>
                        <?php  
                    } else {
                       
                    }

                  
                    if ($key['cate'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Event' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-event" class="menu-link">
                                <div data-i18n="Add Event">Add Event</div>
                            </a>
                        </li>
                        <?php 
                    } else {
                       
                    }

                  
                    if ($key['liste'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Event List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>event-list" class="menu-link">
                                <div data-i18n="Event List">Event List</div>
                            </a>
                        </li>
                    <?php  
                    } else {
                         } ?>
                </ul>
            </li>-->
            <?php  
             }
   
   

             if($key['addj'] == 1 || $key['catj'] == 1 || $key['listj'] == 1 ){
            ?>
            <li class="menu-item <?php echo $page_name == 'Job Category List' || $page_name == 'Job List' || $page_name == 'Add Job' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <!--<img class="h-auto"  src="<?php echo base_url(); ?>template/admin_assets/img/sidebaricon/job.png">-->
                    <i class="menu-icon tf-icons bx bxs-briefcase"></i>
                    <div  style="margin-left: 10px;" data-i18n="Job">Job</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['addj'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'Job Category List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>jobcategory-list" class="menu-link">
                                <div data-i18n="Job Category">Job Category</div>
                            </a>
                        </li>-->
                        <?php
                    } else {
                       
                    }

                  
                    if ($key['catj'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Job' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-job" class="menu-link">
                                <div data-i18n="Add Job">Add Job</div>
                            </a>
                        </li>

                        <?php
                    } else {
                       
                    }
                     if ($key['listj'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Job List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>job-list" class="menu-link">
                                <div data-i18n="Job List">Job List</div>
                            </a>
                        </li>
                    <?php 
                    } else {
                       } ?>            
                </ul>
            </li>

            <?php 
             }  
           if($key['addt'] == 1 || $key['listt'] == 1 ){
            ?>
            <li class="menu-item <?php echo $page_name == 'Team Category List' || $page_name == 'Team List' || $page_name == 'Add Team' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user-check"></i>
                    <div  style="margin-left: 10px;" data-i18n="Team">Team</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['addt'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Team' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-team" class="menu-link">
                                <div data-i18n="Add Team">Add Team</div>
                            </a>
                        </li>
                        <?php  
                    } else {
                     
                    }

                  
                    if ($key['listt'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Team List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>team_list" class="menu-link">
                                <div data-i18n="Team List">Team List</div>
                            </a>
                        </li>
                          <?php }else{
                          }
                             ?>        
                </ul>
            </li>
            <?php 
               }
                  
   
   
   
             if($key['addn'] == 1  || $key['catn'] == 1  || $key['listn'] == 1  ){
            ?>

            <li class="menu-item <?php echo $page_name == 'News Category List' || $page_name == 'Advertisement List' || $page_name == 'Add Advertisement' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-news"></i>
                    <div  style="margin-left: 10px;" data-i18n="Advertisement">Advertisement</div>
                </a>
                <ul class="menu-sub">
                    <?php
                
                    if ($key['addn'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'News Category List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>newscategory-list" class="menu-link">
                                <div data-i18n="News Category">News Category</div>
                            </a>
                        </li>-->
                        <?php 
                    } else {
                       
                    }

                  
                    if ($key['catn'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Advertisement' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-news" class="menu-link">
                                <div data-i18n="Add Advertisement">Add Advertisement</div>
                            </a>
                        </li>
                        <?php 
                    } else {
                       
                    }

                   
                    if ($key['listn'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Advertisement List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>news-list" class="menu-link">
                                <div data-i18n="Advertisement List">Advertisement List</div>
                            </a>
                        </li>
                    <?php  
                    } else {
                        } ?>           
                </ul>
            </li> 
            <?php 
             }
      
             if($key['addtest'] == 1 || $key['listest'] == 1  ){
            ?>

            <li class="menu-item <?php echo $page_name == 'Add Testimonials' || $page_name == 'Testimonial List' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-comment-dots"></i>
                    <div style="margin-left: 10px;" data-i18n="Testimonials">Testimonials</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['addtest'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Testimonials' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-testimonials" class="menu-link">
                                <div data-i18n="Add Testimonials">Add Testimonials</div>
                            </a>
                        </li>
                        <?php
                    } else {
                       
                    }
                 
                    if ($key['listest'] == 1 ) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Testimonial List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>testimonial_list" class="menu-link">
                                <div data-i18n="Testimonials List">Testimonials List</div>
                            </a>
                        </li>         
                    <?php 
                    } else {
                       } ?>               
                </ul>
            </li>
            <?php 
             }
     

             if($key['addct'] == 1|| $key['listct'] == 1  ){
            ?>
            <li class="menu-item <?php echo $page_name == 'Add Cartoon' || $page_name == 'Clientele Category' || $page_name == 'Cartoon List' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-book-open"></i>
                    <div  style="margin-left: 10px;" data-i18n="Cartoon">Cartoon</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['addct'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Cartoon' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-client" class="menu-link">
                                <div data-i18n="Add Cartoon">Add Cartoon</div>
                            </a>
                        </li>
                        <?php 
                    } else {
                       
                    }
                   
                    if ($key['listct'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Cartoon List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>client-list" class="menu-link">
                                <div data-i18n="Cartoon List">Cartoon List</div>
                            </a>
                        </li>   
                    <?php  
                    } else {
                      } ?>               
                </ul>
            </li>
            <?php  
             }
           if($key['addv'] == 1|| $key['catv'] == 1 ||$key['listv'] == 1 ){
            ?>
            <li class="menu-item <?php echo $page_name == 'Video Category List' || $page_name == 'Add Video' || $page_name == 'Video List' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-video"></i>
                    <div  style="margin-left: 10px;" data-i18n="Video">Video</div>
                </a>
                <ul class="menu-sub">
                    <?php
                  
                    if ($key['addv'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'Video Category List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>videocategory-list" class="menu-link">
                                <div data-i18n="Video Category List">Video Category List</div>
                            </a>
                        </li>-->
                        <?php  
                    } else {
                       
                    }
                  
                    if ($key['catv'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Video' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-video" class="menu-link">
                                <div data-i18n="Add Video">Add Video</div>
                            </a>
                        </li>        
                        <?php 
                    } else {
                       
                    }
                   
                    if ($key['listv'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Video List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>video-list" class="menu-link">
                                <div data-i18n="Video List">Video List</div>
                            </a>
                        </li>  
                    <?php  
                    } else {
                        } ?>     
                </ul>
            </li>
            <?php 
             } 
           if($key['addg'] == 1||$key['catg'] == 1|| $key['listg'] == 1){
            ?>
            <li class="menu-item <?php echo $page_name == 'Add Featured' || $page_name == 'Featured List' || $page_name == 'Add Gallery Category' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-photo-album"></i>
                    <div style="margin-left: 10px;" data-i18n="Featured Listing">Featured Listing</div>
                </a>
                <ul class="menu-sub">
                    <?php
                   
                    if ($key['addg'] == 1) {
                        ?>
<!--                        <li class="menu-item <?php echo $page_name == 'Add Gallery Category' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>gallarycategory-list" class="menu-link">
                                <div data-i18n="Gallery Category">Gallery Category</div>
                            </a>
                        </li>-->
                        <?php 
                    } else {
                       
                    }
                   
                    if ($key['catg'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Add Featured' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-image" class="menu-link">
                                <div data-i18n="Add Featured Listing">Add Featured</div>
                            </a>
                        </li>        
                        <?php 
                    } else {
                       
                    }
                   
                    if ($key['listg'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Featured List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>gallary-list" class="menu-link">
                                <div data-i18n="Featured List">Featured List</div>
                            </a>
                        </li>   
                    <?php 
                    } else {
                        } ?>       
                </ul>
            </li>
            <?php 
             }
       

             if($key['addpd'] == 1 || $key['listpd'] == 1  ){
            ?>
 <li class="menu-item <?php echo $page_name == 'Package Pricing' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="Package Pricing ">Package Pricing </div>
            </a>
            <ul class="menu-sub">
               <?php
                  
                    if ($key['addpd'] == 1) {
                        ?>
                        <li class="menu-item <?php echo $page_name == 'Package Pricing ' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>pdf-add" class="menu-link">
                                <div data-i18n="Package Pricing ">Package Pricing </div>
                            </a>
                        </li>
                        <?php 
                    } else {
                       
                    } ?>
                       
             </ul>
        </li>
           
          
            <?php
             }
   
       
        if ($key['link'] == 1 ) {
            ?>
<!--             <li class="menu-item <?php echo $page_name == 'Add Link' || $page_name == 'Link List' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-link"></i>
                    <div style="margin-left: 10px;" data-i18n="Links">Links</div>
                </a>
                <ul class="menu-sub">
                
                         <li class="menu-item <?php echo $page_name == 'Link List' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>link-list" class="menu-link">
                                <div data-i18n="Link List">Link List</div>
                            </a>
                        </li>
                        
                                 
                </ul>
            </li>-->
            <?php
        }
       
                if ($key['slider'] == 1 ) {
                       ?>
                    <li class="menu-item <?php echo $page_name == 'Public Opinion'  ? 'active open' : ''; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-slider"></i>
                        <div data-i18n="Public Opinion">Public Opinion</div>
                     </a>
                     <ul class="menu-sub">
             
                      <li class="menu-item <?php echo $page_name == 'Public Opinion' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>edit-opinion/<?php echo $value["id"]; ?>" class="menu-link">
                           <div data-i18n="Update">Update</div>
                            </a>
                      </li>
           
                       </ul>
                      </li> 
                       <li class="menu-item <?php echo $page_name == 'Home page Slider'  ? 'active open' : ''; ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-slider"></i>
                        <div data-i18n="Home page Slider">Home page Slider</div>
                     </a>
                     <ul class="menu-sub">
             
                      <li class="menu-item <?php echo $page_name == 'Home page Slider' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>add-event" class="menu-link">
                           <div data-i18n="Update">Update</div>
                            </a>
                      </li>
           
                       </ul>
                      </li> 
                              
               <?php
     }
       if ($key['users'] == 1) {
          
        $tt = $this->common->subside($this->session->userdata('user_id'));
  
        if ($tt->num_rows() > 0) {
        }else{
            ?>
            <li class="menu-item <?php echo $page_name == 'User List' || $page_name == 'Roles' || $page_name == 'Sub Admin List' || $page_name == 'Add Sub Admin' ? 'active open' : ''; ?>">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                    <div data-i18n="Sub Admin">Sub Admin</div>
                </a>
                <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'Roles' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>roles" class="menu-link">
                            <div data-i18n="Roles">Roles</div>
                        </a>
                    </li>
                    <li class="menu-item <?php echo $page_name == 'Add Sub Admin' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>subadmin" class="menu-link">
                            <div data-i18n="Add Sub Admin">Add Sub Admin</div>
                        </a>
                    </li>
                    <li class="menu-item <?php echo $page_name == 'Sub Admin List' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>subadminlist" class="menu-link">
                            <div data-i18n="Sub Admin List">Sub Admin List</div>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } } 
        if ($key['loginhis'] == 1) {
              
         ?>

        <li class="menu-item <?php echo $page_name == 'login History' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Login History">Login History</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'login History' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>loginhistory" class="menu-link">
                        <div data-i18n="Login History">Login History</div>
                    </a>
                </li> 
             </ul>
        </li>
        <?php }
        if ($key['activitylog'] == 1) {
        ?>
        <li class="menu-item <?php echo  $page_name == 'Activity Log' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <!--<img class="h-auto"  src="<?php echo base_url(); ?>template/admin_assets/img/sidebaricon/activity.png">-->
            <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Activity Log">Activity Log</div>
            </a>
            <ul class="menu-sub">
             
                <li class="menu-item <?php echo $page_name == 'Activity Log' ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>activitylog" class="menu-link">
                    <div data-i18n="Activity Log">Activity Logs</div>
                </a>
            </li>       
             </ul>
        </li>
        <?php }
     }
      ?>
       <li class="menu-item <?php echo $page_name == 'ContactENQ' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="Contact Enquiry">Contact Enquiry</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'ContactENQ' ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>contact-enq" class="menu-link">
                        <div data-i18n="Contact Enquiry">Contact Enquiry</div>
                    </a>
                </li> 
                       
             </ul>
        </li>
        <li class="menu-item <?php echo $page_name == 'Subscriber List' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="Subscriber Enquiry">Subscriber Enquiry</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'Subscriber List' ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>subscribe-enq" class="menu-link">
                        <div data-i18n="Subscriber Enquiry">Subscriber Enquiry </div>
                    </a>
                </li> 
                       
             </ul>
        </li>
        <li class="menu-item <?php echo $page_name == 'Paid Subscriptions' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="Paid Subscriptions">Paid Subscriptions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'Paid Subscriptions' ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>paidsub-list" class="menu-link">
                        <div data-i18n="Paid Subscriptions">Paid Subscriptions</div>
                    </a>
                </li> 
                       
             </ul>
        </li>
        <li class="menu-item <?php echo $page_name == 'Complaint List' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="Complain List">Complain List</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'Complaint List' ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>complaint-list" class="menu-link">
                        <div data-i18n="Complain List">Complain List</div>
                    </a>
                </li> 
                       
             </ul>
        </li>
         <li class="menu-item <?php echo $page_name == 'Users List' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-search-alt-2"></i>
             <div style="margin-left: 10px;" data-i18n="User List">User List</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php echo $page_name == 'Users List' ? 'active' : ''; ?>">
                     <a href="<?php echo base_url(); ?>user-list" class="menu-link">
                        <div data-i18n="User List">User List</div>
                    </a>
                </li> 
                       
             </ul>
        </li>

     <?php    $tt = $this->common->subside($this->session->userdata('user_id'));
  
  if ($tt->num_rows() > 0) { 
  }else{?>
        <li class="menu-item <?php echo $page_name =='addstatic' || $page_name =='Settings' || $page_name =='Website Settings' || $page_name == 'Staticpagelist' ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
           <i class="menu-icon tf-icons bx bx-cog"></i>
             <div style="margin-left: 10px;" data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
                 <li class="menu-item <?php echo $page_name == 'Website Settings' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>website-set" class="menu-link">
                        <div data-i18n="Website Settings">Website Settings</div>
                    </a>
                </li> <li class="menu-item <?php echo $page_name == 'Settings' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>settings" class="menu-link">
                        <div data-i18n="Admin Panel Settings">Admin Panel Settings</div>
                    </a>
                </li>
                
                <li class="menu-item <?php echo $page_name == 'addstatic' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>static-add" class="menu-link">
                        <div data-i18n="Static Page Add Seo">Static Page Add Seo</div>
                    </a>
                </li>
                <li class="menu-item <?php echo $page_name == 'Staticpagelist' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>static-list" class="menu-link">
                        <div data-i18n="Static Page Seo List">Static Page Seo List</div>
                    </a>
                </li>        
             </ul>
        </li>
        <?php }?>
    </ul>
</aside>