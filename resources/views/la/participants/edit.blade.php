@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/participants') }}">Participant</a> :
@endsection
@section("contentheader_description", $participant->$view_col)
@section("section", "Participants")
@section("section_url", url(config('laraadmin.adminRoute') . '/participants'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Participants Edit : ".$participant->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($participant, ['route' => [config('laraadmin.adminRoute') . '.participants.update', $participant->id ], 'method'=>'PUT', 'id' => 'participant-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'email')
					@la_input($module, 'number')
					@la_input($module, 'image')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/participants') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#participant-edit-form").validate({
		
	});
});
</script>
@endpush
