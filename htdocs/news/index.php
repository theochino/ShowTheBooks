<?php 

	date_default_timezone_set('America/New_York'); 
	// This is to load the menus groupping
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/common/verif_sec.php";

	$r = new housing();	
	$result = $r->PrintNewsStory();
			
	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	// include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
	
	
	
	
	
?>

    	

	    
    <div class="main-wrapper">
    	

	  
	    <section class="blog-list px-3 py-5 p-md-5">
		    <div class="container">
			    <div class="row">
			    	
<?php if ( ! empty ($result)) { 
				foreach ($result as $var) {
						if ( ! empty ($var)) {


/*
$NewArticle[$TotalArticles]["First"] = substr ($Story["NewsStories_First"], 20) . "...";
	$var["Buildings_ID"] 
    $var["NewsStories_ID"] 
    $var["NewsStories_Title"]  => Becoming Home
    $var["NewsStories_Source"]  => City Limits
    $var["NewsStories_Link"]  => https://citylimits.org/2000/03/01/becoming-home
    $var["[NewsStories_Author"]  => Robin Shulman
    $var["NewsStories_Date"]  => 2000-03-01
   $var["NewsStories_First"]  => Over the last 20 years, the two big apartment buildings at 640 and 644 Riverside Drive have been a laboratory for real estate disaster 
   $var["NewsStories_PicPath"]  => 
   $var["NewsStories_Publish"]  => yes
)*/




   // Calulating the difference in timestamps 
    $diff = strtotime($var["NewsStories_Date"]) - time(NULL);
      
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    $DateDif = abs(round($diff / 86400)); 


			    	 ?>
					<div class="col-md-4 mb-3">
						<div class="card blog-post-card">
							<img class="card-img-top" src="<?= $var["NewsStories_PicPath"] ?>" alt="">
							<div class="card-body">
								<h5 class="card-title"><a class="theme-link" href="<?= $var["NewsStories_Link"] ?>" TARGET="News"><?= $var["NewsStories_Title"] ?></a></h5>
								<p class="card-text">
								
									<?= substr ($var["NewsStories_First"], 20) . "..."; ?>
									
								<p class="mb-0"><a class="more-link" href="<?= $var["NewsStories_Link"] ?>" TARGET="News">Read more &rarr;</a></p>
								
							</div>
							<div class="card-footer">
								<small class="text"><A HREF="/apts/<?= $var["Buildings_ID"] ?>"><?= $var["Buildings_Address"] ?></A></small><BR>
								<small class="text-muted">Published <?= $DateDif ?> days ago</small>
							</div>
						</div><!--//card-->
					</div><!--//col-->
					
<?php }
		}
	}
?>

		
				</div><!--//row-->
			    
			   <?php /* 
			    <nav class="blog-nav nav nav-justified my-5">
				  <a class="nav-link-prev nav-item nav-link d-none rounded-left" href="#">Previous<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>
				  <a class="nav-link-next nav-item nav-link rounded" href="#">Next<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>
				</nav> */ ?>
				
		    </div>
	    </section>
	    
	  
    
 
<?php /*

  <footer class="footer text-center py-4">
			<small class="copyright">Template Copyright &copy; <a href="https://themes.3rdwavemedia.com/" target="_blank">3rd Wave Media</a></small>
		</footer>
    
    </div><!--//main-wrapper-->
    <!-- Javascript -->          
    <script src="assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script> 
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    
    <!-- Dark Mode -->
	<script src="assets/plugins/js-cookie.min.js"></script>
	<script src="assets/js/dark-mode.js"></script>

    <!-- Style Switcher (REMOVE ON YOUR PRODUCTION SITE) -->
    <script src="assets/js/demo/style-switcher.js"></script>     
    

</body>
</html> 
*/ ?>

	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
