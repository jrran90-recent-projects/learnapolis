@if ( Auth::check() )
    {{ Redirect::to('user') }}
@else

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>

    <title>Learnapolis</title>

    <!-- Responsive Metatag -->    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="content description">

   
    <!-- Stylesheet
    ===================================================================================================  -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" media="screen">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" media="screen">

    <!-- Media-Queties -->
    <link rel="stylesheet" href="{{ URL::asset('css/media-queries.css') }}" media="screen">

    <!-- Font icons -->
    <link rel="stylesheet" href="{{ URL::asset('font/fontello.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.css') }}">

    <!--[if IE 7]>
    <link href="font/fontello-ie7.css" rel="stylesheet" ><![endif]-->

   <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
   <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>        
   <![endif]-->

   <!-- Media queries -->
   <!--[if lt IE 9]>
   <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
   <![endif]-->
   <script src="{{ URL::asset('js/modernizr.custom.js') }}"></script>

  </head>


<body>
    <!--Header -->
    <header class="navbar-fixed-top animated fadeInDown delay1">
    <div class="container">
            <div class="row">         
            <!-- Static navbar -->
            <div class="navbar navbar-default">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            
            <h1 class="logo">
            <a class="navbar-brand" href="{{ URL::to('/') }}">
              <img src="{{ URL::asset('img/logo.png') }}" alt="Logo" style="width:200px">
            </a>
            </h1> 
            
            </div>
            <div class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
            <li><a href="#menu-jumbotron"><span class="icon-home"></span> Home</a></li>
            <li><a href="#menu-features">Features</a></li>
            <li><a href="#menu-information">Information</a></li>
            <li><a href="{{ URL::to('register') }}" class="external">Sign Up</a></li>
            <li><a href="{{ URL::to('login') }}" class="external">Login</a></li>
            </ul>
            </div><!--/.nav-collapse -->
            </div>
            <!-- end Static navbar -->  
            
            </div>
      </div>
      <!-- end container -->  
       
    </header>
    <!-- end Header -->


  <!-- slider -->
    <section class="jumbotron animated fadeInUp delay2" id="menu-jumbotron">
    <div class="container"> 
      <div class="row">
        <div class="col-md-6 col-lg-6" style="background:rgba(240,102,57,.4);padding:25px 30px">
          <h1>Education = success!</h1>
          <h2>Do you want to demonstrate your skills to the world?</h2>
          <p>Bring your education into life and get success by presenting you educational background for an international network of students, professors and professionals. Want more than that? We offer you free online courses and the opportunity to develop your carrier even further.</p>

          <form class="suscribe" role="form" method="POST" action="{{ URL::route('register-post') }}">

            <div class="form-group" style="overflow:hidden">
              <input class="form-control" type="text" name="firstname" style="width:47%; float:left;  margin-bottom:0" placeholder="First Name" required>
              <input class="form-control" type="text" name="lastname" style="width:47%; float:right; margin-bottom:0" placeholder="Last Name" required>
            </div>

            <div class="form-group">
              <input class="form-control" type="email" placeholder="Your E-mail" name="email" required>
            </div>
            <div class="form-group">
              <input class="form-control" type="password" placeholder="Your Password" name="password" required>
            </div>
            <div class="form-group" style="overflow:hidden">
              <div class="pull-left">
                <input type="checkbox" class="pull-left" style="margin:5px" id="terms" name="cb_tos" required>
                <label for="terms" style="margin:0;width:310px; font-size:0.7em; font-weight: normal; line-height:normal">
                  You agree to our <a href="#modal_tos" data-toggle="modal">Terms of Service</a> and our <a href="#modal_policy" data-toggle="modal">Privacy Policy</a>
                </label>
              </div>
              <button type="submit" class="btn text-center pull-right" style="margin:0">Sign Up Now!</button>
            </div>
            
          </form>

        </div>
        <div class="col-md-6 col-lg-6">
          <img src="{{ URL::asset('img/big-image.png') }}" alt="image" class="figure">
        </div>
      </div>   
    </div>
    </section>
    <!-- end slider -->


    {{-- TOS --}}
    <div class="modal fade" id="modal_tos" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Terms of Service</h4>
          </div>
          <div class="modal-body">
            <h4>1. Terms</h4>
            <p>
              By accessing this web site, you are agreeing to be bound by these 
              web site Terms and Conditions of Use, all applicable laws and regulations, 
              and agree that you are responsible for compliance with any applicable local 
              laws. If you do not agree with any of these terms, you are prohibited from 
              using or accessing this site. The materials contained in this web site are 
              protected by applicable copyright and trade mark law.
            </p><br>

            <h4>2. Use License</h4>
            <ol>
              <li>
                <p>
                Permission is granted to temporarily download one copy of the materials 
                (information or software) on Learnapolis's web site for personal, 
                non-commercial transitory viewing only. This is the grant of a license, 
                not a transfer of title, and under this license you may not:</p>
                <br>                
                <ol type="i">
                  <li><p>modify or copy the materials;</p></li>
                  <li><p>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</p></li>
                  <li><p>attempt to decompile or reverse engineer any software contained on Learnapolis's web site;</p></li>
                  <li><p>remove any copyright or other proprietary notations from the materials; or</p></li>
                  <li><p>transfer the materials to another person or "mirror" the materials on any other server.</p></li>
                </ol>
              </li>
              <li><p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Learnapolis at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.</p></li>
            </ol>

            <h4>3. Disclaimer</h4>
            <ol>
              <li><p>The materials on Learnapolis's web site are provided "as is". Learnapolis makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Learnapolis does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</p></li>
            </ol>
            <br>

            <h4>4. Limitations</h4>
            <p>In no event shall Learnapolis or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Learnapolis's Internet site, even if Learnapolis or a Learnapolis authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
            <br>

            <h4>5. Revisions and Errata</h4>
            <p>The materials appearing on Learnapolis's web site could include technical, typographical, or photographic errors. Learnapolis does not warrant that any of the materials on its web site are accurate, complete, or current. Learnapolis may make changes to the materials contained on its web site at any time without notice. Learnapolis does not, however, make any commitment to update the materials.</p>
            <br>

            <h4>6. Links</h4>
            <p>Learnapolis has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Learnapolis of the site. Use of any such linked web site is at the user's own risk.</p>
            <br>

            <h4>7. Site Terms of Use Modifications</h4>
            <p>Learnapolis may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>
            <br>

            <h4>8. Governing Law</h4>
            <p>Any claim relating to Learnapolis's web site shall be governed by the laws of the State of Denmark without regard to its conflict of law provisions.</p>
            <p>General Terms and Conditions applicable to Use of a Web Site.</p>
          </div>
          <!-- <div class="modal-footer"></div> -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{-- Privacy Policy --}}
    <div class="modal fade" id="modal_policy" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Privacy Policy</h4>
          </div>
          <div class="modal-body">
            <p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>
            <br>

            <ol>
              <li><p>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</p></li>
              <li><p>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.</p></li>
              <li><p>We will only retain personal information as long as necessary for the fulfillment of those purposes.</p></li>
              <li><p>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned.</p></li>
              <li><p>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date.</p></li>
              <li><p>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</p></li>
              <li><p>We will make readily available to customers information about our policies and practices relating to the management of personal information.</p></li>
            </ol>
            <br>
            <p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained.</p>         
          </div>
          <!-- <div class="modal-footer"></div> -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    


   <!-- Courses -->
   <section id="menu-features" class="generic features animated fadeInUp delay3">
      <div class="container">

         <!-- title -->
         <div class="row text-center title">
           <h1>Learnapolis – the portal into your future career.</h1>
           <!-- <h2>Get free online courses absolutely for <strong>FREE</strong></h2> -->
         </div>
         <!-- end title -->

         <!-- items -->
         <div class="row">

            <div class="col-md-3 text-center item">
               <i class="fa fa-group" style="width:132px"></i>
               <h3>Networking</h3>
               <p>Only new acquaintances will take your career into new heights. Students, professors and professionals from all over the world are here to <strong>HELP YOU</strong> extending your network.</p>
            </div>

            <div class="col-md-3 text-center item">
               <i class="fa fa-comments-o" style="width:132px"></i>
               <h3>Interaction</h3>
               <p>Communication is the key for success! Not only will you <strong>COMMUNICATE</strong> you skills to the network you will also be able to <strong>INTERACT</strong> with other teachers, students and future employees.</p>
            </div>

            <div class="col-md-3 text-center item">
               <i class="fa fa-bar-chart-o" style="width:132px"></i>
               <h3>Numbers</h3>
               <p>Statistics are facts that create an overview for <strong>YOU</strong> and your <strong>NETWORK</strong>. Demonstrate your results in numbers and be able to improve by joining our <strong>FREE</strong> online courses.</p>
            </div>

            <div class="col-md-3 text-center item">
               <i class="icon-tools"></i>
               <h3>Tools</h3>
               <p>Learnapolis will provide you with all the instruments to succeed. Online tools will help you learn <strong>EASIER</strong> and <strong>FASTER</strong>.</p>
            </div>

         </div>
         <!-- end items -->
          <div class="row">
            <div class="col-xs-12 vertical_line text-center">
              <a href="{{ URL::to('register') }}" class="external btn scroll_btn">Sign up now!</a>    
            </div>                    
          </div>
      </div>     
   </section>
   <!-- end Features -->




  <!-- Information -->
  <section id="menu-information" class="generic info" style="margin-top:-90px">
        <div class="container">
        
           <!-- title -->
           <div class="row text-center title">
              <h1>Get all the information</h1>
              <h2>The information here will help you find out what you need to know to help you make good decisions for the right reasons.</h2>
           </div>
           <!-- end title -->

           <div class="row infoitem">
                <div class="col-md-6">
                  <a class="example-image-link" href="img/information/info-01.jpg" data-lightbox="example-set" title="Networking">
                    <img src="{{ URL::asset('img/information/info-01.jpg') }}" alt="networking">
                  </a>
                </div>
                <div class="col-md-6">
                  <h2>Networking</h2>
                    <h3><!-- Learnapolis gives you the ability to network with friends and students already in your class, but also to seek out new friends, other teachers to help you and to network with potential future employees. All in a way where you choose how to present yourself best. --></h3>
                    <p>Learnapolis gives you the ability to network with friends and students already in your class, but also to seek out new friends, other teachers to help you and to network with potential future employees. All in a way where you choose how to present yourself best. On average 1/3 of all jobs are never advertised, they are simply given to people who the employer knows already. That is why it is important to actively pursue networking.</p>
                    <!-- <a href="#" class="btn btn-default">Read more</a> -->
                </div>
           </div>
 
            <div class="row infoitem">
                <div class="col-md-6">
                  <h2>Learn and play at the same time</h2>
                    <p>Who says that learning can’t be fun? With a great online learning platform it can be! Learnapolis not only lets you learn in new innovative ways, but it also strives to make learning easier and more fun. Gamification is a way of using games and game mechanisms in a learning content, thus making learning fun and interactive. You want to play games and learn at the same time? Great, just sign up and get started.</p>
                    <!-- <a href="#" class="btn btn-default">Read more</a> -->
                </div>
                <div class="col-md-6">
                  <a class="example-image-link" href="img/information/info-02.jpg" data-lightbox="example-set" title="Learn and play at the same time">
                    <img src="{{ URL::asset('img/information/info-02.jpg') }}" alt="image">
                  </a>
                </div>
           </div>
           
            <div class="row infoitem">
                <div class="col-md-6">
                  <a class="example-image-link" href="img/information/info-03.jpg" data-lightbox="example-set" title="Time to learn">
                    <img src="{{ URL::asset('img/information/info-03.jpg') }}" alt="image">
                  </a>
                </div>
                <div class="col-md-6">
                  <h2>Time to learn</h2>
                    <p>With online learning you decide when to learn. This allows you flexibility to have a job at the same time, to attend to family matters and friends when they need you, and to study in a more time efficient manner. Learnapolis is primarily an add-on learning support function to those who are already studying at a physical university, but it may also be used by those who simply wish to leverage their current careers and to develop new tools and learn new things.
