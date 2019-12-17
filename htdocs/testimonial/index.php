<?php
	date_default_timezone_set('America/New_York'); 
	if ( ! empty ($_POST)) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/common/verif_sec.php";
	
		$r = new housing();		
		$r->SaveTestimonyLong($_POST["fname"], $_POST["lname"], $_POST["address"], $_POST["apt"], 
					$_POST["borough"], $_POST["zipcode"], $_POST["email"], $_POST["tel"], 
					$_POST["satisfaction"], $_POST["testimony"], $_POST["share"]);
		
		header("Location: /testimonial/thanks");
		// header("Location: /testimonial/page1/?k=" . EncryptURL("BLA"));
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
		                    <input type="text" class="form-control" id="capt" name="apt" placeholder="Apt" minlength="2">
		                </div>                    
		                
		                <div class="form-group col-md-5">
		                    <label class="sr-only" for="cborough">Borough</label>
		                    <input type="text" class="form-control" id="cborough" name="borough" placeholder="Borough">
		                </div>
		                
		                <div class="form-group col-md-4">
		                    <label class="sr-only" for="czipcode">Zipcode</label>
		                    <input type="text" class="form-control" id="czipcode" name="zipcode" placeholder="Zipcode" required="" aria-required="true">
		                </div>
		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="cemail">Email or phone number</label>
		                    <input type="text" class="form-control" id="cemail" name="email" placeholder="Email">
		                </DIV>

		                <div class="form-group col-12">
		                    <label class="sr-only" for="ctel">Email or phone number</label>
		                    <input type="text" class="form-control" id="ctel" name="tel" placeholder="Telephone">
		                </DIV>
		                
				<div class="form-group col-12">
					Click to select from options below
			                <select id="share" class="custom-select" name="satisfaction" required="" aria-required="true">
												<option selected>Are you satisfied with the process?</option>
												<option value="yes-100">Yes, 100% satisfied</option>
												<option value="yes-minor">Yes but there are minors issues</option>
												<option value="yes-shake">Yes but my input was not taken but I am satisfied</option>
												<option value="no-shake">No and my input was not even taken into account</option>
												<option value="no-live">No but I learned to live with it</option>
												<option value="no-100">Not at all</option>
												<option value="complicated">It's complicated</option>
												<option value="notsay">I prefer to keep quiet</option>
					</select>
				</div>
		                		            		                
		                <div class="form-group col-12">
		                    <label class="sr-only" for="ctestimony">Public Testimony</label>
		                    <textarea class="form-control" id="ctestimony" name="testimony" placeholder="Please describe your experience with the process" rows="10" required="" aria-required="true"></textarea>
		                </div>
		                
		                 
		              
				<div class="form-group col-12">
					Click to select from options below
			                <select id="share" class="custom-select" name="share" required="" aria-required="true">
												<option selected>Can we share that testimony publicly?</option>
												<option value="yes">yes</option>
												<option value="no-no">no, and keep it confidential</option>
												<option value="no-elect">no, but you can share it privately</option>
												<option value="no-elect">no, but you can share with elected officials</option>
					</select>
				</div>
		                
		                
		                 <div class="form-group col-12">
		                    <button type="submit" class="btn btn-block btn-primary py-2">Save The Testimonial</button>
				</div>                           

<div>
				<P>
<BR>


<iframe width="560" height="315" src="https://www.youtube.com/embed/Qga3Ut1Yuvw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<BR>
<iframe width="560" height="315" src="https://www.youtube.com/embed/02uwl_6O53M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</P>
</DIV>

		            </div><!--//form-row-->
		        </form>
		    </div><!--//container-->
	    </section>
	    
	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
