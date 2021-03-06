@extends("dashboard.layouts.dashboard")
@section("title") Size @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Size</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Size</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-lg btn-primary mb-3" href="{{route('size.create')}}"><i class="fa fa-plus"></i> Add Size </a>
                    </div>
                </div>
                @include('dashboard.includes.alert.success')
                @include('dashboard.includes.alert.errors')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Controllers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($character->count() > 0)
                                        @foreach($character as $char)
                                    <tr>
                                        <td class="align-middle">{{$char->name}}</td>
                                        <td class="align-middle">
                                            <a href="{{route('brand.edit',$char->id)}}" class="mr-2"><i class="fa fa-edit text-success"></i></a>
                                        </td>
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#example").DataTable({
                scrollX:true,
            });
        });
    </script>
@endsection
