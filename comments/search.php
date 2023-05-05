<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICON -->
    <link rel="icon" type="image/jpg" href="../images/icon.png"/>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <title>Search</title>
    <link rel="stylesheet" href="comments.css">
</head>
<body>

    <div class="headbar">
        <div class="yt"> 
            <img class="yt-icon" src="../images/icon.png"/> 
            <div class="yt-head">You2ube</div>
        </div>

        <?php
        include('../db.php');
        session_start();
        $q="SELECT * FROM video";
        $r="SELECT * FROM createaccount WHERE email='".$_SESSION['email']."'";
        $query=mysqli_query($conn,$q);
        $query1=mysqli_query($conn,$r);
        $row1=mysqli_fetch_array($query1);
        ?>      
        <form action="search.php" method="GET">
            <div class="searchbox">
                <input type="search" class="search" name="search" id="Search" placeholder='search'>
                <button type="submit" class="submit"><i class="bi bi-search"></i></button>
            </div>
            </li>
        </form>
            <div class="links">
                <a href="../home/home.html"><i class="bi bi-house-door"></i></a></li>
                <a href="../upload_vid/createvideo.html"><i class="bi bi-plus-square"></i></a></li>
                <a href="#"><i class="bi bi-bell"></i></a></li>
                <!-- <a href="#" ><img class="g-icon" src="../images/google.png"></a></li> -->
                <a href="../login/login.html"><i class="bi bi-box-arrow-right"></i></a></li>
            </div>
        </ul>
    </div>

    <?php
if(isset($_GET['search']))
{
    $query = $_GET['search'];
    // $sql = "SELECT * FROM video WHERE title LIKE '%$query%'";
    $sql = "SELECT video.*, AVG(comments.rating) as avg_rating FROM video LEFT JOIN comments ON video.video_id = comments.video_id WHERE video.title LIKE '%$query%' GROUP BY video.video_id ORDER BY avg_rating DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
?>
    <div class="input5">
<?php
        while($row=mysqli_fetch_array($result)){
?>
            &nbsp;&nbsp;&nbsp;<div style="display: inline-block;">
                <a href="../comments/comments.php?id=<?php echo $row['video_id']; ?>" class="input13">
                    <video width="320" height="240" controls="" autoplay="" loop="">  
                        <source src="<?php echo '../uploaded_vid/'.$row['name'];?>">
                    </video>
                    <div class="input17">
                        <br><h3 class="input123" style="display: inline-block; font-size:50px "><?php echo $row['title'];?></h3><br>
                        <p class="input12">3k views &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F j, Y', strtotime($row['date'])); ?></p>
                        <p class="input12">&nbsp; <img class="o" src="<?php echo '../imgupload/'.$row['image_name'];?>">&nbsp;&nbsp;&nbsp;<?php echo $row['username'];?></p>
                        <p class="input12">Avg. Rating: <?php echo round($row['avg_rating'], 1); ?>/5</p>
                    </div>
                </a>
            </div>
<?php
        }
?>
    </div>
<?php
}
    else{
        echo "NO data found";
    }
}
?>
</body>