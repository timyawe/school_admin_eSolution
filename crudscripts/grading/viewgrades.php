<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if($_POST['classopt'] != "" && $_POST['subjopt'] != "" && $_POST['grdfor'] != ""){
		$classID = $_POST['classopt'];
		$subjID = $_POST['subjopt'];
		$grdfor = $_POST['grdfor'];
		
		$grades = mysqli_query($conn, "SELECT * FROM Grading_Information WHERE ClassID=$classID AND SubjectCode=$subjID AND MarkFor='$grdfor'");
		
		if(mysqli_num_rows($grades) > 0){
			echo "<table border='1'>
				<caption>Table Heading<span>Search Table</span></caption>
				<tr>
					<th>Name</th>
					<th>Mark</th>
				</tr>";
			while($gradesrow = mysqli_fetch_assoc($grades)){
				echo "<tr>";
				echo 	"<td>".$gradesrow['StudentID']."</td>";
				echo	"<td>".$gradesrow['Marks']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo mysqli_error($conn);
		}
	}
	
	
?>