<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
	
	if ( ! empty ($_POST["buildingid"])) {
	
		// Saving the paper entry
		$ArticleID = $r->SaveNewsArticle($_POST["Link"], $_POST["Title"], $_POST["Source"], $_POST["Author"], 
																	   $_POST["Date"], $_POST["First"], $_POST["PictPath"], 'yes');
																	 
		foreach($_POST["buildingid"] as $buildingid) {
			if (! empty ($buildingid)) {
				$r->SaveBuildingArticle($ArticleID, $buildingid);			
			}
		}
		header("Location: /linknews/");
	}
	
	$housing = $r->ListDoneHousing();
?>
		

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
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
	Linking the City Hall resolutions with the Resolution.<BR>
	<A HREF="https://youtu.be/Ez9V3GlqFno" TARGET="VideoTraining">Training video.</A>
</P>

<P>
	If you know someone that live in a building listed in this list, please let us know. 
</P>

<P>
	If your building is not listed below, we have not yet entered in the system.<BR>
	<B>Please <A HREF="/register">fill out the form here</A>.</B>
</P>

<FORM METHOD="POST" ACTION="">

<TABLE>
	<TR><TD>Link:</TD><TD><INPUT TYPE="TEXT" NAME="Link" SIZE=120></TD></TR>
	<TR><TD>Title: </TD><TD><INPUT TYPE="TEXT" NAME="Title" SIZE=80></TD></TR>
	<TR><TD>Source:</TD><TD><INPUT TYPE="TEXT" NAME="Source" SIZE=20></TD></TR>
	<TR><TD>Author:</TD><TD><INPUT TYPE="TEXT" NAME="Author" SIZE=20></TD></TR>
	<TR><TD>Date:</TD><TD><INPUT TYPE="TEXT" NAME="Date" SIZE=10></TD></TR>
	<TR><TD>First:</TD><TD><INPUT TYPE="TEXT" NAME="First" SIZE=80></TD></TR>
	<TR><TD>PicPath:</TD><TD><INPUT TYPE="TEXT" NAME="PictPath" SIZE=10></TD></TR>
</TABLE>

<INPUT TYPE="SUBMIT" VALUE="Submit the information">


<h5 class="my-3">Search here for address</h5>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for addresses ..."></TH>

<table class="table my-5" id="myTable">	
				
	<thead>
		<tr>
			<td scope="col">&nbsp;</td>
			<th scope="col" id="title">Address</th>
			<th scope="col">Borough</th>
		</tr>
	</thead>

	<tbody>			
	<?php if (!empty ($housing)) {
		foreach ($housing as $var) {
			if ( !empty ($var["Buildings_Address"])) { ?>
		<TR>
			<TD>
				<INPUT TYPE="CHECKBOX" NAME="buildingid[]" VALUE="<?= $var["Buildings_ID"] ?>">
 		 </TD>			
	
			<TD scope="row"><?= $var["Buildings_Address"] ?><?php if (! empty( $var["Buildings_AKAAddress"])) { echo " - " . $var["Buildings_AKAAddress"]; } ?></TD>
			<TD><?= $var["Buildings_Borough"]  ?></TD>
		</TR>	
			
	<?php }
			}
		} ?>			
	</tbody>
	
</table>

<?php 
	// include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
</FORM>