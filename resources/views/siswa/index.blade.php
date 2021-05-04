@extends('master')

@section('title', '')

@section('alert')

@if(Session::has('alert_success'))
  @component('components.alert')
    @slot('class')
      success
    @endslot
    @slot('title')
      Terimakasih
    @endslot
    @slot('message')
      {{ session('alert_success') }}
    @endslot
  @endcomponent
@elseif(Session::has('alert_error'))
  @component('components.alert')
    @slot('class')
      error
    @endslot
    @slot('title')
      Cek Kembali
    @endslot
    @slot('message')
      {{ session('alert_error') }}
    @endslot
  @endcomponent
@endif

@endsection

@section('content')

<div style="padding-bottom: 20px">
  <a  href="{{ route('create-siswa') }}" type="button" class="ui huge inverted primary button"> TAMBAH </a>
</div>
<div style="width: 100%; padding-left: -10px;">
  <div class="table-responsive">
    <table id="user_table_siswa" class="table table-bordered data-table display nowrap" style="width:100%">
      <thead>
        <tr>
          <th style="text-align: center">NIS</th>
          <th style="text-align: center">Nama</th>
          <th style="text-align: center">Angkatan</th>
          <th style="text-align: center">Jurusan</th>
          <th style="text-align: center">Email</th>
          <th style="text-align: center; width: 100px">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('modal')

<div class="modal fade" id="detailModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">User Detail</p>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>NIS</label>
          <input type="text" class="form-control" value="" id="username">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="text" class="form-control" value="" id="email">
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" value="" id="nama_lengkap">
        </div>
        <div class="form-group">
          <label>Jurusan</label>
          <select class="form-control" id="kelas">
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
          <label>Angkatan</label>
          <select class="form-control" id="angkatan">
            @foreach ($years as $year)
              <option value="{{ $year }}"> {{ $year }} </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="sel1">Tipe Akun</label>
          <select class="form-control" id="tipe_akun" disabled>
            <option value="{{ User::ACCOUNT_TYPE_SISWA }}">Siswa</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="update_data" class="ui huge inverted primary button left floated">Update</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updatePassword" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">Update Password</p>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" value="" id="username_password" disabled>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" value="" id="password">
        </div>
        <div class="form-group">
          <label>Re Password</label>
          <input type="password" class="form-control" value="" id="password_confirmation">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="update_data_password" class="ui huge inverted primary button left floated">Update Password</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
  <link rel="stylesheet" type="text/css" href="<?= URL::to('/'); ?>/layout/assets/css/jquery.dataTables.css">

  <script type="text/javascript" charset="utf8" src="<?= URL::to('/'); ?>/layout/assets/js/jquery.dataTables.js" defer></script>
  <script type="text/javascript">
    var iduser;
    var table;

    function clearAll() {
      $('#username').val('');
      $('#nama_lengkap').val('');
      $('#angkatan').val('');
      $('#kelas').val('');
      $('#email').val('');
    }

    $(function() {
      table = $('#user_table_siswa').DataTable({
        processing: true,
        serverSide: true,
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true,
        ajax: "{{ route('index-siswa') }}",
        columns: [ {
            data: 'username',
            name: 'username'
          },{
            data: 'full_name',
            name: 'full_name'
          },
          {
            data: 'angkatan',
            name: 'angkatan'
          },
          {
            data: 'kelas',
            name: 'kelas'
          },
          {
            data: 'email',
            name: 'email'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          }
        ]
      });
    });

    function btnDel(id) {
      iduser = id;
      swal({
          title: "Menon Aktifkan User",
          text: 'User yang telah dinon aktifkan tidak dapat diaktifkan kembali',
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: 'POST',
              url: base_url + '/user/delete',
              data: {
                iduser: iduser,
                "_token": "{{ csrf_token() }}",
              },
              success: function(data) {
                if (data.status != false) {
                  swal(data.message, {
                    button: false,
                    icon: "success",
                    timer: 1000
                  });
                } else {
                  swal(data.message, {
                    button: false,
                    icon: "error",
                    timer: 1000
                  });
                }
                table.ajax.reload();
              },
              error: function(error) {
                swal('Terjadi kegagalan sistem', {
                  button: false,
                  icon: "error",
                  timer: 1000
                });
              }
            });
          }
        });
    }

    function btnPass(id) {
      $('#updatePassword').modal('toggle');
      iduser = id;
      $.ajax({
        type: 'POST',
        url: base_url + '/user/get-detail',
        data: {
          iduser: iduser,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          $('#username_password').val(data.data.username);
        },
        error: function(error) {
          swal('Terjadi kegagalan sistem', {
            button: false,
            icon: "error",
            timer: 1000
          });
        }
      });
    }

    function btnUbah(id) {
      $('#detailModal').modal('toggle');
      iduser = id;
      $.ajax({
        type: 'POST',
        url: base_url + '/user/get-detail',
        data: {
          iduser: iduser,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          $('#username').val(data.data.username);
          $('#email').val(data.data.email);
          $('#nama_lengkap').val(data.data.full_name);
          $('#angkatan').val(data.data.angkatan);
          $('#kelas').val(data.data.kelas);
          $('#tipe_akun').val(data.data.account_type);
        }
      });
    }

    $(document).ready(function() {
      $('#non_aktif_button').click(function() {
        btnDel(iduser)
        $("#detailModal .close").click()
      })
      $('#update_data_password').click(function() {
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        $.ajax({
          type: 'POST',
          url: base_url + '/user/update-password',
          data: {
            iduser: iduser,
            "_token": "{{ csrf_token() }}",
            password: password,
            password_confirmation: password_confirmation,
          },
          success: function(data) {
            if (data.status != false) {
              swal(data.message, {
                button: false,
                icon: "success",
                timer: 1000
              });
              $("#updatePassword .close").click()
            } else {
              swal(data.message, {
                button: false,
                icon: "error",
                timer: 1000
              });
            }
          },
          error: function(error) {
            var err = eval("(" + error.responseText + ")");
            var array_1 = $.map(err, function(value, index) {
              return [value];
            });
            var array_2 = $.map(array_1, function(value, index) {
              return [value];
            });
            var message = JSON.stringify(array_2);
            swal(message, {
              button: false,
              icon: "error",
              timer: 1000
            });
          }
        });
      })
      $('#update_data').click(function() {
        var username = $('#username').val();
        var email = $('#email').val();
        var full_name = $('#nama_lengkap').val();
        var angkatan = $('#angkatan').val();
        var kelas = $('#kelas').val();
        var account_type = $('#tipe_akun').val();
        $.ajax({
          type: 'POST',
          url: base_url + '/user/update',
          data: {
            iduser: iduser,
            "_token": "{{ csrf_token() }}",
            username: username,
            email: email,
            full_name: full_name,
            angkatan: angkatan,
            kelas: kelas,
            account_type: account_type
          },
          success: function(data) {
            if (data.status != false) {
              table.ajax.reload();
              swal(data.message, {
                button: false,
                icon: "success",
                timer: 1000
              });
              $("#detailModal .close").click();
              clearAll();
            }
          },
          error: function(error) {
            var err = eval("(" + error.responseText + ")");
            var array_1 = $.map(err, function(value, index) {
              return [value];
            });
            var array_2 = $.map(array_1, function(value, index) {
              return [value];
            });
            var message = JSON.stringify(array_2);
            swal(message, {
              button: false,
              icon: "error",
              timer: 1000
            });
          }
        });
      })
    });
  </script>

@endpush
