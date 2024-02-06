<div class="container-fluid panel-admin">
	<div class="row">
		<div class="col-md-3 side-bar">
            @include('layouts.sidebar')
		</div>
		<div class="col-md-9 admin-contenido">
            @yield('content')
		</div>
	</div>
</div>
