@extends('layouts.admin')
@section('content')
<!-- Animated -->
<div class="animated fadeIn">
	<div class="clearfix"></div>
	<!-- Orders -->
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
						<form class="form-inline" method="post" action="{{ url('/admin_panel/results') }}">
							{{ csrf_field() }}
							<div class="row form-group">
								<div class="col col-md-3"><label for="select" class=" form-control-label">Выберите тест</label></div>
								<div class="col-12 col-md-9">
									<select name="select" id="select" class="form-control">
										<option selected>Тест</option>
										@foreach ($tests_s as $test_s)
											<option value="{{$test_s->id}}">{{ $test_s->name }}</option>
										@endforeach
									</select>
                                    <button type="submit" class="btn btn-primary mb-2">Найти</button>
								</div>

							</div>

						</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection