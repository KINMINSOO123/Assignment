<?php include('php/con_db.php');
if(isset($_GET['Id'])){
  $id = $_GET['Id'];
  $query = mysqli_query($con, "DELETE FROM events WHERE EventID = '$id'");
  if($query){
    echo "<script>alert('Event deleted successfully')</script>";
    header("Location: event.php");
  }else{
    echo "<script>alert('Failed to delete event')</script>";
    header('Location: event.php');
  }
}