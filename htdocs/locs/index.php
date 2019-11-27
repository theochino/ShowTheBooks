<?php
	// This is to load the menus groupping
	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
	$housing = $r->ListDoneHousing();
?>

<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
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


<P>
	If you know someone that live in a building listed in this list, please let us know. 
</P>

<P>
	If your building is not listed below, we have not yet entered in the system.<BR>
	<B>Please <A HREF="/register">fill out the form here</A>.</B>
</P>

<h5 class="my-3">Search here for address</h5>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for addresses ..."></TH>

<table class="table table-striped my-5" id="myTable">	
				
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
			if ( !empty ($var)) { ?>
		<TR>
			<TD>
				<a class="btn btn-primary mr-2 mb-3" href="/apts/<?= $var["Buildings_ID"]  ?>"><i class="fas fa-arrow-alt-circle-right mr-2"></i><span class="d-none d-md-inline"></span></a>
			</TD>			
	
			<TD scope="row"><?= $var["Buildings_Address"]  . " - " . $var["Buildings_AKAAddress"] ?></TD>
			<TD><?= $var["Buildings_Borough"]  ?></TD>
		</TR>	
			
	<?php }
			}
		} ?>			
	</tbody>
	
</table>

<?php 
	include $_SERVER["DOCUMENT_ROOT"] . "/footer/index.php";    	
?>
