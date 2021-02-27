<!DOCTYPE html>
<html>
@include('website.includes.head')
<body>
<!-- navbar-->
<header class="header mb-5">
    <!--
    *** TOPBAR ***
    _________________________________________________________
    -->
    @include('website.includes.header')
    @include('website.includes.navbar')
</header>
<div id="all">
    <div id="content">
        @yield('content')
    </div>
</div>
<!--
*** FOOTER ***
_________________________________________________________
-->
@include('website.includes.footer')
@include('website.includes.script')
@yield('script')
</body>
</html>
