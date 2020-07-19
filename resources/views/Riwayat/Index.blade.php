@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <div class="h3 mb-4 text-gray-800">

        @include('sweetalert::alert')

        @if ($errors->any())
            <div class="alert alert-danger border-left-danger" role="alert">
                <ul class="pl-4 my-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Topbar Search -->
        <form action="{{ url()->current() }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control bg-light border-1 small" placeholder="Cari Nik atau Nama" aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Riwayat') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Activity Name</th>
                        <th>Activity Type</th>
                        <th>ActivityId</th>
                        <th>Duration In Millis</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                   
                    <tbody>

                    @foreach ($riwayat as $index => $item)
                        <form action="#" method="post"
                              class="form-inline">
                            <tr>
                            <td>{{$index +1}}</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->activityName}}</td>
                            <td>{{$item->activityType}}</td>
                            <td>{{$item->activityId}}</td>
                            <td>{{$item->durationInMillis}}</td>
                            <td>{{$item->startTime}}</td>
                            <td>{{$item->endTime}}</td>
                               
                               
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>

                {{-- {{ $riwayat->links() }} --}}
            </div>
        </div>
    </div>

@endsection
