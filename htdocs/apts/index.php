<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";

	if ( empty ($_GET["id"])) {	
		// Redirect toward 404 page
		echo "Page not found";
		exit();
	}
	
	$r = new housing();	
	$BuildingID = substr ($_GET["id"] , 6); 
	$housing = $r->ListDoneHousing($BuildingID);
	$NewsStory = $r->PrintNewsStory($BuildingID);
	$Testimonial = $r->PrintTestimonial($BuildingID);
	
	
	$AptName = $housing["Buildings_Address"];
	$Borough = $housing["Buildings_Borough"];	

	switch($Borough) {
		case "MANHATTAN":			$boro = 1; break;
		case "BRONX":					$boro = 2; break;
		case "BROOKLYN":			$boro = 3; break;
		case "QUEENS":				$boro = 4; break;
		case "STATEN ISLAND":	$boro = 5; break;
	}
	
	$block = $housing["Buildings_Block"];
	$lot = $housing["Buildings_Lot"];
	
	$ResoNumber = $housing["HouseRes_Reso"];
	$Resolution = $housing["HouseRes_TextReso"];
	$ResoLink = $housing["HouseRes_Link"];
	$LinkToWhoOwWhat = "https://whoownswhat.justfix.nyc/en/address/" . $housing["Buildings_WhoOwnWhat"];
	$LinkToLawsuit = "http://iapps.courts.state.ny.us/iscroll/SQLData.jsp?IndexNo=104128-2008";
	
	$AccrisLink = "http://a836-acris.nyc.gov/bblsearch/bblsearch.asp?borough=" . $boro . "&block=" . $block . "&lot=" . $lot;
	$NYCBuildingLink = "http://a810-bisweb.nyc.gov/bisweb/PropertyProfileOverviewServlet?boro=" . $boro . "&block=" . $block . "&lot=" . $lot;
	
	$PresText = "Block " . $housing["Buildings_Block"] . " Lot " . $housing["Buildings_Lot"] . 
							"<BR>" . $housing["Buildings_Law"];
	$Picture = "/buildings/" . $BuildingID . ".png";
	
	$TotalArticles = 0;
	if (! empty ($NewsStory)) {
		foreach ($NewsStory as $Story) {
			if (! empty ($Story) && $Story["NewsStories_Publish"] == 'yes') {
				$NewArticle[$TotalArticles]["Link"] = $Story["NewsStories_Link"];
				$NewArticle[$TotalArticles]["Title"] = $Story["NewsStories_Title"];
				$NewArticle[$TotalArticles]["Author"] = $Story["NewsStories_Author"];
				$NewArticle[$TotalArticles]["Date"] = $Story["NewsStories_Date"];
				$NewArticle[$TotalArticles]["First"] = substr ($Story["NewsStories_First"], 0, 200) . "...";
				$NewArticle[$TotalArticles]["Source"] =  $Story["NewsStories_Source"];
				$TotalArticles++;
			}
		}
	}
	
	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
?>
	<div class="main-wrapper">
		
		<section class="about-me-section p-3 p-lg-5 theme-bg-light">
			<div class="container">
				<div class="profile-teaser media flex-column flex-lg-row">
					
					<div class="media-body">
						<h2 class="name font-weight-bold mb-1"><?= $AptName ?></h2>
						<div class="tagline mb-3"><?= $Borough ?></div>
						<div class="bio mb-4"><?= $PresText ?></a>.
						</div><!--//bio-->
						<div class="mb-4">
							<a class="btn btn-secondary mb-3" href="/register"><i class="fas fa-file-alt mr-2"></i><span class="d-none d-md-inline"></span>I live there</a>
							<a class="btn btn-primary mb-3" href="<?= $AccrisLink ?>" TARGET="ACRIS"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline">Open</span> ACRIS</a>
							<a class="btn btn-primary mb-3" href="<?= $NYCBuildingLink ?>" TARGET="NYCBuild"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline">Open</span> DOB</a>


