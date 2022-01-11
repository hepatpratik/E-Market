<?php
$userid=$_SESSION['USER_ID'];
$userData=mysqli_fetch_assoc(mysqli_query($con,"select users.* from users where users.id='$userid' "));
?>
<div class="headbanner">
    <div class="userimage">
        <img src="assets/images/img-5.jpg" alt="" />
    </div>
    <h4><?php echo $userData['name'] ?></h4>
    <p>
        +91 <?php echo $userData['mobile'] ?>
        <a href="#"><i class="uil uil-edit"></i></a>
    </p>
    
</div>