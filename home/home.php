<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="home2.php">
</head>
<body>
  
    <form>
    <nav>
        <div class='yt'>
            <img src="https://www.liblogo.com/img-logo/yo482f28b-youtube-icon-logo-free-youtube-logo-icon-symbol-png-svg-download.png"class='input7'/>
            <div class="input2">
              <a href="#"><i class="bi bi-house-door">&nbsp;&nbsp;Home</i></a><br>
              <a href="#"><i class="bi bi-house-door">&nbsp;&nbsp;Explore</p></i></a>
              <a href="#"><i class="bi bi-collection-play">&nbsp;&nbsp;Subscription</p></i></a>
              <a href="#"><i class="bi bi-bag">&nbsp;&nbsp;Library</p></i></a>
              <a href="#"><i class="bi bi-eye">&nbsp;&nbsp;History</p></i></a>
              <a href="#"><i class="bi bi-house">&nbsp;&nbsp;Playist</p></i></a>
              <a href="#"><i class="bi bi-envelope">&nbsp;&nbsp;Messages</p></i></a>
              <a href="#"><i class="bi bi-gear">&nbsp;&nbsp;Settings</p></i></a>
              <a href="../login/login.html"><i class="bi bi-box-arrow-right">&nbsp;&nbsp;Logout</p></i></a>
            </div>
        </div>
        <ul>
              <lable class='ot'>YouThoob</lable>
            <li class='rt'>
            <input type="search" class="searchbox" placeholder='search'><button type="submit" class="input3"><i class="bi bi-search"></i></button>
            </li>
            <i class="bi bi-mic-fill" style="height: 100px;"></i>
                      <div class="input1">
                    
                        <li><a href="../login/login.html"><i class="bi bi-box-arrow-right"></i></a></li>
                        <li><a href="../upload_vid/createvideo.html"><i class="bi bi-camera-video"></i></a></li>
                        <li><a href="#"><i class="bi bi-bell"></i></a></li>
                        <li><a href="#"><img src="images/wpl\google.jpg.png"></a></li>

                      </div>
                    </ul>
            </nav>
            <div class="input5">
            <?php
        include('../db.php');
        $q="SELECT * FROM video";
        $r="SELECT * FROM createaccount";
        $query=mysqli_query($conn,$q);
        $query1=mysqli_query($conn,$r);
        $row1=mysqli_fetch_array($query1);
        while($row=mysqli_fetch_array($query)){
          ?>
          &nbsp;&nbsp;&nbsp;<div style="display: inline-block;">
          <a href="../comments/comments.php?id=<?php echo $row['video_id']; ?>" class="input13">
            <video width="320" height="240" controls="" autoplay="" loop="">  
            <source src="<?php echo '../uploaded_vid/'.$row['name'];?>">
            </video>
            <div class="input17">
    <br><h3 class="input123" style="display: inline-block; font-size:50px "><?php echo $row['title'];?></h3><br>
    <p class="input12">3k views &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F j, Y', strtotime($row['date'])); ?></p>
    <p class="input12">&nbsp; <?php echo $row['username'];?></p>
</div>
      </div>
        </a>
<?php
}
?>

    </form>
</body>
</html>
