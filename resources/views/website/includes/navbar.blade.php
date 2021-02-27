<nav class="navbar navbar-expand-lg">
    <div class="container"><a href="index.html" class="navbar-brand home"><img src="{{asset('Website/img/logo.png')}}" alt="Obaju logo" class="d-none d-md-inline-block"><img src="{{asset('Website/img/logo-small.png')}}" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">Obaju - go to homepage</span></a>
        <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="#" class="nav-link active">Home</a></li>
                @foreach($mainCategory as $mainCat)
                    <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">{{$mainCat->name}}<b class="caret"></b></a>
                        <ul class="dropdown-menu megamenu">
                            <li>
                                <div class="row">
                                    @foreach(\App\Models\SubCategory::where('main_category_id',$mainCat->id)->get() as $subCat)
                                        <div class="col-md-6 col-lg-3">
                                            <h5>{{$subCat->name}}</h5>
                                            <ul class="list-unstyled mb-3">
                                                @foreach(\App\Models\Categoryl1::where('sub_category_id',$subCat->id)->get() as $catl1)
                                                    <li class="nav-item"><a href="{{route('show.category',$catl1->id)}}" class="nav-link">{{$catl1->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
                <!-- /.nav-collapse-->
                <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="basket.html" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span>3 items in cart</span></a></div>
            </div>
        </div>
    </div>
</nav>
<div id="search" class="collapse">
    <div class="container">
        <form role="search" class="ml-auto">
            <div class="input-group">
                <input type="text" placeholder="Search" class="form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
