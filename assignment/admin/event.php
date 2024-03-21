<?php //session_start();?>
<?php include('includes/header.php');?>
<?php include('includes/sideNav.php');?>
<?php include('php/con_db.php');?>
<button class="btn" onclick="window.location.href='addEvent.php'">Add Event</button>
<?php
  $query = mysqli_query($con, "SELECT * FROM events");
  while($result = mysqli_fetch_assoc($query)){?>
  <div class="event">
      <table>
          <tr>
              <th>ID</th>
              <th>Event Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
              <th>Description</th>
          </tr>
          <tr>
              <td><?php echo $result['EventID'];?></td>
              <td><?php echo $result['Title'];?></td>
              <td><?php echo $result['Date'];?></td>
              <td><?php echo $result['Time_Start'].' - '.$result['Time_End']; ?></td>
              <td><?php echo $result['Venue'];?></td>
              <td><?php echo $result['Description'];?></td>
              <?php// $_SESSION['Event_Id'] = $result['EventID'];?>
              <td><a href="editEvent.php?Id=<?php echo $result['EventID'];?>">Edit</a></td>
              <td><a href="deleteEvent.php?Id=<?php echo $result['EventID'];?>">Delete</a></td>
          </tr>
    </table>
  </div>
  <?php } ?>

<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>