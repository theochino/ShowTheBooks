<?php
	date_default_timezone_set('America/New_York'); 
	if ( ! empty ($_POST)) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	
		$r = new housing();	
		$ResEmail = $r->SaveJoinEvent($_POST["name"], $_POST["email"], $_POST["services"], $_POST["message"]);
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
			    <h2 class="heading">Join Us!</h2>
			    <div class="intro">
			    <p>
			    	
			    We are having a rally on the steps of City Hall Tuesday December 10, 2019 at 12:45 pm to ask 
			    for a federal, state and city investigation that would open the books for a real investigation into 
			    all HPD private public partnerships with Neighborhood Restore (and non profits) including the Third 
			    Party Transfer program, TIL-ANCP, and Inclusionary Zoning.</p>
			   
			</div><!--//container-->
	    </section>
	    <section class="contact-section px-3 py-5 p-md-5">
		    <div class="container">
			    <form id="contact-form" class="contact-form col-lg-8 mx-lg-auto" method="post" action="">
			        <h3 class="text-center mb-3">Let us know that you will join us.</h3>
			        <div class="form-row">                                                           
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cname">Name</label>
		                    <input type="text" class="form-control" id="cname" name="name" placeholder="Name" minlength="2" required="" aria-required="true">
		                </div>                    
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Email" required="" aria-required="false">
		                </div>
		                <div class="form-group col-12">
			                <select id="services" class="custom-select" name="services">
								<option selected>Select a service package you're interested in...</option>
								<option value="WillJoin">I will be joining</option>
								<option value="NoPromises">I'll try to make but no promises</option>
								<option value="CannotMakeIt">I can make it but support your work</option>
								<option value="NotSure">Not sure what to think</option>
							</select>
						</div>
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cmessage">Your message</label>
		                    <textarea class="form-control" id="cmessage" name="message" placeholder="Notes" rows="2" required="" aria-required="false"></textarea>
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
