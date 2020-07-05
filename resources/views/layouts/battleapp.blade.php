<!DOCTYPE html>
<html lang="ja">
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="{{ secure_asset('/css/demo.css') }}" type="text/css" media="screen" charset="utf-8" />
      <link rel="stylesheet" href="{{ secure_asset('/css/style.css') }}" type="text/css" />
      <script type="text/javascript" src="{{ secure_asset('/js/battle2.js')}}"></script>
    </head>
    <body>
      @yield('content') 
    </body>
</html>