@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">View Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">State</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->id}}</td>
                                    <td class="text-center">
                                        @if(!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                {{--  ESTO ES PARA PONERLE COLOR class="badge bg-primary mx-1"  --}}
                                                <strong>{{ $rolename }}</strong>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->last_name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->state }}</td>
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

