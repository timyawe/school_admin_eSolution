<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
	
	if(isset($_POST['roleopt'])){
		$tchroleID = mysqli_query($conn, "SELECT TeacherID FROM TeacherRoles_Information WHERE RoleID=".$_POST['roleopt']);
		
		if (mysqli_num_rows($tchroleID) > 0) {
			while ($tchroleIDrow = mysqli_fetch_assoc($tchroleID) /*= mysqli_fetch_assoc($teacher_selectsqlresult) /*&& $tchclassrow*/ ){
				if(mysqli_query($conn, "SELECT SurName, FirstName FROM Teacher_Information WHERE ID=".$tchroleIDrow['TeacherID'])){
					echo "<input type='checkbox' checked />Mr Uptight";
				}
			}
		} else{
			echo "<label>No Techers Assigned to this role</label>";
		}
			/*	$tchID = $tchroleIDrow['TeacherID'];
				if ($classID == $classrow['ID']) {
				echo "<input type='checkbox' value='".$classrow['ID']."' checked />".$classrow['Class_Name']."<br/>";
				} else {
					echo "<input type='checkbox' name='class[]' value='".$classrow['ID']."'/>".$classrow['Class_Name']."<br/>";
				}
			}
		}*/
	}	


?>