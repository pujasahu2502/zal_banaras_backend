<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <style>
        .btn-dark {
            background-color: #343a40;
            color: #fff;
            border: 1px solid #fff;
            width: 25%;
            margin-top: 15px;
        }

        .btn-dark:hover {
            background-color: #343a40;
            color: #fff;
        }

        .bg-dark {
            background: #000;
        }

        .img img {
            height: auto;
            width: 150px;
        }

        .section {
            margin-top: 14%;
            margin-bottom: 100%;
        }

        h1,
        h3,
        p {
            color: #fff
        }

        body {
            background: #fff;
            overflow: hidden;
            height: 100%;
        }

        h1 {
            font-weight: 600;
        }

        .error-page .error-img img {
            max-width: 400px;
        }

        .error-contnet-block h1 {
            color: #000;
        }

        .error-contnet-block h3 {
            color: #000;
            font-size: 20px;
            margin-top: 0;
        }

        .error-contnet-block p {
            color: #000;
        }

        .error-contnet-block .error-btn {
            background-color: #f4dd89;
            margin-bottom: 5px;
            padding: 8px 16px;
            font-size: 16px;
        }

        @media (max-width: 920px) {
            .section {
                margin-top: 10%;
            }
        }

        @media (max-width: 500px) {
            .section {
                margin-top: 60%;
            }

            .btn-dark {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <section class="error-page">
        <div class="container">
            <div class="text-center section">
                <div class="error-img">
                    <img src="@yield('img')" alt="">
                </div>
                <!-- <div class="img">
                    <img class="bg-dark" src="{{asset("assets/img/white letters trans Logo.png")}}" alt="">
                </div> -->
                <div class="error-contnet-block">
                    <h1>@yield('code') @yield('title')</h1>
                    <h3>
                        @yield('message')
                    </h3>
                    <p>@yield('message_2')</p>
                    <a href="{{route('home')}}" class="btn btn-dark error-btn">Go to Home</a>
                    <p>Page will be redirect on home in <span id="timer">10</span></p>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        var count = 10;
        var redirect = "{{env('APP_URL')}}";

        function countDown() {
            var timer = document.getElementById("timer");
            console.log(count);
            if (count > 0) {
                console.log(count);
                count--;
                timer.innerHTML = count;
                setTimeout("countDown()", 1000);
            } else {
                window.location.href = redirect;
            }
        }
    </script>
    <script>
        countDown();
    </script>
</body>

</html>