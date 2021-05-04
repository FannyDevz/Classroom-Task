@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{ route('store-siswa') }}">

		@csrf
        <div class="form-group">
			<label>NIS</label>
			<input type="text" class="form-control" value="" name="username">
			@if ($errors->has('username'))
			<div class="error">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('username') }}</p>
			</div>
			@endif
		</div>
		<div class="form-group">
			<label>Nama Lengkap</label>
			<input type="text" class="form-control" value="" name="full_name">
			@if ($errors->has('full_name'))
			<div class="email">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p>
			</div>
			@endif
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
			@if ($errors->has('username'))
			<div class="email">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p>
			</div>
			@endif
		</div>

		<div class="form-group">
		<label>Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin">
                <option value="laki-laki">Laki-laki</option>
                <option value="perempuan">Perempuan</option>
            </select>
		</div>
		<div class="form-group">
			<label>Angkatan</label>
            <select class="form-control" name="angkatan">
                @foreach ($years as $year)
                    <option value="{{ $year }}"> {{ $year }} </option>
                @endforeach
            </select>
		</div>
		<div class="form-group">
			<label>Jurusan</label>
			<select class="form-control" name="kelas">
            <option value="">--Pilih--</option>
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
		<div class="form-group col-md-6 hidden" style="padding-left: 0px">
			<label>Password</label>
			<input type="password" class="form-control" value="123456" name="password">
			@if ($errors->has('password'))
			<div class="password">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p>
			</div>
			@endif
		</div>
		<div class="form-group col-md-6 hidden" style="padding-left: 0px">
			<label>Retype Password</label>
			<input type="password" class="form-control" value="123456" name="password_confirmation">
			@if ($errors->has('password'))
			<div class="password">
				<p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p>
			</div>
			@endif
		</div>
		<div class="form-group">
			<button type="submit" class="ui huge inverted primary button"> TAMBAH </button>
		</div>
	</form>

@endsection
