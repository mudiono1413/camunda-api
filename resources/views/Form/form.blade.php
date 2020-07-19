<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ asset("assets/css/bootstrap.css")}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js')}}"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css')}}">
	
	<title>Form Approve</title>
</head>

@include('sweetalert::alert')

<body>
	<div class="container">
		<center>
			<h3>Form Approved</h3>
		</center>
		<form  id="form-approve" method="POST">
			{{ csrf_field() }}
            <!-- Methodd  -->
            {{ method_field('POST') }}
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<div class="form-group ">
				<label for="">Nik</label>
			<input type="text" class="form-control" name="nik" id="nik" value="{{$nik}}" placeholder="Nik" required>
			</div>
			<div class="form-group ">
				<label for="">Nama</label>
			<input type="text" class="form-control" name="nama" id="nama" value="{{$nama}}" placeholder="Nama" required>
			</div>
			<div class="form-group ">
				<label for="">Tempat Lahir</label>
			<input type="text" class="form-control" name="tmplhr" id="tmplhr" value="{{$tmplhr}}" placeholder="Tempat Lahir">
			</div>
			<div class="form-group ">
				<label for="">Tanggal lahir</label>
			<input type="text" class="form-control datepicker" name="tgllhr" value="{{$tgllhr}}" id="tgllhr" required>
			</div>
			<div class="form-group ">
				<label for="">Jenis Kelamin</label>
				<select class="browser-default custom-select form-control"  name="jk" id="jk">
					<option selected>Jenis kelamin</option>
					<option value="F">Perempuan</option>
					<option value="M">Laki-Laki</option>
				</select>
				<label for="">Nama Ibu Kandung</label>
			<input type="text" class="form-control" name="namaibu" id="namaibu" value="{{$namaibu}}" placeholder="Nama Ibu Kandung">
			</div>
			<div class="form-group ">
				<label for="">Pesan</label>
				<input type="text" class="form-control" id="pesan" value="{{$messege}}" placeholder="pesan" required>
			</div>
			<div class="form-group ">
				<label for="">Approved Status</label>
				<select class="browser-default custom-select form-control" id="approve" name="approve">
					<option selected>Approved Status</option>
					<option value="true">Approve</option>
					<option value="false">Reject</option>
				</select>
				
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
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
	<script src="{{ asset('js/customJs/approve.js')}}"></script>
</body>

</html>