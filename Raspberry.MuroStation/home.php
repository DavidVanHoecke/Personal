<?php defined('SYSPATH') or die('No direct script access.');?>
<style>
    .container.fulwidth{
        
        width:100% !important;
    }
    .navbar-fixed-tops{  
        z-index: 1000;
   /* background-color: transparent !important;*/
    border: none !important;
    }
        

</style>
<style type="text/css">
    .section-title h2 {
  display: inline-block;
  font-size: 30px;
  font-weight: 300;
  line-height: 30px;
  margin-bottom: 40px;
  padding-bottom: 10px;
  position: relative;
  text-transform: uppercase;
}
.section-title h2:before {
	position: absolute;
	background: #575757;
	height: 2px;
	width: 45px;
	content: "";
	bottom: 0;
}
.portfolio-menu button.mixitup-control-active {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: 2px solid #4bcaff;
      color: #4bcaff;
      padding: 10px 15px;
    font-weight: 700;
    transition: .4s;
    text-transform: uppercase;
}
.portfolio-menu button {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: 2px solid transparent;
      color: #515f67;
      padding: 10px 15px;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
}
.single-portfolio a {
  display: block;
  line-height: 0;
  position: relative;
    background: #000 none repeat scroll 0 0;
}
.single-portfolio a::before {
  background: #000 none repeat scroll 0 0;
  content: "";
  height: 100%;
  opacity: 0;
  position: absolute;
  top: 0;
  transform: scale(0.5);
  transition: all 0.3s ease 0s;
  width: 100%;
    
}
.single-portfolio:hover a::before {
	opacity: .5;
	transform: scale(1);
}
.single-portfolio a::after {
 color: #fff;
  content: "";
  font-size: 60px;
  left: 0;
  position: absolute;
  right: 0;
  text-align: center;
  top: 50%;
  transform: scale(0);
  transition: all 0.3s ease 0s;
    
}
.single-portfolio:hover a::after {
	transform: scale(1);
}
.col-md-4.mix{
padding:2px;

}
    .mbr-gallery-title {
    font-size: 18px;
        background: rgba(6, 6, 6, 0.37);
    position: absolute;
    display: block;
       
    width: 100%;
    top: 50%;
    text-align: center;
    padding: 1rem;
    color: #fff;
        font-weight: bold;
        padding:20px;
}


/* Add padding to container elements */

.container_model {
    padding: 25px;
}

/* The Modal (background) */
.modal_model {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content_model {
    background-color: #fefefe;
    margin: 10% auto 15% auto;
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close_model {
    position: absolute;
    right: 35px;
    top: 75px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
}

.close_model:hover,
.close_model:focus {
    color: red;
    cursor: pointer;
}




    </style>


<header id="top-header" class="top-header section-bg banner-v2" style=" background:url(<?php echo core::config('general.base_url')."themes/tenv_default/"; ?>img/bg-6.jpeg) no-repeat center ; background-size: cover;">

 
        <div class="verticle-center" style="margint-top:10px">
            <div class="container-fluid" style="background:rgba(242, 241, 242, 0.23);">
                   
                <div class="row">
                    <div class="display-flex">
                        <div class="col-md-6  text-center">
                            <a class="logos img-responsive" href="#"><img src="<?php echo core::config('general.base_url')."themes/tenv_default/"; ?>img/translogo2.png" alt="..."></a>
                          
                        
                        </div>
                         <div class="col-md-6  text-center pull-right">
                          
                           <a href="http://tableenville.com/search.html?submit=" type="button" class="btn btn-orange btn-lg" style="font-size:20px;">Book Your Table</a>
                        
                        </div>
                    </div>
                </div>
          
            
            </div>
            <div class="container">
                <div class="row">
                    <div class="display-flex">
                        <div class="col-md-10 col-md-offset-1 text-center">
                            
                            <h1 style="color:#f6f7f9;">Social Dining Experience for The Expats Community</h1>
                           
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<div style="border:none; margin-top:15px;">
<div class="container">
<div class="row">
    <?=View::factory('pages/ad/home_search',array('ads'		      => $ads, 
        	'categories'	      => Model_Category::get_as_array(),
        																		   'order_categories' => Model_Category::get_multidimensional(),
        																		   'locations'	      => Model_Location::get_as_array(), 
        																		   'order_locations'  => Model_Location::get_multidimensional(),
        																		   'pagination'	      => NULL, 
        																		   'user'		      => NULL,
        																		   'fields' 		  => Model_Field::get_all(),
																				   'total_ads' 		  => "20"
        																		   ))?>
    
    </div>

</div>
</div>

<div class="section section-padding-extra" style="padding-top:5px;">
    <div style="background:#e57200; margin-bottom:70px;">
    <div class="container" >
    <div class="row">
        <div class="text-center" style="padding-bottom:20px;">
           
        <div class="section-heading" style="margin-bottom:20px;">
                            <h2 class="section-titles" style="font-size:40px; color:#fff; font-weight:bold;">A new way of meeting & eating with expats in Brussels</h2>
                            <p class="section-subtitle" style="font-size:25px;color:#fff;">Table en Ville offers expats an unforgettable dining experience at the host’s table.<br />
                                We connect expats living in Brussels to share a meal in great company at the host’s home. <br />
                                People like you who love to share their stories of living and passion for food at the dining table.</p>
        </div>
            <a type="button" class="btn btn-default btn-lg" style="font-size:20px;" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Join Us</a>

<div id="id01" class="modal_model">
  <span onclick="document.getElementById('id01').style.display='none'" class="close_model" title="Close Modal">×</span>
  <form class="modal-content_model animate" action="/action_page.php">
    <div class="container_model">
       <h2 style="font-size: 24px;">Be the First to Know</h2>
      <label style="color:#000;" margin:10px >Find out more on social dining experience in Brussels</label>
      <input type="text" class="form-control" style="height:46px;margin-bottom:10px"  placeholder="Email Address" name="email" required>
<div class="clearfix">
 
  <button type="submit" class="btn btn-primary btn-lg btn-block" style="margin-bottom:10px;background-color:#e57200;border-color: #e57200;">GET NOTIFIED </button>
    <label style="color:#e57200;">We value privacy, and will never spam you. You can one-click unsubscribe at any time.</label>

      </div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal_model) {
        modal.style.display = "none";
    }
}
</script>





        </div>
        
    </div>
