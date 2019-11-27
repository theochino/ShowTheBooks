<?php 
	if ( ! empty ($_POST)) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";

		$r = new housing();	
		$ResEmail = $r->AddPersonNotes(0, $_POST["firstname"], $_POST["lastname"],'', '', '', $_POST["telephone"], 
																			$_POST["email"], "Note: " . $_POST["services"] . " " . $_POST["message"]);
		header("Location: /thanks");
		exit();
	}
	
	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	// include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
?>
    <div class="main-wrapper">
	   
	    <section class="contact-section px-3 py-5 p-md-5">
		    <div class="container">
			    <form id="contact-form" class="contact-form col-lg-8 mx-lg-auto" method="post" action="">
			        <h3 class="text-center mb-3">Register</h3>
			        
			        
			        <?php /*
							<small class="form-text text-muted pt-1"><i class="fas fa-info-circle mr-2 text-primary"></i>
								
								If you know someone that live at 2488-90 Adam Clayton Powell, Jr. Boulevard in Manhattan.
								Please fill the form below and someone will contact shortly.		
								</small>
							*/ ?>
			        
			        <div class="form-row">                                                           
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cname">First Name</label>
		                    <input type="text" class="form-control" id="fname" name="firstname" placeholder="Firstname" minlength="2" required="" aria-required="true">
		                </div>                    
	
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cname">Last Name</label>
		                    <input type="text" class="form-control" id="lname" name="lastname" placeholder="Lastname" minlength="2" required="" aria-required="true">
		                </div>                    
	
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cemail">Telephone</label>
		                    <input type="telephone" class="form-control" id="ctel" name="telephone" placeholder="Telephone" required="" aria-required="true">
		                </div>
		                
		                 <div class="form-group col-md-6">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Email" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-12">
			                <select id="services" class="custom-select" name="services">
								<option selected>Do you live in that building...</option>
								<option value="ILive">I live in that building</option>
								<option value="AFriendLive">Standard</option>
							</select>
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
	    
	     <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center single-col-max-width">
			    <h2 class="heading">Contact</h2>
			    <div class="intro">
			    <p>You fill <A HREF="/contact">the contact form</A> or send an email to <a href="mailto:theo@640rsd.new-york.ny.us">theo@640rsd.new-york.ny.us</a></p>
			    <p>Want to get connected? Follow us on the social channels below.</p>
			    <ul class="list-inline mb-0">
		            <li class="list-inline-item mb-3"><a class="twitter" href="https://twitter.com/BooksShow"><i class="fab fa-twitter fa-fw fa-lg"></i></a></li>
                <li class="list-inline-item mb-3"><a class="facebook" href="https://www.facebook.com/ShowTheBooks"><i class="fab fa-facebook-f fa-fw fa-lg"></i></a></li>
	                
	                
	            </ul><!--//social-list-->
			    
			</div><!--//container-->
	    </section>
	    
	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
