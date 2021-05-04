@extends('master')

@section('title', '')

@section('content')

	<?php
		use Yajra\Datatables\Datatables;
		use App\Model\User\User;

		// get user auth
		$user = Auth::user();
	?>

	<form method="post" action="{{ route('store-student-class') }}">

		@csrf

		<div class="form-group">
			<label>Nama Kelas</label>
			<input type="text" class="form-control" value="" name="class_name">
			@if ($errors->has('class_name'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('class_name') }}</p></div>
			@endif
		</div>
		@if($user->account_type == User::ACCOUNT_TYPE_CREATOR || $user->account_type == User::ACCOUNT_TYPE_ADMIN)
			<div class="form-group">
				<label>Guru</label>
				<select class="js-example-basic-single form-control" id="guru" name="teacher_id" style="width: 100%"></select>
				@if ($errors->has('teacher_id'))
					<div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('teacher_id') }}</p></div>
				@endif
			</div>
		@endif
		<div class="form-group">
			<label>Angkatan</label>
            <select class="form-control" id="angkatan" name="angkatan" style="width: 100%">
            	@foreach ($years as $year)
                	<option value="{{ $year }}"> {{ $year }} </option>
            	@endforeach
            </select>
            @if ($errors->has('angkatan'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('teacher_id') }}</p></div>
			@endif
        </div>
		<div class="form-group">
            <label>Jurusan</label>
            <select class="form-control" name="kelas">
                    <option value="AP 1">AP 1</option>
                    <option value="AP 2">AP 2</option>
                    <option value="JB 1">JB 1</option>
                    <option value="JB 2">JB 2</option>
                    <option value="MM 1">MM 1</option>
                    <option value="MM 2">MM 2</option>
                    <option value="MM 3">MM 3</option>
                    <option value="TGB 1">TGB 1</option>
                    <option value="TGB 2">TGB 2</option>
                    <option value="TKJ 1">TKJ 1</option>
                    <option value="TKJ 2">TKJ 2</option>
                    <option value="TKJ 3">TKJ 3</option>
                    <option value="TKR 1">TKR 1</option>
                    <option value="TKR 2">TKR 2</option>
                    <option value="TPM 1">TPM 1</option>
            </select>
        </div>
		<div class="form-group">
			<label>Catatan</label>
			<input type="text" class="form-control" value="" name="note" maxlength="30">
			@if ($errors->has('note'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('note') }}</p></div>
			@endif
		</div>
		<div class="form-group">
			<button type="submit" class="ui huge inverted primary button"> TAMBAH </button>
		</div>
	</form>
@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
	    $('#guru').select2({
	    	allowClear: true,
			placeholder: 'Masukkan Nama Guru',
			ajax: {
				url: base_url + '/student-class/get-user-teacher',
				dataType: 'json',
				data: function(params) {
				    return {
				      search: params.term
				    }
				},
				processResults: function (data, page) {
				    return {
				        results: data
				    };
				}
			}
	    });
	});
</script>
@endpush
