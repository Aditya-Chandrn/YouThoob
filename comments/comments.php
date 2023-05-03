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
        <div class="input5">
            <div class="row">
            <?php
  $id = $_GET['id'];
 $_SESSION['id'] = $id;
 // query the database for the video information
 $result = $conn->query("SELECT * FROM video WHERE video_id = $id");
  $row = $result->fetch_assoc();
?>
<div class="vedio">
                <video controls="" autoplay="" loop="">
                <source src="<?php echo '../uploaded_vid/'.$row['name'];?>">
                </video>
                    <div class="tag">
                        <h3><?php echo $row['title'];?></h3>
                    </div>
                    <div class="info">
                    <p><img class="o" src="<?php echo '../imgupload/'.$row['image_name'];?>">&nbsp;&nbsp;&nbsp;<?php echo $row['username'];?></p>
     <?php
        $vid = $row['video_id'];
        $sql2 = "SELECT AVG(rating) as avg_rating FROM comments WHERE video_id='$vid'";
        $sql3 = "SELECT COUNT(DISTINCT comment_id) as num_comments FROM comments WHERE video_id='$vid'";
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $row3 = $result3->fetch_assoc();
            $avg_rating = round($row2['avg_rating'], 1);
            $num_comments = $row3['num_comments'];
            echo '<p>Average rating: ' . $avg_rating . '</p>';
            echo '<p> rated by: ' . $num_comments . ' people </p>';
        }
    ?>
                        <div>
                            <i  id="like" class="bi bi-hand-thumbs-up"><span class="like-count">&nbsp;123</span></i>
                            <i id="dislike " class="bi bi-hand-thumbs-down"><span class="dislike-count">&nbsp;12</span></i>
                            <i class="bi bi-share">&nbsp;Share</i>
                            <i class="bi bi-download">&nbsp;Download</i>
                            <button type="submit">Subscribe</button>
                        </div>
                    </div>
    <div class="publisher">
        <p class="input6">12K views &nbsp; &nbsp;&nbsp;&bull;<?php echo date('F j, Y', strtotime($row['date'])); ?></p>
        <i>This video tells us about the food culture and the places</i>
    </div>
    <div class="comm">
    <h1><?php echo  $row3['num_comments'] ?> &nbsp;Comments</h1><br>
    <form action="comments1.php" method="post" enctype="multipart/form-data">
        <div class="acomm">
        <input type="hidden" name="vid" id="vid" value="<?php echo $row['video_id']; ?>">
    <input  type="search" name="comment" id="comment" placeholder="Write a comment..."></input>
    <input type="file" name="file" id="fileselect">
    <div class="input1256">
        <select class="input1" id="rating" name="rating">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <label for="Gender" class="input1">Please rate the video</label>
    </div>
    <button type="submit" name="comment1" id="comment1">Comment</button>
    </div>
    </form>
    <?php
  // query the database for comments on the video
   $commentResult = $conn->query("SELECT * FROM comments WHERE video_id = $id");
  while ($commentRow = $commentResult->fetch_assoc()) {
    if ($commentRow['type'] && ($commentRow['type'] == 'image/jpeg' || $commentRow['type'] == 'image/png')) { 
        // echo "<img src='upload/".$filename."' alt='image'>";
        echo "<img src='../cimgupload/" . $commentRow['name'] . "' alt='image' width='500' height='500'>";
    } 
    elseif ($commentRow['type'] && ($commentRow['type'] == 'video/mp4' || $commentRow['type'] == 'video/quicktime')) {
        // <video controls="" autoplay="" loop="">
        //                     <source src="<?php echo 'upload/'.$row['name'];
     echo '<video width="100" height="200" controls>
        <source src="../cimgupload/' . $commentRow['name'] . '" type="' . $commentRow['type'] . '">
    </video>';
    }
 ?>
    <div class="prevcom">
        <div class="pcam">
            <h3><img class="o" src="<?php echo '../imgupload/'.$commentRow['user_image'];?>">&nbsp;&nbsp;&nbsp;<?php echo $commentRow['username'] ; ?>&nbsp;&bull;&nbsp;<?php echo date('F j, Y', strtotime($commentRow['date']));?></h3>
            <p><?php echo $commentRow['text']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; video rating &nbsp;&nbsp;&nbsp;&nbsp;&bull;&nbsp;<?php echo $commentRow['rating']; ?> </p>
            
            <i class="bi bi-hand-thumbs-up"><span class="like-count1">&nbsp;12</span></i>
            <i class="bi bi-hand-thumbs-down"><span class="dislike-count">&nbsp;2</span></i>
            <a href="../reply/reply.php?cid=<?php echo $commentRow['comment_id']; ?>"><i>Reply</a></i>
        
        </div><br><br>
<!-- <?php
$cid = $_GET['cid'];
// Retrieve replies for the comment
$replyQuery = "SELECT * FROM reply WHERE comment_id = '$cid'";
$ReplyResult = $conn->query($replyQuery);
// Loop through all replies in reverse order
while ($ReplyRow = $ReplyResult->fetch_assoc()) {
    "<br><br>";
    if ($ReplyRow['type'] && ($ReplyRow['type'] == 'image/jpeg' || $ReplyRow['type'] == 'image/png')) { 
        // echo "<img src='upload/".$filename."' alt='image'>";
        echo "<img src='../cimgupload/" . $ReplyRow['name'] . "' alt='image' width='500' height='500'>";
    } 
    elseif ($ReplyRow['type'] && ($ReplyRow['type'] == 'video/mp4' || $ReplyRow['type'] == 'video/quicktime')) {
        // <video controls="" autoplay="" loop="">
        //                     <source src="<?php echo 'upload/'.$row['name'];
        echo '<video width="100" height="200" controls>
        <source src="../cimgupload/' . $ReplyRow['name'] . '" type="' . $ReplyRow['type'] . '">
    </video>';
    }
?>
    <br><br><div class="comment">
        <div class="pcam">
            <h3><img class="o" src="<?php echo '../imgupload/'.$ReplyRow['user_image'];?>">&nbsp;&nbsp;&nbsp;<?php echo $ReplyRow['username'] ; ?>&nbsp;&bull;&nbsp;<?php echo date('F j, Y', strtotime($ReplyRow['date']));?></h3>
            <p><?php echo $ReplyRow['text']; ?></p>
        </div>
    </div>
<?php
}
?> -->
    </div>
<?php
}
?>
</div>
    </div>
                <div class="side">
                <?php
        include('../db.php');
        $q= "SELECT video.*, AVG(comments.rating) AS avg_rating FROM comments Right JOIN video ON video.video_id = comments.video_id  GROUP BY video.video_id ORDER BY avg_rating DESC";
        $query=mysqli_query($conn,$q);
        while($row=mysqli_fetch_array($query)){
          ?>
                    <div class="sidevedio">
                        <a href="comments.php?id=<?php echo $row['video_id']; ?>" class="st">
                            <video controls="" autoplay="" loop="">
                            <source src="<?php echo '../uploaded_vid/'.$row['name'];?>">
                            </video>
                            <div class="vidinfo">
                                <p><?php echo $row['title'];?> &nbsp;&nbsp;&bull; </p>
                               <p> <img class="o" src="<?php echo '../imgupload/'.$row['image_name'];?>">&nbsp;&nbsp;&nbsp;<?php echo $row['username'];?></p>
                                <p>15k views&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('F j, Y', strtotime($row['date'])); ?></p>
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