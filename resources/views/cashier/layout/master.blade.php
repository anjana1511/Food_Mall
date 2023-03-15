
    @include('cashier.includes.head')
    @yield('css')
       @include('cashier.includes.navigation')
       @include('cashier.includes.sidebar')
       @yield('content')
    </div>
    @include('cashier.includes.scripts')
        @yield('js')

</body>

</html>