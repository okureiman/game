<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>@yield('title')</title>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <style>
            body {
                font-size: 16px;
                color: #999;
                margin: 5px;
            }
            h1 {
                font-size: 50pt;
                text-align: right;
                color: #f6f6f6;
                margin: -20px 0px -30px 0px;
                letter-spacing: -4pt;
            }
            ul { 
                font-size: 12pt;
            }
            hr { 
               margin: 25px 100px;
               border-top: 1px dashed #ddd;
           }
           .menutitle {
               font-size: 14pt; 
               font-weight: bold; 
               margin: 0px; 
           }
           .content {
               margin: 10px; 
           }
           .footer { 
               text-align: right; 
               font-size: 10pt; 
               margin:10px;
               border-bottom: solid 1px #ccc; 
               color:#ccc; 
           }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>@yield('title')</h1>
            @section('menubar')
            <ul>
                <p class="menutitle">@show</p>
            </ul>
            <hr size="1">
            <div>
                @yield('content')
            </div>
            <div class="footer">
                @yield('footer')
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>   
</html>