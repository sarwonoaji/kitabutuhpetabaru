<!DOCTYPE html>
<html lang="en">
<head>
    <title>FORM LOGIN DESA BUTUH</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f2f2f2;
        }

        /* .kades {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 100%;
            opacity: 0.2;
        } */

        .kades {
            position: fixed;
            width: 100%;
            height: 100%;
            left: 0;
            bottom: 0;
            z-index: -1;
            }

        .container-custom {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 350px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .avatar {
            width: 80px;
            margin-bottom: 10px;
        }

        .input-div {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #d9d9d9;
            margin: 15px 0;
        }

        .input-div .i {
            padding: 10px;
            color: #999;
        }

        .input-div input {
            border: none;
            outline: none;
            width: 100%;
            padding: 10px;
        }

        .btn-login {
            width: 100%;
            background: #38d39f;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #2fa37b;
        }
    </style>
</head>

<body>

<img class="kades" src="{{ asset('slider/1.jpg') }}">

<div class="container-custom">

    <div class="login-container">

        <!-- Avatar -->
        <img class="avatar" src="{{ asset('Kitabutuhpeta.png') }}">

        <h2>Welcome</h2>

        <!-- ERROR MESSAGE -->
        @if(session('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <!-- Username -->
            <div class="input-div">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <input type="text" name="username" placeholder="Username">
            </div>

            <!-- Password -->
            <div class="input-div">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" name="password" placeholder="Password">
            </div>

            <!-- Button -->
            <button type="submit" class="btn-login">Login</button>

        </form>
    </div>
</div>

</body>
</html>