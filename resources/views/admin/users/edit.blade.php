@extends('admin.layout.master')
@section('style')
    <style>
        .reqr {
            color: red;
        }

        .border_all {
            border: 1px solid #000 !important;
        }

        table {
            max-width: 99% !important;
            margin: 0 auto;
            padding: 0;
        }
    </style>

@endsection
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User Detail</h3>
                <div class="col-sm-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            <strong>OOPS! You might have missed to fill some required fields. Please check the errors.
                            </strong>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif
                </div>

                <div class="box-tools pull-right">
                    <a href="{{route('users-list.index')}}" class="btn btn-default btn-sm backlink"><i
                                class="fa fa-backward"
                                aria-hidden="true"></i> Back</a>
                </div>
                {{ Form::open(['route'=>['users.update',$model->id],'method'=>'put']) }}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label for="nav_name">Name <i class="reqr">*</i> </label>
                            {{ Form::text('name',$model->name, ['class' => 'form-control', 'required' => 'required','placeholder'=>'PageType Title']) }}
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-top: 10px;">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
{{--                                {{ Form::checkbox('verify', '1', $model->verify) }}--}}
                                {{--<input checked="checked" name="verify" type="checkbox" value="1">--}}
                                <input type="checkbox" name="verify" value="{{ $model->verify }}"
                                       @if ($model->verify == 1)
                                       checked
                                        @endif>
                                <label class="custom-control-label"> Approved</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9" style="padding-top: 10px;">
                        <div class="form-group col-md-10">
                            <label for="email">Email <i class="reqr">*</i> </label>
                            {{ Form::text('email',$model->email, ['class' => 'form-control', 'required' => 'required','placeholder'=>'PageType Title']) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        {{ Form::submit('Update', ['class' => 'btn btn-block btn-primary']) }}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
@endsection