<div class="container-fluid d-flex flex-column minigame-container">
	<div class="row mt-5">
		<div class="col-md-12 minigame-body">
			<div class="row justify-content-center">
				<div class="col-md-2 mb-3">
                    <div class="card-wrapper">
                        @yield('clue1')
                    </div>
				</div>
                <br>
				<div class="col-md-2 mb-3">
                    <div class="card-wrapper">
                        @yield('clue2')
                    </div>
				</div>
                <br>
				<div class="col-md-2 mb-3">
                    <div class="card-wrapper">
                        @yield('clue3')
                    </div>
				</div>
                <br>
				<div class="col-md-2 mb-3">
                    <div class="card-wrapper">
                        @yield('clue4')
                    </div>
				</div>
                <br>
				<div class="col-md-2 mb-3">
                    <div class="card-wrapper">
                        @yield('clue5')
                    </div>
				</div>
			</div>
            <br>
            <br>
            <br>
			<div class="row mt-5">
				<div class="col-md-12 d-flex justify-content-center">
                    @yield('search')
				</div>
			</div>
            <br>
            <br>
		</div>
	</div>
</div>
