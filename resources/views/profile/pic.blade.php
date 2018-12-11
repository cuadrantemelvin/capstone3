@extends('profile.master')
@section('content')
<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-sm-8 col-md-offset-2">
			<div class="card">
				<div class="card-header">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header text-center">
									<img src="{{Auth::user()->pic}}" style="width: 250px; height: 250px; border-radius: 50%;">
								</div>
							</div>
							<div class="card-footer text-center bg-secondary">
								<p>{{Auth::user()->name}}</p>
							</div>
						</div>
					</div>
					<hr>
					<form action="/uploadPhoto" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
							<div class="row justify-content-center">
								<div class="btn btn-primary btn-sm ">
			                        <input type="file" name="pic">
									<button class="btn btn-success" type="submit">Upload Photo</button>
			                    </div>
			                </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection