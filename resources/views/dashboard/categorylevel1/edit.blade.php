@extends("dashboard.layouts.dashboard")
@section("title") Sub Category Level2 || edit @endsection
@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sub Category Level2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('sub-category.index')}}">Sub Category Level2</a></li>
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
                        <div class="card">
                            <!-- form start -->
                            <form class="form" action="{{route('categorylevel2.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card-body row">
                                    <div class="form-group col-md-6">
                                        <img class="img-thumbnail mb-2 mr-auto ml-auto" style="height: 400px;width: 400px;" src="{{$category->image}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{old('name',$category->name)}}" id="name" name="name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="sub_category_id">Main Category</label>
                                                <select class="form-control @error('sub_category_id') is-invalid @enderror " id="sub_category_id" name="sub_category_id">
                                                    @foreach($maincategories as $maincategory)
                                                        <option value="{{$maincategory->id}}" @if($category->sub_category_id == $maincategory->id) selected @endif >{{$maincategory->name}} [ {{$maincategory->mainCategory->name}} ]</option>
                                                    @endforeach
                                                </select>
                                                @error('sub_category_id')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror " id="exampleInputFile" name="image">
                                                        <label class="custom-file-label" for="exampleInputFile">Upload Category image</label>
                                                    </div>
                                                    @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="description">Description</label>
                                                <textarea rows="4" class="form-control @error('description') is-invalid @enderror " id="description" name="description">{{old('description',$category->description)}}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer row">
                                    <button type="submit" class="btn b btn-success col-md-6 m-auto">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
