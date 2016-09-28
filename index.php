<?php
require 'classlib.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>blog</title>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="bootstrap-social.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div>
    <header class="jumbotron">
        <a id="loginButton">
            <span class="glyphicon glyphicon-log-in" ></span> Login</a>
    </header>
    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <form role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email">
                            <input type="text" class="form-control" placeholder="Password">
                            <input type="checkbox" id="remember"><label for="remember">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-info">Sign In</button>
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h1> Add Post</h1>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

        <label>Post Title</label><br>
        <input type="text" name="title" placeholder="Add a Title..." /><br /><br />
        <label>Post Body</label><br />
        <textarea name="body"></textarea><br /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>


    <h1>Posts</h1>
    <?php foreach($rows as $row): ?>
        <div>
            <div>
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['username']?></p>
            </div>
            <div>
                <p><?php echo $row['date']; ?></p>
                <p><?php echo $row['body'];?></p>
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Delete"/>
                </form>
            </div>

        </div>
    <?php  endforeach; ?>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as
   needed -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="https://use.fontawesome.com/5f86910215.js"></script>

<script>
    $("#loginButton").click(function(){
        $('#loginModal').modal('toggle')
    });
</script>
</body>
</html>
