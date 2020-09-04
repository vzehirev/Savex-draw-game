@extends("la.layouts.app")

@section("contentheader_title", "Participants")
@section("contentheader_description", "Participants listing")
@section("section", "Participants")
@section("sub_section", "Listing")
@section("htmlheader_title", "Participants Listing")

@section("headerElems")
@la_access("Participants", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Participant</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

<div onClick="hideImage()" id="proba" class="hideReceipt">
	<img id="image" src="" >
</div>

<!-- Modal start -->
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">
</div>
<!-- Modal end -->

@la_access("Participants", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Participant</h4>
			</div>
			{!! Form::open(['action' => 'LA\ParticipantsController@store', 'id' => 'participant-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'email')
					@la_input($module, 'number')
					@la_input($module, 'image')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
<style>
	.displayReceipt {
	display: inline;
  	margin: 15% auto; /* 15% from the top and centered */
  	padding: 20px;
  	width: auto; /* Could be more or less, depending on screen size */
}
	.hideReceipt {
	display: none; /* Hidden by default */
  	margin: 15% auto; /* 15% from the top and centered */
  	padding: 20px;
  	width: auto; /* Could be more or less, depending on screen size */
}

/* Modal start */
/* The Modal (background) */
	.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 3; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
	.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
/* Add Animation - Zoom in the Modal */
	.modal-content {
  animation-name: zoom;
  animation-duration: 0.6s;
}

	@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

	@media only screen and (max-width: 700px) {
  .modal-content {
	width: 100%;
  }
}
/* Modal end */

</style>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>

// function viewit(e) {
// 	$("#proba").removeClass("hideReceipt");
// 	$("#proba").addClass("displayReceipt");
// 	$("#image").attr("src", e);
// }

function hideImage() {
	$("#proba").addClass("hideReceipt");
	$("#proba").removeClass("displayReceipt");
}

$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/participant_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#participant-add-form").validate({
		
	});
});

// Modal start 
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("img01");

function viewit(e) {
  modal.style.display = "block";
  modalImg.src = e;
}

modal.onclick = function() {
  modal.style.display = "none";
}
// Modal end
</script>
@endpush
