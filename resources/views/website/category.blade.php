@extends('website.layouts.website')
@section('title')  @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('website')}}">Home</a></li>
                        <li aria-current="page" class="breadcrumb-item active">{{$targetl1Category->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-3">
                <!--
                *** MENUS AND FILTERS ***
                _________________________________________________________
                -->
                <div class="card sidebar-menu mb-4">
                    <div class="card-header">
                        <h3 class="h4 card-title">Categories</h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column category-menu">
                            @foreach($targetl2Category as $cat)
                            <li><a href="" class="nav-link">{{$cat->name}} <span class="badge badge-secondary">{{\App\Models\Product::where('category_id',$cat->id)->count()}}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card sidebar-menu mb-4">
                    <div class="card-header">
                        <h3 class="h4 card-title">Brands <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                @foreach($brands as $brand)
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> {{$brand->name}} ({{\App\Models\Product::where('brand_id',$brand->id)->count()}})
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                        </form>
                    </div>
                </div>
                <!-- *** MENUS AND FILTERS END ***-->
                <div class="banner"><a href="#"><img src="{{asset('Website/img/banner.jpg')}}" alt="sales 2014" class="img-fluid"></a></div>
            </div>
            <div class="col-lg-9">
                <div class="box">
                    <h1>{{$targetl1Category->name}}</h1>
                    <p>{{$targetl1Category->description}}</p>
                </div>
                <div class="box info-bar">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 products-showing">Showing <strong>12</strong> of <strong>25</strong> products</div>
                        <div class="col-md-12 col-lg-7 products-number-sort">
                            <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                                <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-secondary btn-sm">24</a><a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div>
                                <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                                    <select name="sort-by" class="form-control">
                                        <option>Price</option>
                                        <option>Name</option>
                                        <option>Sales first</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row products">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front"><a href="detail.html"><img style="width: 100%;height: 300px" src="{{(\App\Models\ProductColor::where('product_id',$product->id)->first())->Image[0]->name}}" alt="" class="img-fluid"></a></div>
                                        <div class="back"><a href="detail.html"><img style="width: 100%;height: 300px" src="@if((\App\Models\ProductColor::where('product_id',$product->id)->first())->Image->count() > 1) {{(\App\Models\ProductColor::where('product_id',$product->id)->first())->Image[1]->name}} @else {{(\App\Models\ProductColor::where('product_id',$product->id)->first())->Image[0]->name}} @endif" alt="" class="img-fluid"></a></div>
                                    </div>
                                </div><a href="detail.html" class="invisible"><img style="width: 100%;height: 300px" src="{{(\App\Models\ProductColor::where('product_id',$product->id)->first())->Image[0]->name}}" alt="" class="img-fluid"></a>
                                <div class="text">
                                    <h3><a href="detail.html">{{$product->name}}</a></h3>
                                    <p class="price">
                                        <del></del>${{$product->price}}
                                    </p>
                                    <p class="buttons"><a href="detail.html" class="btn btn-outline-secondary">View detail</a><a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a></p>
                                </div>
                                <!-- /.text-->
                            </div>
                            <!-- /.product            -->
                        </div>
                    @endforeach
                    <!-- /.products-->
                </div>
                <div class="pages">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        {{$products->links()}}
                    </nav>
                </div>
            </div>
            <!-- /.col-lg-9-->
        </div>
    </div>
@endsection
