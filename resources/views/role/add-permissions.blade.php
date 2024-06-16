@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">

            {{--  @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif  --}}

            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title mb-0"><strong>Role :</strong> {{ $role->name }}</h2>
                    <a href="{{ url('role/') }}" class="btn btn-danger">Back</a>
                </div>

                <!-- Muestra los errores de validación -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="post" action="{{ url('role/'.$role->id.'/give-permissions') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <h4>{{ _('Permissions') }}</h4>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-2">
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                placeholder="{{ _('Name') }}"
                                                value="{{ old('name', $permission->name) }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Update') }}</button>
                    </div>
                </form>
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


