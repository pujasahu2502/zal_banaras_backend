<header class="filter-sidebar filters-header">
    <button class="filter-toggle text-white" aria-label="toggle sidebar" aria-expanded="false">
        <i data-feather="filter"></i>
    </button>
</header>

<div class="sidebar-block filtersidebar-container filtersidebar-closed mb-4">
    <div class="card sidebar-card">
        <form action="{{route("frontend.products.index")}}" method="get">
            <article class="filter-group">
                <header class="card-header"> <a href="#" data-toggle="collapse" data-target="#collapse_aside1" data-abc="true" aria-expanded="true" class=""> <i class="icon-control fa fa-chevron-down"></i>
                        <h6 class="title text-uppercase">Categories </h6>
                    </a> </header>
                <div class="filter-content collapse show" id="collapse_aside1">
                    <div class="card-body">
                        <div class="sidebar-listing-block">
                            @foreach ($allCategory as $keyCategory => $category)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1{{$keyCategory}}" name="category[]" value="{{$category["slug"] ?? "NA"}}" {{ request()->input('category')  ?  (in_array($category["slug"], request()->input('category')) > 0 ? "checked" : "" ) : " "}}>
                                <label class="form-check-label" for="exampleCheck1{{$keyCategory}}">{{$category["name"] ?? "NA"}} ({{$category["product_category_active_count"]}})</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
            <article class="filter-group">
                <header class="card-header"> <a href="#" data-toggle="collapse" data-target="#collapse_asidebrand" data-abc="true" aria-expanded="true" class=""> <i class="icon-control fa fa-chevron-down"></i>
                        <h6 class="title text-uppercase">Brand </h6>
                    </a> </header>
                <div class="filter-content collapse show" id="collapse_asidebrand">
                    <div class="card-body">
                        <div class="sidebar-listing-block">
                            @foreach ($allBrand as $keyBrand => $brand)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="brand1{{$keyBrand}}" name="brand[]" value="{{$brand["slug"] ?? "NA"}}" {{ request()->input('brand')  ?  (in_array($brand["slug"], request()->input('brand')) > 0 ? "checked" : "" ) : " "}}>
                                    <label class="form-check-label" for="brand1{{$keyBrand}}">{{$brand["name"] ?? "NA"}} ({{$brand["product_count"]}})</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
            {{-- <article class="filter-group">
                <header class="card-header"> 
                    <a href="#" data-toggle="collapse" data-target="#collapse_asiderating" data-abc="true" aria-expanded="true" class=""> <i class="icon-control fa fa-chevron-down"></i>
                        <h6 class="title text-uppercase">Ratings </h6>
                    </a> 
                </header>
                <div class="filter-content collapse show" id="collapse_asiderating">
                    <div class="card-body">
                        <div class="review-filter-block">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rating15" name="rating[]" value="5" {{ request()->input('rating')  ?  (in_array(5, request()->input('rating')) > 0 ? "checked" : "" ) : " "}}>
                                <div class="review-inner-check-block">
                                    <label title="1 star" class="active" for="rating15"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label title="1 star" class="active" for="rating15"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label title="1 star" class="active" for="rating15"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label title="1 star" class="active" for="rating15"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label title="1 star" class="active" for="rating15"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label class="form-check-label" for="rating15">5 stars</label>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rating14" name="rating[]" value="4" {{ request()->input('rating')  ?  (in_array(4, request()->input('rating')) > 0 ? "checked" : "" ) : " "}}>
                                <div class="review-inner-check-block">
                                    <label for="rating14" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating14" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating14" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating14" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating14" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label class="form-check-label" for="rating14">4 stars</label>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rating13" name="rating[]" value="3" {{ request()->input('rating')  ?  (in_array(3, request()->input('rating')) > 0 ? "checked" : "" ) : " "}}>
                                <div class="review-inner-check-block">
                                    <label for="rating13" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating13" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating13" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating13" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating13" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label class="form-check-label" for="rating13">3 stars</label>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rating12" name="rating[]" value="2" {{ request()->input('rating')  ?  (in_array(2, request()->input('rating')) > 0 ? "checked" : "" ) : " "}}>
                                <div class="review-inner-check-block">
                                    <label for="rating12" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating12" title="1 star" class="active"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating12" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating12" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating12" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label class="form-check-label" for="rating12">2 stars</label>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rating11" name="rating[]" value="1" {{ request()->input('rating')  ?  (in_array(1, request()->input('rating')) > 0 ? "checked" : "" ) : " "}}>
                                <div class="review-inner-check-block">
                                    <label for="rating11" title="1 star" class="active"><i class="active fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating11" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating11" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating11" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label for="rating11" title="1 star"><i class="fa fa-star" aria-hidden=""></i></label>
                                    <label class="form-check-label" for="rating11">1 stars</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article> --}}
            <article class="filter-group">
                <header class="card-header"> <a href="#" data-toggle="collapse" class="collapsed" data-target="#collapse_aside2" data-abc="true" aria-expanded="true" class=""> <i class="icon-control fa fa-chevron-down"></i>
                        <h6 class="title text-uppercase">Sort By </h6>
                    </a> </header>
                <div class="filter-content sort-by-filter-block collapse show" id="collapse_aside2">
                    <select name="sort" class="sort-field-select mt-3 mb-3">
                        <option disabled selected>Sort By</option>
                        <option value="new" {{ request()->input('sort') == "new"  ? 'selected' : 'selected'}}>Newest to Oldest</option>
                        <option value="old" {{ request()->input('sort') == "old" ? 'selected' : ' '}}>Oldest to Newest</option>
                        <div class="filter-content collapse show" id="collapse_aside1">
                    </select>
                </div>
            </article>
            <article class="filter-group">
                <header class="card-header"> <a href="#" data-toggle="collapse" data-target="#collapse_asidebrand" data-abc="true" aria-expanded="true" class=""> <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title text-uppercase">Miscellaneous</h6>
                    </a> 
                </header>
                <div class="filter-content sort-by-filter-block collapse show" id="collapse_aside2">
                    <div class="filter-content collapse show" id="collapse_asidebrand">
                        <div class="card-body">
                            <div class="sidebar-listing-block h-auto">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="featureP" name="featProduct" value="ft" {{ request()->input('featProduct') ? 'checked' : ''}} />
                                    <label class="form-check-label" for="featureP">Featured Product</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            {{--@foreach($allAttribute as $key => $attribute)
                <article class="filter-group">
                    <header class="card-header"> <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapse_asidea{{$key}}" data-abc="false" aria-expanded="false" class=""> <i class="icon-control fa fa-chevron-down"></i>
            <h6 class="title text-uppercase">{{$attribute["name"]}} </h6>
            </a> </header>
            <div class="filter-content collapse {{request()->input(str_replace("-","_",$attribute["slug"])) ? "show" : ""}}" id="collapse_asidea{{$key}}">
                <div class="card-body">
                    @foreach ($attribute["activeVariations"] as $keyVariation => $variation)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck{{$variation["slug"]}}" name="{{str_replace("-","_",$attribute["slug"])}}[]" value="{{$variation["slug"] ?? "NA"}}" {{ request()->input(str_replace("-","_",$attribute["slug"]))  ?  (in_array($variation["slug"], (request()->input(str_replace("-","_",$attribute["slug"])))) > 0 ? "checked" : "" ) : " "}}>
                        <label class="form-check-label" for="exampleCheck{{$variation["slug"]}}">{{$variation["name"] ?? "NA"}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            </article>
            @endforeach--}}
            <div class="filter-btn-block">
                <button type="submit" class="btn submit-filter" name="paginate" value="{{request()->input('paginate') ? request()->input('paginate') : 12 }}">Filter</button>
                <a href="{{route("frontend.products.index")}}" class="btn reset-filter">Reset</a>
            </div>

        </form>
        {{-- <div class="promotion-slider-block">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="call-log-block">
                            <div class="inner-call-log">
                                <div class="call-img mb-3">
                                    <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
    </div>
    <h5>Need help finding the product?</h5>
    <p>Our team is always available to assist you with any questions or concerns.</p>
    <a href="#" class="btn-primary">1800-6452-5250</a>
</div>
</div>
</div>
<div class="carousel-item">
    <div class="call-log-block">
        <div class="inner-call-log">
            <div class="call-img mb-3">
                <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
            </div>
            <h5>Need help finding the product?</h5>
            <p>Our team is always available to assist you with any questions or concerns.</p>
            <a href="#" class="btn-primary">1800-6452-5250</a>
        </div>
    </div>
</div>
<div class="carousel-item">
    <div class="call-log-block">
        <div class="inner-call-log">
            <div class="call-img mb-3">
                <img alt="logo" src="{{ asset('front-end/assets/image/phone-join.png') }}" />
            </div>
            <h5>Need help finding the product?</h5>
            <p>Our team is always available to assist you with any questions or concerns.</p>
            <a href="#" class="btn-primary">1800-6452-5250</a>
        </div>
    </div>
</div>
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div>
</div> --}}
</div>

</div>