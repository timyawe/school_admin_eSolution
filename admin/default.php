<?php //connect to database 
	require $_SERVER['DOCUMENT_ROOT']."/dbconn.inc";
	?>
	
<div class="page-title-container">
	<h2>Admin</h2>
</div>
	<!--<div id="editModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body"></div>
			</div>
		</div>
	</div>-->

<div class="page-container">
	<div class="admin-section">
		<div class="admin-section-title"><h3>Section Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<button id="sect-btn">Edit Section</button>
			</div>
			<hr/>
		</div>
	</div>
	
	<div class="admin-section">
	<?php
		$termsqlrst = mysqli_query($conn, "SELECT * FROM SchoolTerm_Information ORDER BY ID DESC LIMIT 1");
		if($termsqlrst){
			$termrow = mysqli_fetch_assoc($termsqlrst);
			$termdesc = $termrow['Description'];
			$termfro = $termrow['Start_Date'];
			$termto = $termrow['End_Date'];
		}
	?>
		<div class="admin-section-title"><h3>School Term Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<p>Current School Term: <?php echo $termdesc; ?></p>
			</div>
			
			<div class="admin-section-content-item">
				<p>Current Term Period: <?php echo date("d/m/Y", strtotime($termfro))." - ".date("d/m/Y", strtotime($termto)); ?></p>
			</div>
			
			<div class="admin-section-content-item">
				<button id="schterm-btn">New School Term Details</button>
				<button id="editschterm">Edit Current School Term</button>
			</div>
			<hr/>
		</div>
	</div>
	
	<div class="admin-section">
		<div class="admin-section-title"><h3>Class Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<p>No of Classes:</p><span>10</span>
			</div>
			
			<div class="admin-section-content-item">
				<button>Add New Class</button>
			</div>
			
			<div class="admin-section-content-item">
				<button>View Classes</button>
			</div>
			<hr/>
		</div>
	</div>
	
	<div class="admin-section">
	<?php 
		$subsql = mysqli_query($conn, "SELECT * FROM Subject_Information");
	?>
		<div class="admin-section-title"><h3>Subject Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<p>No of Subjects: <?php echo mysqli_num_rows($subsql);?></p>
			</div>
			
			<div class="admin-section-content-item">
				<button id="addsubj-btn">Add New Subject</button>
			</div>
			
			<div class="admin-section-content-item">
				<?php 
					if($subsql){
						$counter = 1;
						echo "<table border=1>";
						echo "<tr><th>No.</th><th>Description</th><th>Edit</th></tr>";
						while($subrow = mysqli_fetch_assoc($subsql)){
							echo "<tr><td hidden>".$subrow['Code']."</td>";
							echo "<td>$counter</td>";
							echo "<td>".$subrow['Subject_Name']."</td>";
							echo "<td><button class='editsub'>Edit</button></td>";
							echo "</tr>";
							$counter++;
						}
						echo "</table>";
					}						
				?>
			</div>
			<hr/>
		</div>
	</div>
	
	<div class="admin-section">
		<div class="admin-section-title"><h3>Payments Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<a href="#!admin/fees_structure">View Fees Structure</a>
			</div>
			
			<div class="admin-section-content-item">
				<a href="#!admin/requirements">View Requirements</a>
			</div>
			
			<div class="admin-section-content-item">
				
			</div>
			<hr/>
		</div>
	</div>
	
	<div class="admin-section">
		<div class="admin-section-title"><h3>Users Information</h3></div>
		<div class="admin-section-content">
			<div class="admin-section-content-item">
				<button>Add User</button>
			</div>
			
			<div class="admin-section-content-item">
				<button>View Users</button>
			</div>
			
			<div class="admin-section-content-item">
				<button>Users Activity</button>
			</div>
		</div>
	</div>
</div>

<script>
	jquery("#schterm-btn").click(function(){
		jquery(".modal-body").load("admin/school_term/edit", function() {
			jquery("#editModal").modal({show:true});
		});
	});
	
	jquery("#editschterm").click(function(){
		var schtermID = <?php echo $termrow['ID']; ?>;
		jquery(".modal-body").load("admin/school_term/edit", {"schtermID":schtermID}, function() {
			jquery("#editModal").modal({show:true});
		});
	});
	
	jquery("#sect-btn").click(function(){
		jquery(".modal-body").load("admin/section/edit", function(){
			jquery("#editModal").modal({show:true, keyboard:true});
		});
	});
	
	jquery("#addsubj-btn").click(function(){
		jquery(".modal-body").load("subject/edit", function() {
			jquery("#editModal").modal({show:true});
		});
	});
	
	jquery(".editsub").click(function(){
		var row = jquery(this).parents("tr");
		var col = row.children("td");
		var subcode = jquery(col[0]).text();
		
		jquery(".modal-body").load("subject/edit", {"subcode":subcode}, function(){
		jquery("#editModal").modal({show:true});
		});
	});
	
</script>