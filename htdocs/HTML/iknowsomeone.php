<?php

	date_default_timezone_set('America/New_York'); 
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
	$r = new housing();
	
	if ( empty ($_POST)) {
		$_POST["1"] = "ON";
	}
	
	if ( ! empty ($_POST["FirstName"] )) {		
		$r->AddPersonNotes($_POST["BuildingID"], $_POST["FirstName"], $_POST["LastName"], $_POST["Address1"], $_POST["Address2"], 
												$_POST["Apt"], $_POST["Telephone"], $_POST["Email"], $_POST["Notes"]);			
												
		echo "Should we go to thanks.php";			
		header("Location: thanks.php");
		exit();
	} 
		
	foreach ($_POST as $var => $index) {
		$housing = $r->ListDoneHousing($var);		
	}

?>


<H1>Show The Books</H1>

<P>
	If you know someone that live at <FONT COLOR=BROWN><B><?= $housing["Buildings_Address"] ?></B></FONT> 
	in <?= ucwords(strtolower($housing["Buildings_Borough"])); ?>.<BR>
	Please fill the form below and someone will contact shortly.
</P>

<P>

<FORM ACTION="" METHOD="POST">
	<INPUT TYPE="HIDDEN" NAME="BuildingID" VALUE="<?= $var ?>">
	<TABLE BORDER=1>
		<TR>
			<TD>First Name</TD><TD><INPUT TYPE="TEXT" SIZE=20 NAME="FirstName"></TD>
			<TD>Last Name</TD><TD><INPUT TYPE="TEXT" SIZE=20 NAME="LastName"></TD>
		</TR>
		<TR><TD>Address</TD><TD COLSPAN=3><INPUT TYPE="TEXT" SIZE=60 NAME="Address1"></TD></TR>
		<TR>
			<TD>&nbsp;</TD><TD><INPUT TYPE="TEXT" SIZE=30 NAME="Address2"></TD>
			<TD>Apt #</TD><TD><INPUT TYPE="TEXT" SIZE=7 NAME="Apt"></TD>
		</TR>
		<TR><TD>Telephone</TD><TD COLSPAN=3><INPUT TYPE="TEXT" SIZE=60 NAME="Telephone"></TD></TR>
		<TR><TD>Email</TD><TD COLSPAN=3><INPUT TYPE="TEXT" SIZE=60 NAME="Email"></TD></TR>
		<TR><TD>Any comments</TD><TD COLSPAN=3><TEXTAREA NAME="Notes" COLS=50 ROWS=4></TEXTAREA></TD></TR>
		
		<TR><TD COLSPAN=3>&nbsp;</TD><TD><INPUT TYPE="SUBMIT" VALUE="Record the Information"></TD></TR>
		
	</TABLE>
</FORM>

</P>