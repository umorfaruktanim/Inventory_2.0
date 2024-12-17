<!DOCTYPE html>
<html>
<head>
    <title>login page</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/sweetalert.min.js"></script>
    
    <style>
        img {
            max-width: 100%;
        }

        .form-01-main, html, body {
            height: 100%;
        }

        .form-01-main {
            padding: 40px 0px;
            background: url('images/1.jpg'); /* Adjusted path */
            background-position: center;
            background-size: cover; /* Adjusted to cover */
            background-repeat: no-repeat;
            position: relative;
            text-align: center;
            height: 100%; /* Ensure it takes full height */
        }

        .form-cover {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            bottom: 0;
            top: 0;
            width: 100%;
            overflow: auto;
        }

        .form-sub-main {
            max-width: 500px;
            margin: 20px auto;
            padding: 45px 60px 46px;
        }

        @media screen and (max-width: 767px) {
            .form-sub-main {
                padding: 30px;
            }
        }

        .form-control {
            min-height: 50px;
            border: 1px solid yellow;
            padding: 10px 15px;
            background-color: transparent;
            margin: 30px 0px;
        }

        .form-sub-main {
            color: white;
        }

        ._main_head_as a img {
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <section class="form-01-main">
        <div class="form-cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-sub-main">
                            <div class="_main_head_as">
                                <a href="#">
                                    <img src="images/vector.png">
                                </a>
                            </div>
                            <form method="post" action="">
                                <div class="form-group">
                                    <input id="email" name="mail" class="form-control" type="text" placeholder="Enter Email" required="">
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                </div>
                                <button class="form-control btn btn-success" type="submit" name="submit">Login</button>
                            </form>
                            <a href="reg.php" style="color:#FF5733; font-weight: bold;">Registration?</a>
                             <p href="#" class="">For registration approval contact with <span><a href="https://www.facebook.com/omorfaruk.tanim/">Admin</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../js/all.js"></script>
</body>
</html>
<?php 
    if (isset($_POST['submit'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        include('dbcon.php');
        $sql = "SELECT * FROM user WHERE email = '$mail' AND password = '$password'";
        $exe = mysqli_query($con, $sql);
        $result = mysqli_fetch_assoc($exe);
        $check = mysqli_num_rows($exe);
        
        if ($check == 0) {
            ?>
            <script>
                swal("Error!!", "User name and Password do not match. Please try again", "error");
            </script>
            <?php
        } else {
            $id = $result['id'];
            $status = $result['status'];

            if ($status == 0) {
                ?>
                <script>
                    swal("Unauthorized!!", "Your registration is unauthorized. Please contact Admin.", "error");
                </script>
                <?php
            } else {
                session_start();
                $_SESSION['email'] = $mail;
                $_SESSION['id'] = $id;

                echo "<script>
                        window.open('main/index.php?id=$id', '_self');
                      </script>";
            }
        }
    }
?>
