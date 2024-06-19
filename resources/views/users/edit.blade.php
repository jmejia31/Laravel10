@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Edit User</h4>
                    <a href="{{ url('users/') }}" class="btn btn-danger">Back</a>
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

                <form method="post" action="{{ url('user/'.$user->id) }}" autocomplete="off">
                {{--  <form method="post" action="{{ route('user.edit', $user) }}" autocomplete="off">  --}}


                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Name') }}" value="{{ $user->name ?? old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="input-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ _('last_name') }}" value="{{ $user->last_name ?? old('last_name') }}">
                                @include('alerts.feedback', ['field' => 'last_name'])
                            </div>
                            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                    </div>
                                </div>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}" value="{{ $user->email ?? old('email') }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            {{--  Campo de ROLES  --}}
                            <div class="input-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <select name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                    <option value="" disabled>Seleccione un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('role', $user->getRoleNames()->first()) == $role ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'role'])
                            </div>
                            {{--  Añade esta línea para establecer el estado por defecto a activo  --}}

                            <div class="input-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-shape-star"></i> <!-- Cambia el ícono según necesites -->
                                    </div>
                                </div>
                                <select name="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}">
                                    <option value="" disabled>Estado del usuario</option>
                                    <option value="Activo" {{ old('state', $user->state) == 'Activo' ? 'selected' : '' }}>Activar</option>
                                    <option value="Inactivo" {{ old('state', $user->state) == 'Inactivo' ? 'selected' : '' }}>Inactivar</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'state'])
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


