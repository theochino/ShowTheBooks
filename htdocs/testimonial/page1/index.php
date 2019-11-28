<?php
	date_default_timezone_set('America/New_York'); 
	if ( ! empty ($_POST)) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";	
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/common/verif_sec.php";

		$r = new housing();	
		//$ResEmail = $r->SaveJoinEvent($_POST["name"], $_POST["email"], 'Contact Window -', $_POST["message"]);
		
		header("Location: /testimonial/page1");
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
				        Thanks for your testimonial. 
			        </P>

			        <P>
								We would like to ask you a few additional question about 
								satisfied or unsatisfied you are with the process.
			        </P>
			        
			        <div class="form-row">                                                           
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="fname">First Name</label>
		                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" minlength="2" required="" aria-required="true">
		                </div>      
		                              
		                <div class="form-group col-md-6">
		                    <label class="sr-only" for="lname">Last Name</label>
		                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required="" aria-required="true">
		                </div>

		                <div class="form-group col-12">
		                    <label class="sr-only" for="caddress">Address</label>
		                    <input type="text" class="form-control" id="caddress" name="address" placeholder="Address" required="" aria-required="true">
		                </DIV>
										
										<div class="form-group col-md-3">
		                    <label class="sr-only" for="capt">Apt</label>
		                    <input type="text" class="form-control" id="capt" name="apt" placeholder="Apt" minlength="2" required="" aria-required="false">
		                </div>                    
		                
		                <div class="form-group col-md-5">
		                    <label class="sr-only" for="cborough">Borough</label>
		                    <input type="email" class="form-control" id="cborough" name="borough" placeholder="Borough" required="" aria-required="false">
		                </div>
		                
		                <div class="form-group col-md-4">
		                    <label class="sr-only" for="czipcode">Zipcode</label>
		                    <input type="text" class="form-control" id="czipcode" name="zipcode" placeholder="Zipcode" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cemail">Email</label>
		                    <input type="text" class="form-control" id="cemail" name="email" placeholder="Email" required="" aria-required="true">
		                </DIV>
		                		            		                
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="ctestimony">Public Testimony</label>
		                    <textarea class="form-control" id="ctestimony" name="testimony" placeholder="Public Testimony" rows="10" required="" aria-required="true"></textarea>
		                </div>
		              
		                <div class="form-group col-12">
			                <select id="share" class="custom-select" name="share" required="" aria-required="true">
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
