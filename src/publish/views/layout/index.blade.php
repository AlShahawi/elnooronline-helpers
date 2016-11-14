@include('cpanel.layout.inc.head')
@include('cpanel.layout.inc.navbar')
@include('cpanel.layout.inc.sidebar')
@include('cpanel.layout.inc.breadcrumb')
@include('cpanel.layout.inc.errors')

	@yield('content')

@include('cpanel.layout.inc.footer')
@include('cpanel.layout.inc.js')

@yield('js')


