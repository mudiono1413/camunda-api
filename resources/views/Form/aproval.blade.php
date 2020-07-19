<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
    <script src="{{ asset('assets/js/bootstrap-datepicker.js')}}""></script>
    <link rel="stylesheet" href="{{ asset('assets/css/datepicker.css')}}">
	<title>Form Input</title>
</head>

<body>
	<div class="container">
		<center>
			<h3>Form Input</h3>
		</center>
		<form id="form-data" method="POST">
            {{ csrf_field() }}
            <!-- Methodd  -->
            {{ method_field('POST') }}
            <meta name="csrf-token" content="{{ csrf_token() }}">
			<div class="form-group ">
				<label for="">Nik</label>
            <input type="text" class="form-control" name="nik" id="nik" value="{{$messege}}" placeholder="Nik" required>
			</div>
			<div class="form-group ">
				<label for="">Nama</label>
				<input type="text" class="form-control" name="nama" id="nama" value="" placeholder="Nama" required>
			</div>
			<div class="form-group ">
				<label for="">Tempat Lahir</label>
				<input type="text" class="form-control" name="tmplhr" id="tmplhr" placeholder="Tempat Lahir">
			</div>
			<div class="form-group ">
				<label for="">Tanggal lahir</label>
				<input type="text" class="form-control datepicker" name="tgllhr" id="tgllhr" required>
			</div>
			<div class="form-group ">
				<label for="">Jenis Kelamin</label>
				<select class="browser-default custom-select form-control" name="jk" id="jk">
					<option selected>Jenis kelamin</option>
					<option value="F">Perempuan</option>
					<option value="M">Laki-Laki</option>
				</select>
				<label for="">Nama Ibu Kandung</label>
				<input type="text" class="form-control" name="namaibu" id="namaibu" placeholder="Nama Ibu Kandung">
			</div>
			<button type="submit" class="btn btn-primary">Approve</button>
		</form>
	</div>

	<script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>

	<script src="{{ asset('assets/js/jquery.js')}}"></script>
	<script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('customJs/datadiri.js')}}"></script>
    
</body>

</html>