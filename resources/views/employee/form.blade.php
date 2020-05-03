@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="
                        {{$model->exists ? route('employee.update', $model->id) : route('employee.store') }}"
                          autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @if($model->exists)
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{$model->id}}">
                        @endif

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Company') }}</h4>
                                <p class="card-category">{{ __('Create & edit') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status'))
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('first name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                name="first_name" id="input-name" type="text"
                                                placeholder="{{ __('first_name') }}"
                                                value="{{ old('first_name', $model->first_name) }}" required/>
                                            @if ($errors->has('first_name'))
                                                <span id="first_name-error" class="error text-danger"
                                                      for="input-first-name">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('last name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                name="last_name" id="input-last-name" type="text"
                                                placeholder="{{ __('last_name') }}"
                                                value="{{ old('last_name', $model->last_name) }}" required/>
                                            @if ($errors->has('last_name'))
                                                <span id="first_name-error" class="error text-danger"
                                                      for="input-last-name">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" id="input-email" type="text"
                                                   placeholder="{{ __('email') }}"
                                                   value="{{ old('email', $model->email) }}" required/>
                                            @if ($errors->has('email'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('phone') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                name="phone" id="input-name" type="text"
                                                placeholder="{{ __('phone') }}"
                                                value="{{ old('phone', $model->phone) }}" required/>
                                            @if ($errors->has('phone'))
                                                <span id="phone-error" class="error text-danger"
                                                      for="input-phone">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('company') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('company_id') ? ' has-danger' : '' }}">
                                            @include('component.dropdown', [
                                 'name'     => 'company_id',
                                'prompt'   => 'companies',
                                'data'     => $companies,
                                'selected' => old('company_id', $model->company_id),
                                'options'  => ['id' => 'company_id']
                                ])
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
