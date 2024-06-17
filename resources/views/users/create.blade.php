@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Create User</h4>
                    <a href="{{ url('users/view') }}" class="btn btn-fill btn-primary">Back</a>
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
                <form method="post" action="{{ route('users.store') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf

                            @include('alerts.success')

                            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Name') }}" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                            <div class="input-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ _('last_name') }}" value="{{ old('last_name') }}">
                                @include('alerts.feedback', ['field' => 'last_name'])
                            </div>
                            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-email-85"></i>
                                    </div>
                                </div>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ _('Email') }}" value="{{ old('email') }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-lock-circle"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ _('Password') }}">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-lock-circle"></i>
                                    </div>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ _('Confirm Password') }}">
                            </div>

                            {{--  Campo de ROLES  --}}
                            <div class="input-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tim-icons icon-single-02"></i>
                                    </div>
                                </div>
                                <select name="roles[]" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('roles') && in_array($role, old('roles')) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'role'])
                            </div>

                            {{--  HASTA AQUI  --}}
                            
                            <div class="form-check text-left {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-check-label">
                                    <input class="form-check-input {{ $errors->has('agree_terms_and_conditions') ? ' is-invalid' : '' }}" name="agree_terms_and_conditions"  type="checkbox"  {{ old('agree_terms_and_conditions') ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    {{ _('I agree to the') }}
                                    <a href="#">{{ _('terms and conditions') }}</a>.
                                    @include('alerts.feedback', ['field' => 'agree_terms_and_conditions'])
                                </label>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Save') }}</button>
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
