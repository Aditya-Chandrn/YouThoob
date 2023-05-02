<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Comments</title>
    <link rel="stylesheet" href="comments.css">
</head>
<body>
    <nav>
            <div class='yt'>
                <img src="https://www.liblogo.com/img-logo/yo482f28b-youtube-icon-logo-free-youtube-logo-icon-symbol-png-svg-download.png"
                class='input7' />
            </div>
        <ul>
            <lable class='ot'>YouThoob</lable>
                <?php
        include('../db.php');
        session_start();
        $q="SELECT * FROM video";
        $r="SELECT * FROM createaccount WHERE email='".$_SESSION['email']."'";
        $query=mysqli_query($conn,$q);
        $query1=mysqli_query($conn,$r);
        $row1=mysqli_fetch_array($query1);
        ?>      
               <li class='rt'>
            <form action="search.php" method="GET">
                <input type="search" class="searchbox" name="search" id="search" placeholder='search'><button type="submit"  class="input3"><i
                    class="bi bi-search"></i></button>
                </li>
            </form>
                <!-- <i class="bi bi-mic-fill" style="height: 100px;"></i> -->
                <div class="input1">
                    <li><a href="../home/home.php"><i class="bi bi-house-door"></i></a></li>
                    <li><a href="../login/login.html"><i class="bi bi-box-arrow-right"></i></a></li>
                    <li><a href="../upload_vid/createvideo.html"><i class="bi bi-camera-video"></i></a></li>
                 
                    <li><a href="#"><i class="bi bi-bell"></i></a></li>
                    <li><a href="#" ><img class="o" src="<?php echo '../imgupload/'.$row1['name'];?>"></a></li>
                </div>
        </ul>
    </nav>
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