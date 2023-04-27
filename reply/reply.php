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
    <link rel="stylesheet" href="reply.css">
</head>
<body>
<?php
session_start();
include('../db.php');
$id = $_GET['cid'];
// query the database for the video information
$result = $conn->query("SELECT * FROM comments WHERE comment_id = $id");
$row = $result->fetch_assoc();
?>
<form action="reply1.php" method="post" enctype="multipart/form-data">
    <div class="acomm">
    <input type="hidden" name="cid" id="cid" value="<?php echo $row['comment_id']; ?>">
    <input  type="search" name="reply" id="reply" placeholder="Write a reply..."></input>
    <button type="submit" name="reply1" id="reply1">Comment</button>
    </div>
 </form>
</body>