@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])
@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="
                        {{$model->exists ? route('company.update', $model->id) : route('company.store') }}"
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
                                    <label class="col-sm-2 col-form-label">{{ __('name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" id="input-name" type="text"
                                                   placeholder="{{ __('name') }}"
                                                   value="{{ old('name', $model->name) }}" required/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('name') }}</span>
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
                                                      for="input-rmail">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('website') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('website') ? ' has-danger' : '' }}">
                                            <input
                                                class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                name="website" id="input-name" type="text"
                                                placeholder="{{ __('website') }}"
                                                value="{{ old('website', $model->website) }}" required/>
                                            @if ($errors->has('website'))
                                                <span id="website-error" class="error text-danger"
                                                      for="input-name">{{ $errors->first('website') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{ __('logo') }}</label>
                                        <div class="col-sm-7">
                                            <div class="col-xs-12 ">
                                                <div class="col-xs-12 ">
                                                    <input type="file" name="logo" id="logo" accept="image/png, .jpeg, .jpg, image/gif">
                                                </div>
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
