@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">roles</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center">{{ $role->id}}</td>
                                    <td class="text-center">{{ $role->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('role/'.$role->id.'/give-permissions') }}" class="btn btn-fill btn-primary" >
                                            Add / Edit Role Permission
                                        </a>
                                        <a href="{{ url('role/'.$role->id.'/edit') }}" class="btn btn-fill btn-primary" >Edit</a>
                                        <a href="{{ url('role/'.$role->id.'/delete') }}" class="btn btn-fill btn-primary">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();
        });
    </script>
@endpush

