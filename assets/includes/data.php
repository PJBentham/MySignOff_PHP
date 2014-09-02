<?php

try {
	$db = new PDO("mysql:host=localhost;dbname=mysignoff_db;","second_user","V0!.]7RA[eVb");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e){
	echo "oops something went wrong: ".$e;
}

try {
	$results = $db->query("SELECT * FROM mysignoff_db.jewellerybay");
	$items = $results->fetchAll(PDO::FETCH_ASSOC);
}
catch (Exception $e){
	echo "oops something went wrong: ".$e;
}

try {
	$lockerresults = $db->query("SELECT * FROM mysignoff_db.locker");
	$lockers = $lockerresults->fetchAll(PDO::FETCH_ASSOC);
}
catch (Exception $e){
	echo "oops something went wrong: ".$e;
}

function getSignOffs($items){
	foreach($items as $item){
		echo "<tr>";
		echo	"<td><a style='color: black;' href='".$item["File"]."'><span class='glyphicon glyphicon-cloud-download'></span></a></td>";
		echo	"<td>".$item["Location"]."</td>";
		echo	"<td>".$item["Job Number"]."</td>";
		echo	"<td>".$item["PO Number"]."</td>";
		echo	"<td>".$item["Date"]."</td>";
		echo	"<td>".$item["Name"]."</td>";
		echo	"<td>".$item["Photo"]."</td>";
		echo "</tr>";
	}
}

function getLockerSignOffs($lockers){
	foreach($lockers as $locker){
		echo "<tr>";
		echo	"<td><a style='color: black;' href='".$locker["File"]."'><span class='glyphicon glyphicon-cloud-download'></span></a></td>";
		echo	"<td>".$locker["Storenumber"]."</td>";
		echo	"<td>".$locker["Storename"]."</td>";
		echo	"<td>".$locker["Fittername"]."</td>";
		echo	"<td>".$locker["Date"]."</td>";
		echo	"<td>".$locker["Revisit"]."</td>";
		echo	"<td>".$locker["Fittrade"]."</td>";
		echo	"<td>".$locker["Permit"]."</td>";
		echo	"<td>".$locker["Dressed"]."</td>";
		echo	"<td>".$locker["Disruption"]."</td>";
		echo	"<td>".$locker["Called"]."</td>";
		echo	"<td>".$locker["WGLL"]."</td>";
		echo	"<td>".$locker["Workplan"]."</td>";
		echo	"<td>".$locker["Complete"]."</td>";
		echo	"<td>".$locker["Managername"]."</td>";
		echo	"<td>".$locker["Title"]."</td>";
		echo	"<td>".$locker["TrafficLight"]."</td>";
		echo "</tr>";
	}
}

function addSignOff($db, $file, $location, $jnumber, $ponumber, $x, $name, $photo){
	try {
		$stmt = $db->prepare("	INSERT INTO mysignoff_db.jewellerybay (File, Location, `Job Number`, `PO Number`, `Date`, Name, Photo) VALUES (?, ?, ?, ?, ?, ?, ?);");
		$stmt->bindParam(1, $file);
		$stmt->bindParam(2, $location);
		$stmt->bindParam(3, $jnumber);
		$stmt->bindParam(4, $ponumber);
		$stmt->bindParam(5, $x);
		$stmt->bindParam(6, $name);
		$stmt->bindParam(7, $photo);	
		$stmt->execute();
	}
	catch (Exception $e){
		echo "<p>oops something went wrong: ".$e."</p>";
	}
}
	
function addLockerSignOff($db, $file, $Date1, $StoreName, $StoreNumber, $FitterName, $revisit, $fittrade, $permit, $dressed, $disruption, $called, $wgll, $workplan, $complete, $Name, $JobTitle, $Trafficlight){
	try {
		$stmt = $db->prepare("	INSERT INTO mysignoff_db.locker (File, `Date`, Storename, Storenumber, FitterName, Revisit, Fittrade, Permit, Dressed, Disruption, Called, WGLL, Workplan, Complete, Managername, Title, TrafficLight) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
		$stmt->bindParam(1, $file);
		$stmt->bindParam(2, $Date1);
		$stmt->bindParam(3, $StoreName);
		$stmt->bindParam(4, $StoreNumber);
		$stmt->bindParam(5, $FitterName);
		$stmt->bindParam(6, $revisit);
		$stmt->bindParam(7, $fittrade);
		$stmt->bindParam(8, $permit);
		$stmt->bindParam(9, $dressed);
		$stmt->bindParam(10, $disruption);
		$stmt->bindParam(11, $called);
		$stmt->bindParam(12, $wgll);
		$stmt->bindParam(13, $workplan);
		$stmt->bindParam(14, $complete);
		$stmt->bindParam(15, $Name);
		$stmt->bindParam(16, $JobTitle);
		$stmt->bindParam(17, $Trafficlight);	
		$stmt->execute();
	}
	catch (Exception $e){
		echo "<p>oops something went wrong: ".$e."</p>";
	}
}	
function getProjects($user){	
	try {
		$db = new PDO("mysql:host=localhost;dbname=mysignoff_db;","second_user","V0!.]7RA[eVb");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e){
		echo "oops something went wrong: ".$e;
	}
	try {
		$results = $db->query("SELECT * FROM projects JOIN member_projects ON member_projects.projectid = projects.id WHERE user = '".$user."'");
		$projects = $results->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (Exception $e){
		echo "oops something went wrong: ".$e;
	}
	if (checkMemberType($user) == 1){
		foreach($projects as $project){
			echo	"<a style='color:SlateGray; text-decoration:underline' href=../".$project["db_url"].">".$project["description"]."</a><br>";
		}
	}
	elseif (checkMemberType($user) == 2){
		foreach($projects as $project){
			echo	"<a style='color:SlateGray;' href=../".$project["form_url"].">".$project["description"]."</a><br>";
		}	
	}
	}

function checkValidProjectMember($user, $url){	
	try {
		$db = new PDO("mysql:host=localhost;dbname=mysignoff_db;","second_user","V0!.]7RA[eVb");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e){
		echo "oops something went wrong: ".$e;
	}
	if (checkMemberType($user) == 1){
		try {
			$results = $db->query("	SELECT * FROM projects p JOIN member_projects mp 
									ON mp.projectid = p.id 
									WHERE user = '".$user."'
									AND db_url LIKE '%".$url."%'");
			$projects = $results->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (Exception $e){
			echo "oops something went wrong: ".$e;
		}
	} 
	elseif (checkMemberType($user) == 2) {
		try {
			$results = $db->query("	SELECT * FROM projects p JOIN member_projects mp 
									ON mp.projectid = p.id 
									WHERE user = '".$user."'
									AND form_url LIKE '%".$url."%'");
			$projects = $results->fetchAll(PDO::FETCH_ASSOC);
			}
		catch (Exception $e){
			echo "oops something went wrong: ".$e;
		}	# code...
	}
	if(count($projects) >= 1){
		return true;
	}
	else {
		return false;
	}
}	

function checkMemberType($user){
	try {
		$db = new PDO("mysql:host=localhost;dbname=mysignoff_db;","second_user","V0!.]7RA[eVb");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e){
		echo "oops something went wrong: ".$e;
	}
	try {
		$results = $db->query("	SELECT * FROM members 
								WHERE username = '".$user."' ");
		$infos = $results->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (Exception $e){
			echo "oops something went wrong: ".$e;
		}
	foreach($infos as $info){
		return $info["UserType"];
	}
}

?>