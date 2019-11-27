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
	  
	    <section class="contact-section px-3 py-5 p-md-5">
		    <div class="container">
			    <form id="contact-form" class="contact-form col-lg-8 mx-lg-auto" method="post" action="">
			        <h3 class="text-center mb-3">Testimonial</h3>
	        
			        <P>
				        The housing crisis is such that it affect everyone. We created this webpage to share how widespread is 
				        the problem.
			        </P>

			        <P>
				        The information you supply here will be shared with the local politicians and the proper authority so
				        we can remedy.
			        </P>
			        
			        <div class="form-row">                                                           
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cname">First Name</label>
		                    <input type="text" class="form-control" id="cname" name="name" placeholder="First Name" minlength="2" required="" aria-required="true">
		                </div>      
		                              
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="cemail">Last Name</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Last Name" required="" aria-required="true">
		                </div>

		                <div class="form-group col-12">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Address" required="" aria-required="true">
		                </DIV>
										
										<div class="form-group col-md-3">
		                    <label class="sr-only" for="cname">Name</label>
		                    <input type="text" class="form-control" id="cname" name="name" placeholder="Apt" minlength="2" required="" aria-required="true">
		                </div>                    
		                
		                <div class="form-group col-md-5">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Borough" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-md-4">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Zipcode" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Email" required="" aria-required="true">
		                </DIV>
		                		            		                
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cmessage">Public Testimony</label>
		                    <textarea class="form-control" id="cmessage" name="message" placeholder="Public Testimony" rows="10" required="" aria-required="true"></textarea>
		                </div>
		              
		                <div class="form-group col-12">
			                <select id="services" class="custom-select" name="services">
												<option selected>Can we share that testimony?</option>
												<option value="yes">yes</option>
												<option value="no">no</option>
											</select>
										</div>
		                
		                
		                 <div class="form-group col-12">
		                    <button type="submit" class="btn btn-block btn-primary py-2">Save The Testimonial</button>
		                </div>                           
		            </div><!--//form-row-->
		        </form>
		    </div><!--//container-->
	    </section>
	    
	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
