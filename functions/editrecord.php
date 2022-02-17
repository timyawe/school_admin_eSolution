<?php
	function editRecord($array_col,$db_conn,$table,$criteria_field,$criteria_value,$msg){
		//echo "hi";
		if(count($array_col)>0){
			foreach($array_col as $fieldname => $value){
				if(mysqli_query($db_conn, "UPDATE $table SET $fieldname = '$value' WHERE $criteria_field=".$criteria_value)){
					$flagraised = true;
				} else {
					$flagraised = false;
				}
			}
			
			if($flagraised){
				echo "<span class='alert-response-success'>$msg details were edited successfully</span>";
			} else {
				echo "<span class='alert-response-error'>Error: ".mysqli_error($db_conn)."</span>";
			}
		} else {
			echo "<span class='alert-response-information'>No Field was edited</span>";
		}	
	}
?>