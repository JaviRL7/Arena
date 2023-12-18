<div class="container-fluid">
	<div class="row">
		<div class="col-md-2">
            @yield('sidebar')
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-12">
                    @yield('select_teams')
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
                    @yield('team_blue')
				</div>
				<div class="col-md-6">
                    @yield('team_red')
				</div>
			</div>
		</div>
	</div>
</div>
