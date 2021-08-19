@auth()
    @include('layouts.navbars.navs.top-nav')
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest
