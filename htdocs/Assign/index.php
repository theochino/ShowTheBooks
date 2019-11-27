<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 

	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
	
	$id = $_GET["id"]; $next_id = $id + 1; $prev_id = $id - 1;
	
	
	if ( empty (!$_POST)) {
		if ( ! empty ($_POST["RESOLINK"]) && ! empty ($_POST["RESO"]) ) {
			preg_match ("/https:\/\/legistar.council.nyc.gov\/LegislationDetail.aspx?(.*)&Options/", $_POST["RESOLINK"], $matches);			
			$r->UpdateResolink($_POST["RESO"], "https://legistar.council.nyc.gov/LegislationDetail.aspx" . $matches[1]);
		}
		
		if ( ! empty ($_POST["Assign"])) {
			foreach($_POST["Assign"] as $Assignment) {
				if ( !empty ($Assignment)) {		
					if ( ! empty ($_POST["POSTPONE"]) && $PostponeFirstTime == 0) {
						echo "Comeback to study this reso at later time\n";
						$r->PostPoneResoID($_POST["POSTPONE"], 'yes');
						$PostponeFirstTime = 1;
					}
					$r->UpdateHousing($_POST["RESO"], $Assignment, $_POST["BLOCK"][$Assignment], $_POST["LOT"][$Assignment], 
															$_POST["BOROUGH"][$Assignment],  $_POST["LAW"][$_POST["REPEAT"]]);
				}
			}
		}
		
		header("Location: ?id=" . $next_id);
		
	}
		
	$result = $r->ListLaws($id); 
	$housing = $r->ListHousing();	
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

<?= $result["HouseRes_ID"] ?> - 
<?= $result["HouseRes_Reso"] ?>


<P>
<input type="text" value="<?= $result["HouseRes_Reso"] ?>" id="myInput">
<button onclick="myFunction()">Copy text</button><BR>
The Copy Text button does not work on Internet Explorer and earlier.<BR>
<A HREF="https://legistar.council.nyc.gov/Legislation.aspx" TARGET="NEWCOUNCIL">https://legistar.council.nyc.gov/Legislation.aspx</A>
</P>

<?php
$StringToHilight = $result["HouseRes_TextReso"];
if (!empty ($housing)) {
	foreach ($housing as $var) {
		if ( !empty ($var)) {
			$keyword = $var["Buildings_Address"];
			$StringToHilight = preg_replace("/\p{L}*?" . preg_quote($keyword) . "\p{L}*/ui", "<MARK><FONT COLOR=BROWN><B>$0</B></FONT></MARK>", $StringToHilight);
		}
	}
}

if (empty ($StringToHilight)) {
	$StringToHilight =  $result["HouseRes_TextReso"];
}


?>


<P>
<U>Resolution from Council:</U>
<UL><?= $StringToHilight ?></UL>
</P>
	
<P>
	<FORM ACTION="" METHOD="POST">
	<INPUT TYPE="TEXT" NAME="RESOLINK" SIZE=200>
</P>
	


<P>	
  <A HREF="?id=<?= $next_id ?>">Next Reso</A>
</P>


<P>
	<INPUT TYPE="CHECKBOX" NAME="POSTPONE" VALUE="<?= $result["HouseRes_ID"] ?>"> Postpone this reso.
	<INPUT TYPE="HIDDEN" NAME="RESO" VALUE="<?= $result["HouseRes_ID"] ?>">
	<INPUT TYPE="SUBMIT" VALUE="Process this reso">
</P>

<TABLE BORDER=1>
	
	<TR>
			<TH>Assign</TH>
			<TH>HouseRes_ID</TH>
			<TH>Address</TH>
			<TH>AKA Address</TH>
			<TH>Block Text</TH>
			<TH>Block</TH>
			<TH>Lot</TH>
			<TH>Borough</TH>
			<TH>Law</TH>
			<TH>Repeat</TH>
			<TH>Plot</TH>
			<TH>&nbsp;</TH>
	</TR>
	