</div>
        
        
    </div>
    <div class="container">
        
    <div id="container" class="row">
		<div class="col-md-4 mix category-a">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#">
                    <img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis3.jpg" alt="One" />
            <span class="mbr-gallery-title"  >Social Dining Out For Expats
</span>
            </a>
			</div>
		</div>
		<div class="col-md-4 mix category-b">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#"><img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis6.jpg" alt="One" />
                <span class="mbr-gallery-title"  >Fun Time With New Friends</span>
                </a>
			</div>
		</div>
		<div class="col-md-4 mix category-c">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#"><img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis2.jpg" alt="One" />
                <span class="mbr-gallery-title" >Share A Table With New People</span>
                </a>
			</div>
		</div>
		<div class="col-md-4 mix category-d">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#"><img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis5.jpg" alt="One" /><span class="mbr-gallery-title" >Enjoy life With Good Food</span></a>
			</div>
		</div>
		<div class="col-md-4 mix category-a">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#"><img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis1.jpg" alt="One" /><span class="mbr-gallery-title">Meet Passionate Hosts</span></a>
			</div>
		</div>
		<div class="col-md-4 mix category-b">
		    <div class="single-portfolio">
				<a class="gallery-item" href="#"><img class="img-responsive" src="http://tableenville.com/themes/tenv_default/img/cuis4.jpg" alt="One" /><span class="mbr-gallery-title" >Explore A Global Food Culture</span></a>
			</div>
		</div>
	</div>
</div>
</div>

<div class="section section-padding-extra" style="padding:50px; background:#eee">
    <div class="container">
             <div class="row">
               <div class="text-center">
                  <div class="section-heading">
                            <h2 class="section-titles">How it works?</h2>
                            <p class="section-subtitle">&nbsp;</p>
                </div>
                 
                 </div>
               
            </div>
        
        <div class="row equal-height">

      <center>

        <div class="col-sm-4">
             
              <div class="text-center reviewer-mock" style="background:#fff">
             <img class="img-responsives " src="http://tableenville.com/themes/tenv_default/img/tablet.png" style="padding-top:40px;"  alt="One" />
             </div>
             <div class="text-center" >
              <h2>Discover your table</h2>
              <p>Choose your favorite cuisine and discover the culinary heritage of our hosts from around the world. </p>
               </div>
               
           
            
        </div>
        
          <div class="col-sm-4">
          
           <div class="text-center reviewer-mock" style="background:#fff">
             
             <img class="img-responsives " src="http://tableenville.com/themes/tenv_default/img/tablet.png" alt="One" style="padding-top:40px;" />
            
            
            </div>
            <div class="text-center" >
               <h2>Book your table </h2>
           <p>Invite friends  and dine at the host’s home. Our passionate hosts welcome you to make your table experience unique.</p>
               
               
          
            
        </div>  
</div>
            <div class="col-sm-4" >
           
            <div class="text-center reviewer-mock" style="background:#fff">
             
             <img class="img-responsives " src="http://tableenville.com/themes/tenv_default/img/tablet.png" style="padding-top:40px;"  alt="One" />
             </div>
            <div class="text-center">
               <h2>Share your table</h2>
           <p>Meet new people and share a table in great company.
           </p>
               
               
          
           </div>
            
        </div>
            
        </div>
        
        </div>
    
    </div>

<div id="modalAllCategories" class="modal fade" tabindex="-1" data-apiurl="<?=Route::url('api', array('version'=>'v1', 'format'=>'json', 'controller'=>'categories'))?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                </div>
            </div>
        </div>
    </div>
</div>
<?if(core::config('general.auto_locate') AND ! Cookie::get('user_location') AND Core::is_HTTPS()):?>
    <input type="hidden" name="auto_locate" value="<?=core::config('general.auto_locate')?>">
    <?if(count($auto_locats) > 0):?>
        <div class="modal fade" id="auto-locations" tabindex="-1" role="dialog" aria-labelledby="autoLocations" aria-hidden="true">
            <div class="modal-dialog	modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 id="autoLocations" class="modal-title text-center"><?=_e('Please choose your closest location')?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="list-group">
                            <?foreach($auto_locats as $loc):?>
                                <a href="<?=Route::url('default')?>" class="list-group-item" data-id="<?=$loc->id_location?>"><span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span> <?=$loc->name?> (<?=i18n::format_measurement($loc->distance)?>)</a>
                            <?endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?endif?>
<?endif?>