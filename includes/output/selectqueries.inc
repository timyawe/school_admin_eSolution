<?php
$class_selectsqlresult = mysqli_query($conn, "SELECT * FROM Class_Information");
$section_selectsqlresult = mysqli_query($conn, "SELECT * FROM Section_Information");
$requirements_selectsqlresult = mysqli_query($conn, "SELECT * FROM Requirements_Information");
$subject_selectsqlresult = mysqli_query($conn, "SELECT * FROM Subject_Information");
$student_selectsqlresult = mysqli_query($conn, "SELECT * FROM Student_Information");
$teacher_selectsqlresult = mysqli_query($conn, "SELECT * FROM Teacher_Information");
$teacher_roles_selectsqlresult = mysqli_query($conn, "SELECT * FROM AssignedRoles");
?>