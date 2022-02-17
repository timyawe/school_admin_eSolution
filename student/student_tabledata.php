<?php
	//connect to database
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	
	if ($_POST['classopt'] != "" && $_POST['sectopt'] != "") {
		$stdsqlresult = mysqli_query($conn, "SELECT ID_No,FullName, Age, Gender, Section FROM StudentList WHERE ClassID=".$_POST['classopt'].
		  " AND SectionID=" .$_POST['sectopt'] );
		
		$classnamerow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Class_Name FROM Class_Information WHERE ID=". $_POST['classopt']));
	}
	
	
?>
<table border="1">
	<caption><?php if($classnamerow){echo $classnamerow['Class_Name']. " Student List";} ?><span>Search Table</span></caption>
		<tr>
				<th>No</th>
				<th>ID</th>
				<th>Name</th>
				<th>Age</th>
				<th>Gender</th>
				<th>Section</th>
				<th></th>
			</tr>
			
			<?php
				if (mysqli_num_rows($stdsqlresult) > 0) {
					while ($stdrow = mysqli_fetch_assoc($stdsqlresult)){
						$counter = 1;
						$ID_No = $stdrow['ID_No'];
						$name = $stdrow['FullName'];
						$age = $stdrow['Age'];
						$gender = $stdrow['Gender'];
						$section = $stdrow['Section'];
						echo "<tr>";
						echo "<td>$counter</td>";
						echo "<td>$ID_No</td>";
						echo "<td>$name</td>";
						echo "<td>$age</td>";
						echo "<td>$gender</td>";
						echo "<td>$section</td>";
						echo "<td><button class='edits' onclick='edit(this)'>Edit</button> | <a href='#!student/details/$ID_No'>More</a></td>";
						echo "</tr>";
						$counter++;
					}
				} else {
					echo mysqli_error($conn);
				}
			?>
		<!--	<tr>
				<td>1</td>
				<td>Buggs Bunny</td>
				<td>M</td>
				<td>Day</td>
				<td><button class="edits" >Edit</button> | <a href="#!student/details">More</a></td>
		</tr>-->
</table>

<script>
var _row = null;
	function edit(btn) {
		_row = jquery(btn).parents("tr");
		var col = _row.children("td");
		var stdID = jquery(col[0]).text();
		
		jquery('.modal-body').load('student/edit',{"stdID":stdID}, function() {
		jquery('#editModal').modal({show:true});
	});
	}

/*jquery(".edits").click(function() {
		jquery('.modal-body').load('student/edit', function() {
		jquery('#editModal').modal({show:true});
	});
	});*/
</script>