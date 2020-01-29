<?php include("index.php");  
    $id = "";
    $update = false;
    $title = "";
    $summary = "";
    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $dbManagerObj->getEntryUsingId($id);
        $n = mysqli_fetch_array($result);
        $title = $n['title'];
        $summary = $n['summary'];

    }
?>
<html>
    <head>
        <title>CReate</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body class="mx-2">
        <form method="POST" action="index.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo $title; ?>">
            </div>
            <div class="form-group">
                <label>Summary</label>
                <input type="text" name="summary" value="<?php echo $summary; ?>">
            </div>
            <?php if ($update == true): ?>
                <div class="input-group">
                    <button class="btn btn-dark" type="submit" name="update" >update</button>
                </div>
            <?php else: ?>
            <div class="input-group">
                <button class="btn btn-primary" type="submit" name="save" >Save</button>
            </div>
            <?php endif ?>
        </form>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

