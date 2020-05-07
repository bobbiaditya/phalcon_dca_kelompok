<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DCA | Dwi Citra Anugerah</title>
    <!-- {{ assets.outputCss() }} -->
    <link rel="stylesheet" href="{{ static_url('dist/css/adminlte.min.css') }}" type='text/css'>
    <link rel="stylesheet" href="{{ static_url('css/login.css') }}" type='text/css'>
</head>

<body>
    <div class="form-structor">
        <form method="post" autocomplete="off" action="{{url('session/login')}}">
            <div class="signup">
                <h2 class="form-title" id="signup">Log in</h2>
                <div class="text-danger text-center">
                    {{ flashSession.output() }}
                </div>
                <div class="form-holder">
                    <input id="username" type="text" placeholder="Username" class="input form-control" name="username">

                    <input id="password" type="password" placeholder="Password" class="input form-control"
                        name="pwd">
                </div>
                <!-- <button class="submit-btn">Log in</button> -->
                <button type="submit" class="submit-btn">
                    Log In
                </button>
            </div>
        </form>
    </div>
</body>
