<?php
	date_default_timezone_set('America/New_York'); 
	if ( ! empty ($_POST)) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	
		$r = new housing();	
		$ResEmail = $r->SaveJoinEvent($_POST["name"], $_POST["email"], 'Contact Window -', $_POST["message"]);
		header("Location: /thanks");
		exit();
	}

	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	// include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
?>
   
    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center single-col-max-width">
			    <h2 class="heading">Contact</h2>
			    <div class="intro">
			    <p>Please fill the contact form below or send me an email to <a href="mailto:theo@640rsd.new-york.ny.us">theo@640rsd.new-york.ny.us</a></p>
			    <p>Want to get connected? Follow us on the social media below.</p>
			    <ul class="list-inline mb-0">
		            <li class="list-inline-item mb-3"><a class="twitter" href="https://twitter.com/BooksShow"><i class="fab fa-twitter fa-fw fa-lg"></i></a></li>
                <li class="list-inline-item mb-3"><a class="facebook" href="https://www.facebook.com/ShowTheBooks"><i class="fab fa-facebook-f fa-fw fa-lg"></i></a></li>
	                
	                
	            </ul><!--//social-list-->
			    
			</div><!--//container-->
	    </section>
	    <section class="contact-section px-3 py-5 p-md-5">
		    <div class="container">
			    <form id="contact-form" class="contact-form col-lg-8 mx-lg-auto" method="post" action="">
			        <h3 class="text-center mb-3">Get In Touch</h3>
			        <div class="form-row">                                                           
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cname">Name</label>
		                    <input type="text" class="form-control" id="cname" name="name" placeholder="Name" minlength="2" required="" aria-required="true">
		                </div>                    
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Email" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cmessage">Your message</label>
		                    <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="10" required="" aria-required="true"></textarea>
		                </div>
		                 <div class="form-group col-12">
		                    <button type="submit" class="btn btn-block btn-primary py-2">Send Now</button>
		                </div>                           
		            </div><!--//form-row-->
		        </form>
		    </div><!--//container-->
	    </section>
	    
	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
