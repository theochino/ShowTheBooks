<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
	$housing = $r->ListDoneHousing();
?>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<H1>Show The Books</H1>

<P>
	If you know someone that live in a building listed in this list, 
	please click on the "I know someone there".
</P>

<P>
	If your building is not listed below, we have not yet entered in the system.<BR>
	<B>Please <A HREF="https://showthebooks.org/iknowsomeone.php">fill out the form here</A>.</B>
</P>

<P>
	<A HREF="/">Return to the main page</A>
</P>

<P>
<TABLE BORDER=1 id="myTable2">
 	<TR>
		<TH>&nbsp;</TH>
		<TH><B>TYPE YOUR ADDRESS IN THE BOX</B><BR>
			<input type="text" id="myInput" size=45 onkeyup="myFunction()" placeholder="Search for addresses ..."></TH>
		<TH>&nbsp;</TH>
		<TH>&nbsp;</TH>
		<TH>&nbsp;</TH>
		<TH>&nbsp;</TH>
		<TH>&nbsp;</TH>
		<TH>&nbsp;</TH>
	</TR>
	
	<TR>
		<TH>TPT Resolution</TH>
		<TH>Address</TH>
		<TH>Alt Address</TH>
		<TH>Block #</TH>
		<TH>Lot #</TH>
		<TH>Borough</TH>
		<TH>&nbsp;</TH>
		<TH>Actions</TH>
	</TR>

<?php if (!empty ($housing)) {
	foreach ($housing as $var) {
		if ( !empty ($var)) {
			echo "<TR>";
			
			if ( ! empty ($var["HouseRes_Link"])) {
				echo "<TD><A HREF=\"" . $var["HouseRes_Link"] . "\" TARGET=\"CITYCOUNCIL\">". $var["HouseRes_Reso"] . "</A></TD>";
			} else {
				echo "<TD>" . $var["HouseRes_Reso"] . "</TD>";
			}
	
			echo "<TD>" .$var["Buildings_Address"]  . "</TD>";
			echo "<TD>" . $var["Buildings_AKAAddress"]  . "</TD>";
						echo "<TD ALIGN=CENTER>" . $var["Buildings_Borough"]  . "</TD>";
			echo "<TD ALIGN=CENTER>" .$var["Buildings_Block"]  . "</TD>";
			echo "<TD ALIGN=CENTER>" . $var["Buildings_Lot"]  . "</TD>";

			
			?>
			<TD ALIGN=CENTER VALIGN=CENTER>
			<FORM ACTION="https://a836-acris.nyc.gov/DS/DocumentSearch/BBL" TARGET="ACRIS">
				<INPUT TYPE="SUBMIT" VALUE="Open ACRIS">
				
			</FORM>
		</TD>
			<TD ALIGN=CENTER VALIGN=CENTER>
			<FORM ACTION="iknowsomeone.php" METHOD="POST">
				<INPUT TYPE="SUBMIT" NAME="<?= $var["Buildings_ID"] ?>" VALUE="I know someone there">
				
			</FORM>
			
			</TD>
			<?php
			
			
			echo "</TR>";
		}
	}
} ?>

</TABLE>
</P>