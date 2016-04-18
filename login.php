<?php
	include 'init.php';

	$ses_ex = $_POST['ses_ex'];

	if($_POST['signin'])
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$total = mysqli_num_rows(mysqli_query($conn, 'SELECT * FROM master_admin WHERE username = "'.$username.'" AND password = "'.$password.'"'));

		if($total != 0)
		{
			$_SESSION['user'] = $username;
			header("location: index.php");
		}
		else
		{
			$null = 1;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Arsinergi</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">

            <form class="form-signin" action="login.php" method="post">
                <div style="width:100%; margin-bottom:30px; margin-top:30px" align="center">
                    <h2 class="form-signin-heading">
						ARSINERGI PROJECT MANAGER
                    </h2>
                </div>
                <div style="position:relative; margin-bottom:10px">
                	<input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="">
                </div>
                <div style="position:relative; margin-bottom:10px">
                	<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                </div>

				<?php
	            if($null == 1)
	            {
					echo '<div style="width:100%; color:#FF3057" align="center">';
					echo '    The user name or Password is incorrect';
					echo '</div>';
	            }

				if($ses_ex == 1)
				{
					echo '<div style="width:100%; color:#FF3057" align="center">';
					echo '    Your session has expired';
					echo '</div>';
	            }
	            ?>

                <div style="position:relative; margin-top:30px">
                	<input name="signin" class="btn btn-lg btn-primary btn-block" type="submit" value="LOGIN">
                </div>
            </form>

        </div>

		<script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
