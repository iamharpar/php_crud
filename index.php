<html>
    <head>
        <title>crud assignment</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="mx-2">
        
        <?php
            session_start();
            ?>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; 
            define('DB_SERVER', 'localhost:3308');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', '');

            $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, "articles");

            if ($conn == FALSE) {
                die("<h4>connection failed</h4>");
            }
            $results = mysqli_query($conn, "SELECT * FROM articles_table");
            $id_front = 1;
            
            if(isset($_POST['save'])) {
                $title = $_POST['title'];
                $summary = $_POST['summary'];

                mysqli_query($conn, "INSERT INTO articles_table(title, summary) VALUES('$title', '$summary')");
                header("location:index.php");
            }elseif(isset($_POST['update'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $summary = $_POST['summary'];

                mysqli_query($conn, "UPDATE articles_table SET title='$title', summary='$summary' WHERE id='$id'");
                header("location: index.php");
            }

            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                mysqli_query($conn, "DELETE FROM articles_table WHERE id=$id");
                $_SESSION['message'] = "<script>alert('Article Deleted');</script>";
                header("location:index.php");
            }elseif(isset($_GET['accept'])) {
                $id = $_GET['accept'];
                mysqli_query($conn, "UPDATE articles_table SET status='accepted' WHERE id='$id'");
                header("location:index.php");
            }
        ?>


        <h1 class="display-1" style="margin-top:7px; font-size:50px">PHP assignment(Article Draft management):</h1>
        <a style="background-color:#27AE60; color:white;" href="form.php" class="btn">Create New</a>
        <table style="margin-top:12px" class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $id_front;
                            $id_front = $id_front + 1;
                    ?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['summary'];?></td>
                <td><a style="background-color:#2E4053; color:white;" href="form.php?edit=<?php echo $row['id'];?>" class="btn">Edit</a></td>
                <td><a style="background-color:#EC7063; color:white;" href="index.php?delete=<?php echo $row['id'];?>" class="btn">Delete</a></td>
                <?php if($row['status'] == "draft") { ?>
                <td><a style="background-color:#27AE60; color:white;" href="index.php?accept=<?php echo $row['id'];?>" class="btn">Accept</a></td>
                <?php }else{ ?>
                <td><span style="color:#27AE60;" class="btn">Accepted</span></td>
                <?php } ?>
            </tr>
            <?php } ?>
            </table>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>