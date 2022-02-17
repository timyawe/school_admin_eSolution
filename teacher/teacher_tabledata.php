<?php 
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	require $_SERVER['DOCUMENT_ROOT']."/includes/output/selectqueries.inc";
?>
<table border="1">
				<caption>Table Heading<span>Search Table</span></caption>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Classes</th>
					<th>Subjects</th>
					<th>Role</th>
					<th></th>
				</tr>
				
				<?php
				if (mysqli_num_rows($teacher_selectsqlresult) > 0) {
					while ($tchrow = mysqli_fetch_assoc($teacher_selectsqlresult)){
						$ID = $tchrow['ID'];
						$name = $tchrow['SurName']. " ". $tchrow['FirstName'];
						$gender = $tchrow['Gender'];
						echo "<tr>";
						echo "<td>$ID</td>";
						echo "<td>$name</td>";
						echo "<td>$gender</td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td><button class='edits' onclick='edit(this)'>Edit</button> | <a href='#!/teacher/details/$ID'>More</a></td>";
						echo "</tr>";
					}
				} else {
					echo mysqli_error($conn);
				}
			?>
				<!--<tr>
					<td>1</td>
					<td>Mr Right</td>
					<td>2</td>
					<td>2</td>
					<td>Class Teacher</td>
					<td><a href="#!/teacher/details">More</a> | <a href="#!/teacher/edit">Edit</a></td>
				</tr>-->
			</table>