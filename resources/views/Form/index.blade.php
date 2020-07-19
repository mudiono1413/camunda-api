<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	{{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}"> --}}
    <script src="{{ asset('assets/js/bootstrap-datepicker.js')}}""></script>
	<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css')}}">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>	
	<title>Form Input</title>
</head>
@include('sweetalert::alert')
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
				<input type="text" class="form-control" name="nik" id="nik" value="" placeholder="Nik" required>
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
			{{-- <button type="submit" id="submit" class="btn btn-primary">Kirim</button> --}}
			<button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-refresh fa-spin '></i> Processing Data">Kirim</button>
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
 <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
 <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js'></script>
	{{-- <script src="{{ asset('assets/js/jquery.js')}}"></script>
	<script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script> --}}
    <script src="{{ asset('js/customJs/datadiri.js')}}"></script>
    <script src="{{ asset('js/customJs/loading.js')}}"></script>
    <script>
		$('.btn').on('click', function() {
			var $this = $(this);
		  $this.button('loading');
		  
		});
		</script>
</body>

</html>