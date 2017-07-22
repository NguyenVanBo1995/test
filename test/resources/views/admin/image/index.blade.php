@extends('admin.master')
@section('main')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Images</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of images
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover"
                               id="dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th width="150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($images))
                                <?php $i = 1;?>
                                @foreach($images as $image)
                                    <tr class="odd gradeX">
                                        <td>{{$i++}}</td>
                                        <td>{{$image->name}}</td>
                                        <td><img src="{{$image->url}}" width="60px"></td>
                                        <td class="center">{{$image->created_at}}</td>
                                        <td class="center">
                                            <a href="#" onclick="document.getElementById('form-edit-image').submit()"
                                               title="edit"><i class="fa fa-edit fa-fw"></i>Edit</a>
                                            <a href="#" title="'delete" onclick="confiemDelete()"><i
                                                        class="fa fa-trash fa-fw"></i>Delete</a>
                                            {{Form::open(['route' => ['image.edit', $image->id], 'method' => 'GET', 'id'=> 'form-edit-image'])}}
                                            {{Form::close()}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <a href="#" onclick="document.getElementById('form-create-image').submit();" class="btn btn-info"
                   title="create a new image">Create Image</a>
            </div>
            {{Form::open(['route' => 'image.create', 'id' => 'form-create-image', 'method'=> 'GET'])}}
            {{Form::close()}}
        </div>
        <!--  /.row !-->
    </div>
    <!-- /#page-wrapper -->

    {{Form::open(['route' => ['image.destroy', $image->id], 'method' => 'DELETE', 'id'=> 'form-delete-image'])}}
    {{Form::close()}}
@stop
@section('extra-js')
    <script>
        @if(! empty(session('response')))
        <?php $response = session('response');?>
            @if($response['status'] == 'success')
              $.notify('{{$response['message']}}', 'success');
        console.log(1);
        @endif
        @if($response['status'] == 'fail')
              $.notify('{{$response['message']}}', 'error');
        @endif
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
        function confiemDelete() {
            var x = confirm("Are you sure you want to delete this image?");
            if (x) {
                $('#form-delete-image').submit();
            }
        }
    </script>
@stop