<?php if (!empty ($housing)) {
	foreach ($housing as $var) {
		if ( !empty ($var)) {
			

			$FindAddress = preg_match ( "/" . $var["Buildings_Address"] . "/", $result["HouseRes_TextReso"] );
			preg_match ("/Block (\d*)[ \/]Lot (\d*)/", $var["Buildings_BlockText"], $matches);
			preg_match("/\((.*)\)/", $var["Buildings_Law"], $lawmatch);
			
			
			echo "<TR";
			
			if ( $FindAddress == 1 ) {
				echo " bgcolor=\"#aaa\"";
			}
			
			echo ">\n";
			
			echo "\t<TD ALIGN=CENTER><INPUT ";
		
			echo "TYPE=\"checkbox\" NAME=\"Assign[" . $var["Buildings_ID"] . "]\" VALUE=\"" . $var["Buildings_ID"] . "\"";
		
			if ( $FindAddress == 1) {
				echo " CHECKED";
			}
			echo "></TD>\n";
			echo "\t<TD>" . $var["HouseRes_ID"] . "</TD>\n";
			echo "\t<TD>" . $var["Buildings_Address"]  . "</TD>\n";
			echo "\t<TD>" . $var["Buildings_AKAAddress"]  . "</TD>\n";
			echo "\t<TD>" . $var["Buildings_BlockText"]  . "</TD>\n";
			echo "\t<TD><INPUT TYPE=\"TEXT\" SIZE=5 NAME=\"BLOCK[" . $var["Buildings_ID"] . "]\" VALUE=\"" . $matches[1]  . "\"></TD>\n";
			echo "\t<TD><INPUT TYPE=\"TEXT\" SIZE=5 NAME=\"LOT[" . $var["Buildings_ID"] . "]\" VALUE=\"" . $matches[2]  . "\"></TD>\n";
			echo "\t<TD>";
			
			//. $var["Buildings_Borough"]  . "</TD>";
			
		?><SELECT NAME="BOROUGH[<?= $var["Buildings_ID"] ?>]">
				<OPTION VALUE=""></OPTION>
				<OPTION VALUE="MANHATTAN"<?php if (preg_match ("/manhattan/i", $var["Buildings_Borough"]) == 1) { echo " SELECTED";} ?>>Manhattan</OPTION>
				<OPTION VALUE="QUEENS"<?php if (preg_match ("/queens/i", $var["Buildings_Borough"]) == 1) { echo " SELECTED";} ?>>Queens</OPTION>
				<OPTION VALUE="BROOKLYN"<?php if (preg_match ("/brooklyn/i", $var["Buildings_Borough"]) == 1) { echo " SELECTED";} ?>>Brooklyn</OPTION>
				<OPTION VALUE="STATEN ISLAND"<?php if (preg_match ("/staten island/i", $var["Buildings_Borough"]) == 1) { echo " SELECTED";} ?>>Staten Island</OPTION>
				<OPTION VALUE="BRONX"<?php if (preg_match ("/bronx/i", $var["Buildings_Borough"]) == 1) { echo " SELECTED";} ?>>Bronx</OPTION>
			</SELECT><?php
			echo "</TD>\n";
			echo "\t<TD><INPUT TYPE=\"TEXT\" SIZE=25 NAME=\"LAW[" . $var["Buildings_ID"] . "]\" VALUE=\"" . $lawmatch[1]  . "\"></TD>\n";
			echo "\t<TD ALIGN=CENTER><INPUT TYPE=\"RADIO\" NAME=\"REPEAT\" VALUE=\"" . $var["Buildings_ID"] . "\"";
			
			if ( $FindAddress == 1 && ! empty ( $lawmatch[1])) {
				echo " CHECKED";
			}
			
			echo "></TD>\n";
			
			echo "\t<TD>" .$var["Buildings_Plot"]  . "</TD>\n";
			echo "<TD><INPUT TYPE=\"SUBMIT\" VALUE=\"Proc\"></TD>";
			echo "</TR>\n";
		}
	}
} ?>

</TABLE>
</FORM>

</P>