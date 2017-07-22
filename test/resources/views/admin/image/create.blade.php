@extends('admin.master')
@section('main')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Image</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Image Form
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {{Form::open(['route' => 'image.store', 'method'=> 'POST', 'role' => 'form', 'files'=> true])}}
                                <div class="form-group">
                                    <label for="img-name">Name</label>
                                    <input class="form-control" id="img-name" name="name" placeholder="Name"
                                           required
                                           value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label>File Image</label>
                                    <input type="file" name="image" required>
                                </div>
                                <button type="submit" class="btn btn-info">Save</button>
                                {{Form::close()}}
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- End Page Content --!>
@stop
