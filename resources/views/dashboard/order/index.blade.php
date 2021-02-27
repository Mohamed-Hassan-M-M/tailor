@extends("dashboard.layouts.dashboard")
@section("title") Order @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Order</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @include('dashboard.includes.alert.success')
                @include('dashboard.includes.alert.errors')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example" class="table table-striped table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Order No</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orders->count() > 0)
                                        @foreach($orders as $order)
                                    <tr>
                                        <td class="align-middle">{{$order->Customer->name}}</td>
                                        <td class="align-middle">{{$order->Customer->phone}}</td>
                                        <td class="align-middle">{{$order->Customer->address}}</td>
                                        <td class="align-middle">{{$order->id}}</td>
                                        <td class="align-middle">{{$order->date}}</td>
                                        <td class="align-middle @if($order->deliver == 1) text-success @else text-danger @endif "> @if($order->deliver == 1) Delivered @else Under Delivering @endif </td>
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
            $(".delete").click(function(e){
                e.preventDefault();
                if(!confirm('Warnning! are you sure to delete'))
                    return false;
                else {
                    $(this).next().submit();
                }
            });
        });
    </script>
@endsection
