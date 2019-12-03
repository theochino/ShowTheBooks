<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/../libs/mysql/queries.php";
global $DB;

class housing extends queries {

  function housing ($debug = 0, $DBFile = "DB_Housing") {
	  require $_SERVER["DOCUMENT_ROOT"] . "/../statlib/DBsLogins/" . $DBFile . ".php";
	  $DebugInfo["DBErrorsFilename"] = $DBErrorsFilename;
	  $DebugInfo["Flag"] = $debug;
	 	$this->queries($databasename, $databaseserver, $databaseport, $databaseuser, $databasepassword, $sslkeys, $DebugInfo);
  }
  
 	function AddPersonNotes($BuildingID, $FirstName, $LastName, $Address1, $Address2, $Apt, $Telephone, $Email, $Notes) {
 		$sql = "INSERT INTO PersonNotes SET " .
						"Buildings_ID = :BuildingID, PersonNotes_FirstName = :firstname, PersonNotes_LastName = :lastname, PersonNotes_Address1 = :add1, " . 
						"PersonNotes_Address2 = :add2, PersonNotes_Apt = :apt, PersonNotes_Telephone  = :telephone, PersonNotes_Email = :email, " .
						"PersonNotes_Notes  = :Notes";
						
		$sql_vars = array("BuildingID" => $BuildingID, "firstname" => $FirstName, "lastname"  => $LastName,
							"add1"  => $Address1, "add2" =>   $Address2, "apt"  => $Apt, "telephone" => $Telephone, 
							"email" => $Email, "Notes" =>  $Notes);
							
		return $this->_return_nothing($sql, $sql_vars);
 	}

  function ListDoneHousing($id = 0) {
  	$sql = "SELECT * FROM Buildings LEFT JOIN HouseRes ON (HouseRes.HouseRes_ID = Buildings.HouseRes_ID) " . 
  					"WHERE ";
  
  	if ($id > 0 ) {
  		$sql .= "Buildings.Buildings_ID = :id";
  		$sql_vars["id"] = $id;
  	  		
  		return $this->_return_simple($sql, $sql_vars);	
  	} else {
  		$sql .= "Buildings.HouseRes_ID is not null";
  	}
  			
  	$sql .= " ORDER BY Buildings_Order";
  	return $this->_return_multiple($sql);	
  }
  
	function ListLaws($id = 1) {
		$sql = "SELECT * FROM HouseRes WHERE HouseRes_ID = :id";
		$sql_vars = array("id" => $id);
		return $this->_return_simple($sql, $sql_vars);
	}
	
	function ListHousing($last_order = 0, $limit = 15, $reso_id = 0) {
		$sql = "SELECT * FROM Buildings WHERE HouseRes_ID is null AND Buildings_Show = 'yes' ";
			
		if ( $last_order > 0) {
			$sql .= " AND Buildings_Order > :LastOrder ";
			$sql_vars["LastOrder"] = $last_order;
			$sql .= "ORDER BY Buildings_Order LIMIT $limit";		
			return $this->_return_multiple($sql, $sql_vars);
		}
		
		$sql .= "ORDER BY Buildings_Order LIMIT $limit";		
		return $this->_return_multiple($sql);
	}
	
	function PostPoneResoID($resoid, $setting = 'yes') {
		$sql = "UPDATE HouseRes SET HouseRes_Postpone = :Setting WHERE HouseRes_ID = :ResID";
		$sql_vars = array("Setting" => $setting, "ResID" => $resoid);
		return $this->_return_nothing($sql, $sql_vars);
	}
	
	function UpdateResolink($resoid, $Link) {
		$sql = "UPDATE HouseRes SET HouseRes_Link = :Link WHERE HouseRes_ID = :ResID";
		$sql_vars = array("Link" => $Link, "ResID" => $resoid);
		return $this->_return_nothing($sql, $sql_vars);
	}
	
	function UpdateHousing($resoid, $BuildingID, $Block, $Lot, $Borough, $law) {
		$sql = "UPDATE Buildings SET ";

		$sql_vars = array("resid" => $resoid,  "BuildingID" => $BuildingID);		
		
		if ( ! empty ($Borough) ) {	$sql_vars["Borough"] = $Borough; $sql .= "Buildings_Borough = :Borough,"; }
		if ( ! empty ($law) ) {	$sql_vars["law"] = $law; $sql .= "Buildings_Law = :law,"; }
		if ( $Block > 0 ) {	$sql_vars["Block"] = $Block; $sql .= "Buildings_Block = :Block,"; }
		if ( $Lot > 0 ) {	$sql_vars["Lot"] = $Lot; $sql .= "Buildings_Lot = :Lot,"; }
		
		$sql .= "HouseRes_ID = :resid WHERE Buildings_ID = :BuildingID";
		return $this->_return_nothing($sql, $sql_vars);		
	}
	
	function RandomResoToFind() {
		$sql = "SELECT * FROM HouseRes LEFT JOIN ResoLink ON (ResoLink.HouseRes_ID = HouseRes.HouseRes_ID) " .
						"WHERE HouseRes_Link IS NULL AND ResoLink_Link IS NULL ORDER BY RAND() LIMIT 1";		
		return $this->_return_simple($sql);		
	}
	
	function SaveResoLink($HouseResID, $Link, $SearchValue) {
		$sql = "INSERT INTO ResoLink SET " .
						"HouseRes_ID = :HouseResID, ResoLink_Link = :ResoLink, ResoLink_SearchValue = :ResoSearch";
		$sql_vars = array("HouseResID" => $HouseResID, "ResoSearch" => $SearchValue, "ResoLink" => $Link);
		return $this->_return_nothing($sql, $sql_vars);	
	}
	
