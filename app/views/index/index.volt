<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DCA | Dwi Citra Anugerah</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ static_url('css/style.css') }}" type='text/css'>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>

<body>
    <img class="wave" src="img/wave2.png">
    <div class="container">
        <div class="img">
            <img src="img/login.svg">
        </div>
        <div class="login-content">
            <form method="post" autocomplete="off" action="{{url('session/login')}}">
                <img src="img/DCA2.PNG">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input id="username" type="text" class="input" name="username">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input id="password" type="password" class="input" name="pwd">
                    </div>
                </div>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
    </body>
