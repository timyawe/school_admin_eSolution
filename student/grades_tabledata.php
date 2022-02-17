<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	$subs = mysqli_query($conn, "SELECT * FROM Subject_Information ORDER BY `Code`");
	
	if(!empty($_POST['stdID']) && !empty($_POST['classID']) && !empty($_POST['term'])){
		$stdID = $_POST['stdID'];
		$classID = $_POST['classID'];
		$term = $_POST['term'];
		
		
		
		$grades = mysqli_query($conn, "SELECT * FROM StudentGrades WHERE StudentID=$stdID AND ClassID=$classID AND Term='$term'");
	}
	
	if(mysqli_num_rows($subs) >0) {
		echo "<table border='1'>
			<caption>Heading</caption>
			<tr>
				<th>Subject</th>
				<th>BOT</th>
				<th>MOT</th>
				<th>EOT</th>
			</tr>";
		
		$bot_total=0;
		$mot_total=0;
		$eot_total=0;
		while($subsrow = mysqli_fetch_assoc($subs)){
			$sbcd = $subsrow['Code'];
			echo "<tr>";
			echo 	"<td>".$subsrow['Subject_Name']."</td>";
			$bot = mysqli_query($conn, "SELECT Marks FROM Botmarks WHERE StudentID=$stdID AND ClassID=$classID AND SubjectCode=$sbcd AND Term='$term'");
			if($bot){
				if(mysqli_num_rows($bot) >0){
					$botmarks = mysqli_fetch_assoc($bot);
					$bot_total+=$botmarks['Marks'];
					echo 	"<td>".$botmarks['Marks']."</td>";
				}else{
					echo 	"<td>0</td>";
				}
			} else {
				echo 	"<td>0</td>";
			}
			
			$mot = mysqli_query($conn, "SELECT Marks FROM Motmarks WHERE StudentID=$stdID AND ClassID=$classID AND SubjectCode=$sbcd AND Term='$term'");
			if($mot){
				if(mysqli_num_rows($mot) >0){
					$motmarks = mysqli_fetch_assoc($mot);
					$bot_total+=$motmarks['Marks'];
					echo 	"<td>".$motmarks['Marks']."</td>";
				}else{
					echo 	"<td>0</td>";
				}
			}else {
				echo 	"<td>0</td>";
			}
			
			$eot = mysqli_query($conn, "SELECT Marks FROM Eotmarks WHERE StudentID=$stdID AND ClassID=$classID AND SubjectCode=$sbcd AND Term='$term'");
			if($eot){
				if(mysqli_num_rows($bot) >0){
					$eotmarks = mysqli_fetch_assoc($eot);
					$bot_total+=$eotmarks['Marks'];
					echo 	"<td>".$eotmarks['Marks']."</td>";
				}else{
					echo 	"<td>0</td>";
				}
			}else {
				echo 	"<td>0</td>";
			}
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td><strong>Total</strong></td>";
		echo "<td><strong>$bot_total</strong></td>";
		echo "<td><strong>$mot_total</strong></td>";
		echo "<td><strong>$eot_total</strong></td>";
		echo "</tr>";
		echo "</table>";
	}
?>