<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="icon/logo.png">
    <link rel="stylesheet" href="animate.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login - Class Record</title>
    <style>
        html, body {
            height: 100%;
            width: 100%;
            box-sizing: border-box;
            margin: 0;
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }

        .content {
            height: 100%;
            min-height: 100%;
            margin-left: 15px;
            margin-right: 15px;
            display: flex;
        }

        @media only screen and (max-width: 900px) {
            .content {
                height: 100%;
                min-height: 100%;
                margin: 0;
                display: flex;
                flex-direction: column;
                padding-top: 20px;
                padding-bottom: 20px;
            }
        }

        .logo {
            margin: auto;
            text-align: center;
            font-weight: 400;
        }

        .logo h1 {
            font-weight: lighter;;
        }

        .loginCard {
            margin: auto;
            height: 450px;
            width: 400px;
            border-radius: 25px;
            border-style: solid;
            border-width: 2px;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(100,100,100,.6);
            padding: 20px;
        }

        .flexnav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group label {
            margin-left: 5px;
        }

        .form-control {
            border-radius: 25px !important;
        }

        .form-control::placeholder {
            font-size: .8rem !important;
            font-style: italic;
        }

        span#invalid {
            visibility: hidden;
        }
    </style>
</head>
<body>
    <div class="content animated fadeIn">
        <div class="logo pb-5" id="logo">
            <img src="icon/images.png" alt="">
            <br>
            <h1 class="text-tsuki">Class Record</h1>
        </div>
        <div class="loginCard border-secondary">
            <div class="container mt-4">
                <h2 class="card-title font-weight-lighter animated infinite bounce text-success" id="welcome">Welcome!</h2>
                <small><span id="invalid" class="text-danger">asdf</span></small>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter username here...">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password here...">
                </div>
                <div class="flexnav mt-5">
                    <button class="btn btn-success" id="loginBtn">Login</button>
                    <small class="text-secondary">Not yet registered? <a href="#" class="text-success">Click here</a></small>
                </div>
                <div id="bottom"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#loginBtn").on("click", function(){
                var username = "admin"
                var password = "1234"

                if($("#username").val() == username && $("#password").val() == password){
                    $("#invalid").removeClass("text-danger")
                    $("#invalid").addClass("text-warning").text("Account authenticated!").css("visibility", "visible")
                    setTimeout(() => {
                        window.location.href = "index.php"
                    }, 500 )
                }else if($("#username").val() != username && $("#password").val() == password || $("#username").val() == username && $("#password").val() != password || $("#username").val() != username && $("#password").val() != password){
                    $("#invalid").text("Invalid username or password!").css("visibility", "visible")
                }
            })

            $("#username, #password").on("keydown", (e) => {
                function clicked(){
                    $("#loginBtn").css("filter", "brightness(100%)")
                }
                if(e.keyCode == 13){
                    e.preventDefault()
                    $("#loginBtn").click().css("filter", "brightness(70%)")
                    if(document.querySelector("#invalid").textContent == "Invalid username or password!"){
                        setTimeout(clicked, 80)
                    }
                }
            })
        })
    </script>
</body>
</html>