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
            <li class='rt'>
                <input type="search" class="searchbox" placeholder='search'><button type="submit" class="input3"><i
                    class="bi bi-search"></i></button>
                </li>
                <i class="bi bi-mic-fill" style="height: 100px;"></i>
                <div class="input1">
                    <li><a href="home1.php"><i class="bi bi-house-door"></i></a></li>
                    <li><a href="login1.html"><i class="bi bi-box-arrow-right"></i></a></li>
                    <li><a href="createvideo.html"><i class="bi bi-camera-video"></i></a></li>
                 
                    <li><a href="#"><i class="bi bi-bell"></i></a></li>
                    <li><a href="#"><img src="images/wpl\google.jpg.png"></a></li>
                </div>
            </ul>
            
        </nav>
        <div class="input5">
            <div class="row">
            <?php
session_start();
include('../db.php');
$id = $_GET['id'];
// query the database for the video information
$result = $conn->query("SELECT * FROM video WHERE id = $id");
$row = $result->fetch_assoc();

?>

                <div class="vedio">
                <video controls="" autoplay="" loop="">
                <source src="<?php echo 'upload/'.$row['name'];?>">
</video>
                    <div class="tag">
                        <h3><?php echo $row['title'];?></h3>
                    </div>
                    <div class="info">
                        <p><?php echo $row['username'] ; ?>&nbsp; &bull;500k subscribers</p><br>
                        <div>
                            <i  id="like" class="bi bi-hand-thumbs-up"><span class="like-count">&nbsp;123</span></i>
                            <i id="dislike " class="bi bi-hand-thumbs-down"><span class="like-count">&nbsp;12</span></i>
                            <i class="bi bi-share">&nbsp;Share</i>
                            <i class="bi bi-download">&nbsp;Download</i>
                            <button type="submit">Subscribe</button>
                        </div>
                    </div>
                    <div class="publisher">
        <p class="input6">12K views &nbsp; &nbsp;&nbsp;&bull;<?php echo date('F j, Y', strtotime($row['date'])); ?></p>
        <i>This video tells us about the food culture and the places </i>
    </div>
    <div class="comm">
    <h1>30&nbsp;Comments</h1><br>
    <form action="comments1.php" method="post" enctype="multipart/form-data">
        <div class="acomm">
        <input type="hidden" name="vid" id="vid" value="<?php echo $row['id']; ?>">
    <input  type="search" name="comment" id="comment" placeholder="Write a comment..."></input>
    <button type="submit">Comment</button>
        </div>
    </form>
    <?php
    // query the database for comments on the video
    $commentResult = $conn->query("SELECT * FROM comments WHERE vid = $id");
    while ($commentRow = $commentResult->fetch_assoc()) {
    ?>
    <div class="prevcom">
        <!-- <img src="<?php echo $commentRow['user_image']; ?>"> -->
        <div class="pcam">
            <h3><?php echo $commentRow['username'] ; ?>&nbsp;&bull;&nbsp;<?php echo date('F j, Y', strtotime($commentRow['date']));?></h3>
            <p><?php echo $commentRow['text']; ?></p>
            <i class="bi bi-hand-thumbs-up"><span class="like-count1">&nbsp;12</span></i>
            <i class="bi bi-hand-thumbs-down"><span class="like-count">&nbsp;2</span></i>
            <a href=""><i>Replay</a></i>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</div>
                <div class="side">
                <?php
        include('../db.php');
        $q="SELECT * FROM video";
        $query=mysqli_query($conn,$q);
        while($row=mysqli_fetch_array($query)){
          ?>
                    <div class="sidevedio">
                        <a href="comments.php?id=<?php echo $row['id']; ?>" class="st">
                            <video controls="" autoplay="" loop="">
                            <source src="<?php echo 'upload/'.$row['name'];?>">
                            </video>
                            <div class="vidinfo">
                                <p><?php echo $row['title'];?> &nbsp;&nbsp;&bull; <?php echo $row['username']; ?></p>
                                <p>15k views</p>
                            </div>
                    </a>
<?php
}
?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>