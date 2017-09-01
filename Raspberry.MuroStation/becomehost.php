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

 <header id="top-header" class="top-header section-bg banner-v2">
        <div class="verticle-center">
            <div class="container">
                <div class="row">
                    <div class="display-flex">
                        <div class="col-md-10 col-md-offset-1 text-center">
                            <a class="logos" href="#"><img src="<?php echo core::config('general.base_url')."themes/tenv_default/"; ?>assets/img/dark_logo_transparent_background_small.png" alt="..."></a>
                            <h1><b>Become Table EN Ville Host</b></h1>
                            <p>Another world is waiting to see your Talent. Let's Get Started</p>
                            <div class="device-download">
                                <div> <a class="btn btn-orange" data-toggle="modal" data-dismiss="modal" href="http://tableenville.com/oc-panel/auth/register/host" data-original-title="" title="">
                                      <?=_e('Become a host now')?>
                                 </a>
                        
                                 </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<div id="intro-area" class="section section-padding-extra">
            <div class="container">
                <div class="row">
                    <div class="intros">
                        <div class="col-sm-4">
                            <div class="intro text-center wow  fadeInUp animated" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-paint-brush"></i></span>
                                <h4 class="intro-heading">Join our global host community</h4>
                                <p>Located in Belgium, our diverse host community is passionate about local foods and meeting new people for social eating.</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="intro text-center wow  fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-angellist"></i></span>
                                <h4 class="intro-heading">Share your Proud Dishes</h4>
                                <p>Create delicious food events (dinner, cooking classes, food tours…) to share with guests from all over the world. Get creative with your food event!</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="intro text-center wow  fadeInUp animated" data-wow-delay="1s" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-support"></i></span>
                                <h4 class="intro-heading">Earn income doing what you love</h4>
                                <p>Earn extra income hosting culinary experiences and accept guest requests to eat local, all on your own schedule and terms.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="howitworks" class="section section-padding-extra" style="background:#dfdfdf;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <div class="section-heading">
                            <h2 class="section-title">How does it work?</h2>
                            <p class="section-subtitle">This is a three step simple registration process.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="introsd">
                        <div class="col-sm-4">
                            <div class="intros text-center wow  fadeInUp animated" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-paint-brush"></i></span>
                                <h4 class="intro-heading">Register Your self on website. </h4>
                                <p>Be creative and let your personality and originality shine! Submit your food events on the website.</p>
                                 
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="intros text-center wow  fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.5s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-angellist"></i></span>
                                <h4 class="intro-heading">Send request to become host </h4>
                                <p>Please fill a form after click the Become a Host button and submit to our verification center. One of our executive either will vist the place or will call you to verify some detials.</p>
                                <p class="text-center">
                                <?php if (Auth::instance()->logged_in()){?>
                                       <a class="btn btn-orange" href="<?=Route::url('oc-panel',array('controller'=>'profile','action'=>'edit'))?>">
                                             <i class="glyphicon glyphicon-lock"></i> <?=_e('Submit Request')?>
                                        </a>
                                  <?php }else{?>
                                <a class="btn btn-orange" data-toggle="modal" data-dismiss="modal" href="http://tableenville.com/oc-panel/auth/register/host" data-original-title="" title="">
                                      <?=_e('Become a host now')?>
                                 </a>
                                <?php } ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="intros text-center wow  fadeInUp animated" data-wow-delay="1s" data-wow-duration="1.5s" style="visibility: visible; animation-duration: 1.5s; animation-delay: 1s; animation-name: fadeInUp;">
                                <span class="intro-icon"><i class="fa fa-support"></i></span>
                                <h4 class="intro-heading">After Verification </h4>
                                <p>On successfull verification we will activate your profile as host and you can use our services.</p>
                            </div>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>