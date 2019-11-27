<?php
	date_default_timezone_set('America/New_York'); 

	if ( ! empty ($_POST["email"])) {
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	
		$r = new housing();	
		$result = $r->SaveEmail($_POST["email"]);
		
		if ( empty ($result)) {
			header("Location: /thanks");
		} else {
			header("Location: /alreadylist");
		}
		
		exit();
	}

	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
?>

<P>
	<h2>Volunteer</h2>
</P>






<div class="embed-responsive embed-responsive-16by9">
  <iframe width="320" height="180" src="https://www.youtube.com/embed/Ez9V3GlqFno" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					
</div>

<P>
	<A HREF="/linkresos">Link City Hall Resolutions numbers with the webpage</A><BR>
</P>

<P>
	If you can create a logo, program in PHP, or anything else, please contact me at theo@640rsd.new-york.ny.us.<BR>
	We need a PDF flyer to pass around the buildings.
</P>

 <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center">
			    <h2 class="heading">Register to the mailing list.</h2>
			    <div class="intro">Subscribe and get the latest news in your inbox.</div>
			     <form class="signup-form form-inline justify-content-center pt-3" ACTION="" METHOD="POST">
                    <div class="form-group">
                        <label class="sr-only" for="semail">Your email</label>
                        <input type="email" id="semail" name="email" class="form-control mr-md-1 semail" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
		    </div><!--//container-->
	    </section>


<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