	function BuildingByID($BuildID) {
		$sql = "SELECT * FROM Buildings WHERE Buildings_ID = :id";
	//	$sql_vars = array("
	}
	
	function PrintNewsStory($BuildID = 0) {
		$sql = "SELECT * FROM BuildingStory LEFT JOIN NewsStories ON (NewsStories.NewsStories_ID = BuildingStory.NewsStories_ID) ";
		
		if ( empty ($BuildID) ) {
			$sql .= " LEFT JOIN Buildings ON (Buildings.Buildings_ID = BuildingStory.Buildings_ID) ";
			$sql .= "ORDER BY NewsStories_Date DESC";
			return $this->_return_multiple($sql);
		}

		$sql .= "WHERE BuildingStory.Buildings_ID = :id ORDER BY NewsStories_Date DESC";
		$sql_vars = array("id" => $BuildID);	
		return $this->_return_multiple($sql, $sql_vars);
			
	}
	
	function PrintTestimonial($BuildID) {
		$sql = "SELECT * FROM Testimonial WHERE Buildings_ID = :id";
		$sql_vars = array("id" => $BuildID);
		return $this->_return_multiple($sql, $sql_vars);
	}

	function SaveEmail($email) {
		$sql = "SELECT * FROM Email WHERE Email_Number = :email";
		$sql_vars = array("email" => $email);
		$result = $this->_return_multiple($sql, $sql_vars);
		
		if ( ! empty($result)) {
			return $result;
		}
		
		$sql = "INSERT INTO Email SET Email_Number = :email, Email_Contact = 'yes'";
		return $this->_return_nothing($sql, $sql_vars);
	}	
	
	function SaveJoinEvent($name, $email, $action, $notes) {
				
		$sql = "INSERT INTO Contacts SET PersonNotes_FirstName = :name";
		$sql_vars = array("name" => $name);
		$this->_return_nothing($sql, $sql_vars);
		
		$sql = "SELECT LAST_INSERT_ID() as ID";
		$return = $this->_return_simple($sql);		
		$ContactID = $return["ID"];
		
		$sql = "SELECT * FROM Email WHERE Email_Number = :email";
		$sql_vars = array("email" => $email);
		$result = $this->_return_simple($sql, $sql_vars);
		
		echo "RESULT<PRE>";
		print_r($result);
		echo "</PRE>";
		
		if ( empty($result)) {
			$sql = "INSERT INTO Email SET Email_Number = :email, Email_Contact = 'yes'";
			$this->_return_nothing($sql, $sql_vars);
			$sql = "SELECT LAST_INSERT_ID() as ID";
			$return = $this->_return_simple($sql);		
			$EmailID = $return["ID"];
		} else {
			$EmailID = $result["Email_ID"];
		}
	
		$sql = "INSERT INTO L_Contacts_Email SET Email_ID = :emailid, Contacts_ID = :contactid";
		$sql_vars = array("emailid" => $EmailID, "contactid" => $ContactID);
		$this->_return_nothing($sql, $sql_vars);
		
				
		$sql = "INSERT INTO Notes SET Notes_Notes = :Notes, Notes_TimeStamp = NOW()";
		$Whole = "Action: " . $action . " - Note: " . $notes;
		
		echo $Whole . "<BR>";
		
		$sql_vars = array("Notes" => $Whole);
		$this->_return_nothing($sql, $sql_vars);
		
		$sql = "SELECT LAST_INSERT_ID() as ID";
		$return = $this->_return_simple($sql);
		$NotesID = $return["ID"];
		
		$sql = "INSERT INTO L_Contacts_Notes SET Notes_ID = :noteid, Contacts_ID = :contactid";
		$sql_vars = array("noteid" => $NotesID, "contactid" => $ContactID);
		$this->_return_nothing($sql, $sql_vars);
		
		return;
		
	}
	
	function ReadTestimonyLong() {
		$sql = "SELECT * FROM UnsortTestimony WHERE  UnsortTestimony_Print = 'yes'";
		return $this->_return_multiple($sql);
		
	}
	
	function SaveTestimonyLong($fname, $lname, $address, $apt, $borough, $zipcode, $email, $tel, $satisfaction, $testimony, $share) {
		$sql = "INSERT INTO UnsortTestimony SET " .
						"UnsortTestimony_FirstName = :fname, UnsortTestimony_LastName = :lname, " .
						"UnsortTestimony_Address = :address, UnsortTestimony_Apt = :apt, " .
						"UnsortTestimony_Borough = :borough, UnsortTestimony_Zipcode = :zipcode, " .
						"UnsortTestimony_Email = :email, UnsortTestimony_Telephone = :tel, " .
						"UnsortTestimony_Satisfaction = :satisfaction, UnsortTestimony_Testimony = :testimony, " . 
						"UnsortTestimony_AllowShare = :share";
		 
		$sql_vars = array(":fname" => $fname, ":lname" => $lname, ":address" => $address, 
											":apt" => $apt, ":borough" => $borough, ":zipcode" => $zipcode, 
											":email" => $email, ":tel" => $tel, ":satisfaction" => $satisfaction, 
											":testimony" => $testimony, ":share" => $share);
		
		return $this->_return_nothing($sql, $sql_vars);
	}
}
?>
