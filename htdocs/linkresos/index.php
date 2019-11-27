<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
		
	if (! empty ($_POST)) {
		$RightPage = preg_match ("/https:\/\/legistar.council.nyc.gov\/LegislationDetail.aspx?(.*)/", $_POST["URLFOR"], $matched);
		
		if ($RightPage == 1) {
			preg_match ("/Search=(.*)/", $matched[1], $searchmatch);
			$r->SaveResoLink($_POST["HOUSERESO"], $_POST["URLFOR"], $searchmatch[1]);
			header("Location: ?msg=SUC");
		} else {
			header("Location: ?msg=PCN");
		}
		exit();
	}
	
	$reso = $r->RandomResoToFind();
	preg_match("/Res (.*)/", $reso["HouseRes_Reso"], $matches);
?>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
}
</script>

<H1>Show The Books</H1>

<P>
	Linking the City Hall resolutions with the Resolution.<BR>
	<A HREF="https://youtu.be/Ez9V3GlqFno" TARGET="VideoTraining">Training video.</A>
</P>


<?php 
	if ($_GET["msg"] == "SUC") {
		echo "<P><FONT COLOR=GREEN><B>Success! Thanks for saving this information</B></FONT></P>";
	} 
	
	if ($_GET["msg"] == "PCN") {
		echo "<P><FONT COLOR=\"BROWN\">Error! The information provided did not start with <B>https://legislar.council.nyc.gov</B></FONT><BR>";
		echo "Make sure you copy the whole URL";
		echo "</P>";
	}
?>

<P>
Open the City Council page at search for "<?= $reso["HouseRes_Reso"] ?>" at <A HREF="https://legistar.council.nyc.gov/Legislation.aspx" TARGET="LEGISLATR">https://legistar.council.nyc.gov/Legislation.aspx</A>
</P>

<P>
<input type="text" value="<?= $reso["HouseRes_Reso"] ?>" id="myInput">
<button onclick="myFunction()">Copy text</button><BR>
The Copy Text button does not work on Internet Explorer and earlier.
</P>

<P>
	<U>The text of the resolution should be:</U><BR>
	<UL><?= htmlentities($reso["HouseRes_TextReso"]); ?></UL>
</P>

<?php /*
<P>
<iframe width="100%"  height="500" src="curled.php"></iframe>
</P>
*/ ?>

</P>
<BR>
<B>Enter the URL of the Legislation in the field bellow:</B>
<FORM ACTION="" METHOD="POST">
	<INPUT TYPE="hidden" NAME="HOUSERESO" VALUE="<?= $reso["HouseRes_ID"] ?>">
	<INPUT TYPE="hidden" NAME="RESONUMBER" VALUE="<?= $matches[1] ?>">
	<input type="text" NAME="URLFOR" value="" SIZE=120><BR>
	<INPUT TYPE="SUBMIT" VALUE="Save the URL of Resolution <?= $matches[1] ?>">
</FORM>
</P>


<A HREF="/">Return to the main page</A>
