<?php
  if ( !is_user_logged_in() ):

      wp_login_form();


  else:


?>












<?php

add_action( 'wp_head', 'load_javascript_library' );
function load_javascript_library(){
  wp_enqueue_script( '', CHILDURL . 'jquery.cycle.all.js' );  
}
wp_head();
?>

<div class="container sliderWraper row-fluid" style="height:320px;  overflow:hidden;">


  <?php

$defaults = array(
  'theme_location'  => '',
  'menu'            => '',
  'container'       => 'div',
  'container_class' => 'yyyyy',
  'container_id'    => '',
  'menu_class'      => 'menu ssss',
  'menu_id'         => '',
  'echo'            => true,
  'fallback_cb'     => 'wp_page_menu',
  'before'          => '',
  'after'           => '',
  'link_before'     => '',
  'link_after'      => '',
  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
  'depth'           => 0,
  'walker'          => ''
);

wp_nav_menu( $defaults );


?>


  <div id="navSlide" style=""></div>
  <!--<img src="<?php echo CHILDURL.'asset'; ?>/playback-prev.png" style="position:absolute; z-index:100; margin-top:120px; width:40px;" />
  <img src="<?php echo CHILDURL.'asset'; ?>/playback-next.png" class="navbar-right" style="position:absolute; z-index:100; width:40px; margin-left:940px; margin-top:120px;" />  -->


<?php 
      //create limit object
  $limit = ___limit();
  $limit->criteria = 100; //limit to 60 words
  $limit->image = true; //do not show images inside the trimmed content
  $limit->shortcode = false; //do not render shortcodes when trimming

  //create the loop object
  $loop = ___loop();
  $loop->header = array();
  $loop->footer = '';
  $loop->content = $limit; //set content to limit object
  $loop->paged = '';
  $loop->args = array('post_type' => 'sliders', 'posts_per_page' => 6, 'post_status' => 'publish');
  //render the loop object
  ___render(___object('Content_Loop'), $loop); 
?>
  
  
</div>

<div class="container">

  <div class="row" style="border:solid 2px #357EBD; padding:10px; text-align:justify;">
      <div class="col-sm-18" >
  

        <?php 
          //create limit object
          $limit = ___limit();
          $limit->criteria = 120; //limit to 60 words
          $limit->image = true; //do not show images inside the trimmed content
          $limit->shortcode = false; //do not render shortcodes when trimming

          //create the loop object
          $loop = ___loop();
          $loop->header = array();
          $loop->footer = '';
          $loop->content = $limit; //set content to limit object
          $loop->paged = '';
          $loop->args = array('post_type' => 'post', 'category_name' => 'services',  'posts_per_page' => 3, 'post_status' => 'publish');
          //render the loop object
          ___render(___object('Content_Loop'), $loop); 
        ?>
        <a role="button" href="#" class="btn btn-primary navbar-right">Learn More »</a>
      
    
    </div>

    <div role="navigation"  id="sidebar" class="col-sm-5 sidebar-offcanvas navbar-right" >
          <div class="list-group" >
            <a style="background:#357EBD;" class="servicesBox list-group-item" href="#">Automobile / Aérospatial » </a>
            <a style="background:#357EBD;" class="servicesBox list-group-item" href="#">High-Tech - R&D »</a>
            <a style="background:#357EBD;" class="servicesBox list-group-item" href="#">Génie Civil »</a>
            <a style="background:#357EBD;" class="servicesBox list-group-item" href="#">Automobile » </a>
          </div>
    </div>

  </div>
  <div class="row">&nbsp;</div>
</div>



<div class="container">
	
  
   <div class="row" style="">
      
        <div class="col-lg-4 servicesBox" style="background:#357EBD;">
          <br/>
          Formage » 
          <br/><br/>
        </div>
        <div class="col-lg-1 ">&nbsp;</div>
       <div class="col-lg-4 servicesBox" style="background:#357EBD;">
          <br/>
          Biomédical »
          <br/><br/>
        </div>
        <div class="col-lg-1">&nbsp;</div>
        <div class="col-lg-4 servicesBox" style="background:#357EBD;">
        <br/>
          Nucléaire » 
          <br/><br/>
        </div>
        <div class="col-lg-1">&nbsp;</div>
       
       <div class="col-lg-9" style="text-align:justify; background:#DDD9C3; border:solid 2px #357EBD; padding:5px; padding-bottom:3px;">
           
          <a>NEWS » Sortie ADINA Version 9.0</a>
          <img src="<?php echo CHILDURL; ?>/news.jpg" align="left" width="70"  style="margin-right:10px;" />
          <p>Nouveau moteur graphique, plus rapide plus de fonctionalité et encore plus conviviale »</p>
          
        </div>
      </div>
      <div class="row">&nbsp;</div>
      <div class="row">&nbsp;</div>
      

</div>


<?php endif; ?>