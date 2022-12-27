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
                <h3 class="box-title">Upload Excel Sheet</h3><br>
                {{  Form::open(array('route' => 'category-import-csv-excel','method'=>'POST','files'=>'true')) }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('file','Select File to Import:',['class'=>'col-md-3']) !!}
                            <div class="col-md-9">
                                {!! Form::file('file', array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>

@endsection