Time is the most precious thing we have, and learning new things is what brings us the most new value, so be sure to use your time best and learn new things – education is a lifelong experience!</p> 
                   <!-- <a href="#" class="btn btn-default">Read more</a> -->
                </div>
           </div>          

      </div>
  </section>  
  <!-- end Information -->



 
    
  <!-- Footer -->
  <footer>
      <div class="container">
            <div class="row copy">
              <div class="col-sm-6">
                  <h6>Learnapolis &copy; 2014</h6>
              </div>
              <div class="col-sm-6">
                <ul>
                  <li><a href="#"><i class="icon-twitter"></i></a></li>
                  <li><a href="#"><i class="icon-facebook"></i></a></li>
                  <!-- <li><a href="#"><i class="icon-dribbble"></i></a></li>
                  <li><a href="#"><i class="icon-vimeo"></i></a></li>
                  <li><a href="#"><i class="icon-behance"></i></a></li> -->
                </ul>
              </div>
            </div>
            
        </div>
    </footer>   
    <!-- end Footer --> 
    
    
    
    
  <a href="#" class="scrollup"><i class="icon-up-open"></i></a>      

    
  <!-- ======================= JQuery libs =========================== -->
    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-1.9.1.min.js') }}"></script>
    
    <!-- Respond.j media queries for IE8 -->
    <script src="{{ URL::asset('js/respond.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Img Gallery Touch -->
    <script src="{{ URL::asset('js/toucheffects.js') }}"></script>

    <!-- Lightbox -->
    <script src="{{ URL::asset('js/lightbox-2.6.min.js') }}"></script>

    <!-- Grid Wall -->
    <script src="{{ URL::asset('js/modernizr.custom.26633.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.gridrotator.js') }}"></script>

    <!--Scroll To-->         
    <script src="{{ URL::asset('js/nav/jquery.scrollTo.js') }}"></script> 
    <script src="{{ URL::asset('js/nav/jquery.nav.js') }}"></script> 

    <!-- Responsive Video -->
    <script src="{{ URL::asset('js/jquery.fitvids.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.placeholder.min.js') }}"></script>

  <!-- T -->
  <!-- <script src="twitter/jquery.tweet.min.js"></script> -->

    <!--Retina Support-->
    <script src="{{ URL::asset('js/retina/retina.js') }}" ></script>

    <!-- Custom -->
    <script src="{{ URL::asset('js/script.js') }}"></script>

  <!-- ======================= End JQuery libs ======================= -->


</body>
</html>

@endif