<?php
require 'classlib.php';

$database->query('SELECT p.id, p.title, p.body, p.date, u.username FROM posts p LEFT JOIN users u ON p.auth_id = u.id');
$rows = $database->resultset();
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


    <header class="jumbotron">
        <div class="container">
        <div class="row row-header">
            <div class="col-xs-12 col-sm-4">
                <h1>My Blog</h1>
            </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-5">
                    <p> A boring blog for the most basic of the basic people</p>
                 </div>
                <div class="col-sm-1 col-sm-push-5">
                    <button type="button" class="btn btn-default"><a id="loginButton">Login</a></button>
                </div>
                <div class="col-sm-1 col-sm-push-5">
                    <button type="button" class="btn btn-default"><a id="registerButton">Register</a></button>
                </div>
                <div class="col-sm-1 col-sm-push-5">
                    <button type="button" class="btn btn-default"><a id="postButton">Add Post</a></button>
                </div>
            </div>
            </div>
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
                    <form method="post" role="search">
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
    <div id="registerModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" name="f_name" placeholder="First Name">
                            <input type="text" class="form-control" name="l_name" placeholder="Last Name">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <input type="submit" name="add"  value="Register" class="btn btn-info">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="postModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Add Post</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label>Post Title</label><br>
                            <input type="text" name="title" placeholder="Add a Title..." /><br /><br />
                            <label>Post Body</label><br />
                            <textarea name="body"></textarea><br /><br />
                        </div>
                        <input type="submit" name="submit" value="Add" class="btn btn-default btn-sm" />
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

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
                    <input type="submit" name="update" value="Update" class="btn btn-default btn-sm" id="updateButton">
                    <input type="submit" name="delete" value="Delete" class="btn btn-default btn-sm" >
                </form>
            </div>

        </div>
    <?php  endforeach; ?>
</div>
    <div id="updateModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Add Post</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label>Post Title</label><br>
                            <input type="text" name="title" placeholder="Add a Title..." /><br /><br />
                            <label>Post Body</label><br />
                            <textarea name="body"></textarea><br /><br />
                        </div>
                        <input type="submit" name="update" value="update" class="btn btn-default btn-sm" />
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Cancel</button>
                    </form>
                </div>
            </div>
        </div>
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

    $("#registerButton").click(function(){
        $('#registerModal').modal('toggle')
    });

    $("#postButton").click(function(){
        $('#postModal').modal('toggle')
    });

//    $("#updateButton").click(function(){
//        $('#updateModal').modal('toggle')
//    });
</script>
</body>
</html>