<?php if (! empty($LinkToWhoOwWhat)) { ?>
							<a class="btn btn-primary mb-3" href="<?= $LinkToWhoOwWhat ?>" TARGET="WhoOwnWhat"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline">Open</span> Who Own What</a>
<?php } ?>
						</div>
					</div><!--//media-body-->
					<img class="profile-image mb-3 mb-lg-0 ml-lg-5 mr-md-0" src="<?= $Picture ?>" alt="">
				</div>
			</div>
		</section><!--//about-me-section-->
		
		<section class="overview-section p-3 p-lg-5">
			<div class="container">
				<h2 class="section-title font-weight-bold mb-3"><?= $ResoNumber ?></h2>
				<div class="section-intro mb-5"><?= $Resolution ?></div>

				<?php if (! empty($ResoLink)) { ?>

				<a class="btn btn-primary mr-2 mb-3" href="<?= $ResoLink ?>" TARGET="CITYHALL"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline">Open</span> City Council</a>

				<?php } ?>

				
				
				
	
			</div><!--//container-->
		</section>
		
		<div class="container"><hr></div>
		
		
<?php /* bla */

//Buildings_WhoOwnWhat

?>
		
		
		
<?php if (! empty ($Testimonial)) { ?>
		<section class="testimonials-section p-3 p-lg-5">
			<div class="container">
				<h2 class="section-title font-weight-bold mb-5">Testimonials</h2>
				<div class="testimonial-carousel owl-carousel owl-theme">


				<?php
						foreach ($Testimonial as $Testi) {
							if (! empty ($Testi) && $Testi["Testimonial_Publish"] == 'yes') {
				?>

					<div class="item">
						<div class="quote-holder">
							<blockquote class="quote-content"><?= $Testi["Testimonial_Text"] ?></blockquote>
							<i class="fas fa-quote-left"></i>
						</div><!--//quote-holder-->
						<div class="source-holder">
							<div class="source-profile">
								<img src="/assets/images/clients/profile-1.png" alt="image"/>
							</div>
							<div class="meta">
								<div class="name"><?= $Testi["Testimonial_Name"] ?></div>
								<div class="info"><?= $Testi["Testimonial_Titles"] ?></div>
							</div>
						</div>
					</div>
	
					<?php }
						} ?>
					
				</div><!--//testimonial-carousel-->	
			</div><!--//container-->
		</section><!--//testimonials-section-->
		
		<div class="container"><hr></div>
<?php } ?>
		
<?php if ( $TotalArticles > 0 ) { ?>		
		<section class="featured-section p-3 p-lg-5">
			<div class="container">
				<h2 class="section-title font-weight-bold mb-5">News Articles</h2>
				<div class="row">
					<?php for ($i = 0; $i < $TotalArticles; $i++) { ?>			
					<div class="col-md-6 mb-5">
						<div class="card project-card">
							<div class="row no-gutters">
								<div class="col-lg-4 card-img-holder">
									<img src="/assets/images/project/project-1.jpg" class="card-img" alt="image">
								</div>
								<div class="col-lg-8">
									<div class="card-body">
										<h5 class="card-title"><a href="<?= $NewArticle[$i]["Link"] ?>" target="_article" class="theme-link"><?= $NewArticle[$i]["Title"] ?></a></h5>
										<p class="card-text"><?= "<I>" . $NewArticle[$i]["Date"]  . "</I> - " . $NewArticle[$i]["First"] ?></p>
										<p class="card-text"><small class="text-muted">Source: <?= $NewArticle[$i]["Source"] ?></small></p>
									</div>
								</div>
							</div>
							<div class="link-mask">
								<a class="link-mask-link" href="<?= $NewArticle[$i]["Link"] ?>" target="_article" ></a>
								<div class="link-mask-text">
									<a class="btn btn-secondary" href="<?= $NewArticle[$i]["Link"] ?>" target="_article" >
										<i class="fas fa-eye mr-2"></i>Read article
									</a>
								</div>
							</div><!--//link-mask-->
						</div><!--//card-->
					</div><!--//col-->
					<?php } ?>				
				</div><!--//row-->
				<div class="text-center py-3"><a href="/news" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-right mr-2"></i>More articles</a></div>
				
			</div><!--//container-->
		</section><!--//featured-section-->
<?php } ?>


	
<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
