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
    <form>

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
                    <li><a href="createvideo.html"><i class="bi bi-camera-video"></i></a></li>
                    <li><a href="#"><img src="images/more.png"></a></li>
                    <li><a href="#"><i class="bi bi-bell"></i></a></li>
                    <li><a href="#"><img src="images/wpl\google.jpg.png"></a></li>
                </div>
            </ul>
            
        </nav>
        <div class="input5">
            <div class="row">
                <div class="vedio">
                    <video controls="" autoplay="" loop="">
                        <source src="ap vedio.mp4" type="video/mp4">
                    </video>
                    <div class="tag">
                        <h3>Food Video</h3>
                    </div>
                    <div class="info">
                        <p>Omkar Boralkar&nbsp; &bull;500k subscribers</p><br>
                        <div>
                            <i class="bi bi-hand-thumbs-up">&nbsp;123</i>
                            <i class="bi bi-hand-thumbs-down">&nbsp;12</i>
                            <i class="bi bi-share">&nbsp;Share</i>
                            <i class="bi bi-download">&nbsp;Download</i>
                            <button type="button">&nbsp;Subscribe</button>
                        </div>
                    </div>
                    <div class="publisher">
                        <p class="input6">12K views &nbsp; &nbsp;&nbsp;&bull;5 days ago</p>
                        <i>This video tells us about the food culture and the places </i>
                    </div>
                    <div class="comm">
                        <h1>30&nbsp;Comments</h1><br>
                        <div class="acomm">
                            <input type="search" placeholder="Comments">
                            <button type="submit" value="Submit" >Comment</button>
                        </div>
                        <div class="prevcom">
                            <img src="#"/>
                            <div class="pcam">
                                <h3>Omkar Boralkar &nbsp;&nbsp;&nbsp;&bull;&nbsp;2days ago</span></h3>
                                <p>This is very fantastic vedio</p>
                                <i class="bi bi-hand-thumbs-up">&nbsp;12</i>
                                <i class="bi bi-hand-thumbs-down">&nbsp;2</i>
                                <a href=""><i>Replay</a></i>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="side">
                <?php
        include("db.php");
        $q="SELECT * FROM video";
        $query=mysqli_query($conn,$q);
        while($row=mysqli_fetch_array($query)){
          ?>
                    <div class="sidevedio">
                        <a href="#" class="st">
                            <video controls="" autoplay="" loop="">
                            <source src="<?php echo 'upload/'.$row['name'];?>">
                            </video>
                            <div class="vidinfo">
                                <p><?php echo $row['title'];?> &nbsp;&nbsp;&bull; Omkar Boralkar</p>
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
</form>
</body>
</html>