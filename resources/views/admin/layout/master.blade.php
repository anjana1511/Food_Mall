
    @include('admin.includes.head')
    @yield('css')
       @include('admin.includes.navigation')
      
<div id="main-wrapper">

       @include('admin.includes.sidebar')
       @yield('content')
    </div>
    @include('admin.includes.scripts')
        @yield('js')

</body>

</html>