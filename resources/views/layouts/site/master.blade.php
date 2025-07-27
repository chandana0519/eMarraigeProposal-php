<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="sri lankan marriage proposals">
    <meta name="author" content="subasana : sri lankan marriage proposals">
    @yield('custommetatag')
    <link rel="icon" href="/img/favicon.ico">
    <title>Marriage Proposals Sri Lanka - Sri Lankan best Matrimonial web site: eMarriageProposal</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">    
    <link href="/css/checkbox.css" rel="stylesheet">
    @yield('pagestyle')
    @yield('customstyle')
    <!-- Custom styles for this template -->
    <link href="/css/main.css" rel="stylesheet">
  </head>

  <body>
    <input type="hidden" id="svrErrCount" name="svrErrCount" value="{{ $svrErrCount or 0 }}">    
    <div class="main-container">
        <!-- Header -->
        @include('layouts.site.header')

      <section>
        <div class="container-fluid">
             @yield('content')
        </div>
      </section>
        @include('layouts.site.footer')
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/gridline.js"></script>    
    @yield('pagescripts')
    @yield('customscripts')
  </body>
</html>
