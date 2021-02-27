@extends("dashboard.layouts.dashboard")
@section("title") Product @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                        <a class="btn btn-lg btn-primary mb-3" href="{{route('product.create')}}"><i class="fa fa-plus"></i> Add Product </a>
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
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Barcode</th>
                                        <th>price</th>
                                        <th>Controllers</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($products->count() > 0)
                                        @foreach($products as $product)
                                    <tr>
                                        <td class="align-middle">{{$product->name}}</td>
                                        <td class="align-middle">{{$product->Brand->name}}</td>
                                        <td class="align-middle"><div class="rounded mx-auto d-block" style="width: 100px;height: 100px;" alt="...">{!! $product->barcode !!}</div></td>
                                        <td class="align-middle">{{$product->price}}</td>
                                        <td class="align-middle">
                                            <a href="{{route('product.edit',$product->id)}}" class="mr-2"><i class="fa fa-edit text-success"></i></a>
                                            <a href="" class="mr-2 delete" ><i class="fa fa-trash text-danger"></i></a>
                                            <form method="POST" action="{{route('product.destroy', $product->id) }}" >
                                            @method('DELETE')
                                            @csrf
                                            </form>
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

