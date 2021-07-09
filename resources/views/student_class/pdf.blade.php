<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
		use Yajra\Datatables\Datatables;
        use App\Model\User\User;
        use App\Model\StudentClass\Feed;
		use Carbon\Carbon;

// get user auth
$user = Auth::user();
?>
@foreach($filename as $fn)
<p>
NAMA        : {{$fn->full_name}}<br>
KELAS       : {{$fn->kelas}}<br>
ANGKATAN    : {{$fn->angkatan}}<br>
</p>
@endforeach
<br>

<h1 style="text-align: center">Rekap Tugas</h1><br>
<div class="table-responsive">
        <table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th style="text-align: center" width="40%">Feed</th>
            <th style="text-align: center">Tugas</th>
            <th style="text-align: center" width="100">Upload</th>
            <th style="text-align: center" width="50">Nilai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_tugas as $dt)
            <tr>
                <td style="text-align: center">{{Feed::where('id', '=', $dt->feed_id)->value('judul')}}</td>
                <td>{{$dt->file}}</td>
                <td style="text-align: center">{{date('d-m-Y',strtotime($dt->created_at))}}</td>
                <td style="text-align: center">{{$dt->nilai}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</body>
</html>


