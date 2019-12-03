<?php
	date_default_timezone_set('America/New_York'); 
	
		// This is to load the menus groupping
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/funcs/general.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/db/db_housing.php";
		require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/common/verif_sec.php";
	
		$r = new housing();		
		$result = $r->ReadTestimonyLong();
		
	
	//include $_SERVER["DOCUMENT_ROOT"] . "/headers/index.php";
	//include $_SERVER["DOCUMENT_ROOT"] . "/sidebar/index.php";
	// include $_SERVER["DOCUMENT_ROOT"] . "/intro/index.php";
?>


<TABLE BORDER=1>
<TR>
	<TD>ID</TD>
	<TD>FirstName</TD>
	<TD>LastName</TD>
	<TD>Address</TD>
	<TD>Apt</TD>
	<TD>Borough</TD>
	<TD>Zipcode</TD>
	<TD>Email</TD>
	<TD>Telephone</TD>
	<TD>Satisfaction</TD>
	<TD>AllowShare</TD>
</TR>


<?php
	if (! empty ($result)) {
		foreach ($result as $var) {
			if (!empty ($var)) {
				?>
			<TR VALIGN=TOP>
				<TD><?= $var["UnsortTestimony_ID"] ?></TD>
        <TD><?= $var["UnsortTestimony_FirstName_KEEP"] ?></TD>
        <TD><?= $var["UnsortTestimony_LastName_KEEP"] ?></TD>
        <TD><?= $var["UnsortTestimony_Address"] ?></TD>
        <TD><?= $var["UnsortTestimony_Apt_KEEP"] ?></TD>
        <TD><?= $var["UnsortTestimony_Borough"] ?></TD>
        <TD><?= $var["UnsortTestimony_Zipcode"] ?></TD>
        <TD><?= $var["UnsortTestimony_Email_KEEP"] ?></TD>
        <TD><?= $var["UnsortTestimony_Telephone_KEEP"] ?></TD>
        <TD ALIGN=CENTER><?= $var["UnsortTestimony_Satisfaction"] ?></TD>
        <TD ALIGN=CENTER><?= $var["UnsortTestimony_AllowShare"] ?></TD>
			</TR>	
			
			<TR VALIGN=TOP>
				<TD>&nbsp;</TD>
        <TD COLSPAN=8><?= $var["UnsortTestimony_Testimony"] ?></TD>
				 <TD>&nbsp;</TD>
				 <TD>&nbsp;</TD>
			</TR>	
				
<?php
			}
		}
	}
?>
</TABLE>