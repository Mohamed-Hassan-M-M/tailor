@extends("dashboard.layouts.dashboard")
@section("title") Product || Edit @endsection
@section('css') <link rel="stylesheet" href="{{asset("Dashboard/multistepform.css")}}"> @endsection
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
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}">Product</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                    <div class="col-md-12 m-auto">
                        @include('dashboard.includes.alert.success')
                        @include('dashboard.includes.alert.errors')
                        <!-- general form elements -->
                            <!-- MultiStep Form -->
                            <div class="card p-4">
                                <!-- form start -->
                                <form id="msform" class="form" action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                    <!-- progressbar -->
                                    <ul id="progressbar" class="card-body row">
                                        <li class="active">Product Details</li>
                                        <li>Product Colors</li>
                                        <li>Finish</li>
                                    </ul>
                                    <!-- fieldsets -->
                                    <fieldset class="form-group">
                                        <h2 class="fs-title mb-5">Product Details</h2>
                                        <div class="d-flex row">
                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" placeholder="Product name" name="name" value="{{old('name',$product->name)}}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select class="form-control @error('category_id') is-invalid @enderror " id="category_id" name="category_id">
                                                    <option value="">Choose category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif >{{$category->name}}[ {{$category->subCategory->name}} ][ {{$category->subCategory->subCategory->name}} ][ {{$category->subCategory->subCategory->mainCategory->name}} ]</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row d-flex">
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control @error('price') is-invalid @enderror " id="price" placeholder="Product price" name="price" value="{{old('price',$product->price)}}">
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control @error('discount') is-invalid @enderror " id="discount" placeholder="Product discount" name="discount" value="{{old('discount',$product->discount)}}">
                                                @error('discount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select class="form-control @error('brand_id') is-invalid @enderror " id="brand_id" name="brand_id">
                                                    <option value="">Choose brand</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}" @if($brand->id == $product->brand_id) selected @endif >{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <!--<div class="form-group col-md-3">
                                                <select class="form-control @error('color_id') is-invalid @enderror " id="color_id" name="color_id[]" multiple>
                                                    <option disabled>Choose Colors</option>
                                                    @foreach($colors as $color)
                                                        <option value="{{$color->id}}" @if(in_array($color->id, array_values((array)$product_colorarray)[0])) selected @endif >{{$color->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('color_id[*]')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <textarea rows="5" class="form-control @error('description') is-invalid @enderror " id="description" name="description">{{old('discount',$product->description)}}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next"/>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <h2 class="fs-title">Colors details</h2>
                                        <div class="row" id="colors_details">
                                            @foreach($product_colors as $ind => $product_color)
                                                <div class="row col-md-12">
                                                    <div class="form-group col-md-12">
                                                        <h4 class="text-left">{{$product_color->Color->name}}</h4>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <div id="carouselExampleControls{{$product_color->id}}" class="carousel slide" data-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        @foreach(\App\Models\Image::where('product_color_id', $product_color->id)->get() as $index => $pimage)
                                                                        <div class="carousel-item @if($index == 0) active @endif ">
                                                                            <img class="img-thumbnail mb-2 mr-auto ml-auto d-block w-100" style="height: 300px;width: 300px;" src="{{$pimage->name}}">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <a class="carousel-control-prev" href="#carouselExampleControls{{$product_color->id}}" role="button" data-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                    <a class="carousel-control-next" href="#carouselExampleControls{{$product_color->id}}" role="button" data-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row d-flex">
                                                                    @foreach($sizes as $index => $size)
                                                                        <div class="col-md-3 text-left pl-3">
                                                                            <input type="checkbox" class="size" value="{{$size->id}}" @if(\App\Models\ProductColorSize::where('product_color_id', $product_color->id)->where('size_id',$size->id)->first()) checked @endif onchange="showCount(this)" style="width: auto" name="size[{{$ind}}][]">
                                                                            <label> {{$size->name}}</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            @if(\App\Models\ProductColorSize::where('product_color_id', $product_color->id)->where('size_id',$size->id)->first())
                                                                                <input type="number" class="form-control" name="count[{{$ind}}][]" value="{{\App\Models\ProductColorSize::where('product_color_id', $product_color->id)->where('size_id',$size->id)->pluck('count')[0]}}">
                                                                            @else
                                                                                <input type="number" class="form-control" name="count[{{$ind}}][]">
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                        <input type="button" name="next" class="next action-button" value="Next"/>
                                    </fieldset>
                                    <fieldset>
                                        <h2 class="fs-title">Your Product almost done hit finnish to update</h2>
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                        <input type="submit" class="action-button" value="Finish"/>
                                    </fieldset>
                                </form>

                            </div>
                            <!-- /.MultiStep Form -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section("script")
    <script src="{{asset("Dashboard/multistepform.js")}}"></script>
@endsection
