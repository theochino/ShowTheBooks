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

  
				    
		     <h2 class="m-lg-1 py-3 pl-4 px-lg-5">
		     		Rally on the steps of City Hall Tuesday December 10, 2019 at 12:45 pm.
		     </H2>
		     
		     	<a class="btn btn-primary mr-2 mb-3" href="/joinus"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline">Join us</span></a>

				  <?php /*  <div class="meta mb-3"><span class="date">Published 2 days ago</span><span class="time">5 min read</span><span class="comment"><a href="#">4 comments</a></span></div> */ ?>
			    </header>
			    
			    
				    	
				    <h3 class="mt-5 mb-3">Open the books!</h3>

			      
				    <p>We are asking for a federal, state and city investigation that would open the books for a real 
				    	investigation into all HPD private public partnerships with Neighborhood Restore (and non profits) 
				    	including the Third Party Transfer program, TIL-ANCP, and Inclusionary Zoning.</p>

				    
				    	<?php /* <h5 class="my-3">Quote Example:</h5> */ ?>
					<blockquote class="blockquote m-lg-5 py-3 pl-4 px-lg-5">
						<p class="mb-2">
							That HPD sat right here and said that they came to our building and notified us, is a lie!
							
							</p>
						<footer class="blockquote-footer">Isabel Adon</footer>
					</blockquote>
				    
				    <div class="embed-responsive embed-responsive-16by9">
					   <iframe width="560" height="315" src="https://www.youtube.com/embed/Gf5RPaseT-0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>					
					</div>
			    	    	
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
