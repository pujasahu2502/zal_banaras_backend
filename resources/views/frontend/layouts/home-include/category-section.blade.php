<section class="category-section">
    <div class="container">
        <div class="head-block text-center mb-4 wow bounceInUp">
            <h2 class="common-title text-uppercase mb-4">Mounts <span class="inner-text">And</span> Rings</h2>
        </div>
        <div class="mounting-inner-block">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="card category-card-one category-card-block wow slideInLeft">
                        <div class="category-inner-card-block">
                            <div class="category-heading">
                                <h3 class="text-uppercase">{{$category->name ?? ''}}</h3>
                            </div>
                            <div class="category-list">
                                <ul>
                                    <li class="d-flex"><span class="check-icon mr-2"><i data-feather="check"></i></span> Precision machined from a solid block of top-grade billet aluminum</li>
                                    <li class="d-flex"><span class="check-icon mr-2"><i data-feather="check"></i></span> Custom made to fit each type of firearm and align perfectly with your rifle’s receiver</li>
                                    <li class="d-flex"><span class="check-icon mr-2"><i data-feather="check"></i></span> No moving parts between the firearm and the scope</li>
                                </ul>
                            </div>
                            <div class="category-btn-block d-flex justify-content-between align-items-center mt-2">
                                <div class="category-btn">
                                    <a href="{{route('frontend.products.index',['category[]' => $category->slug ])}}" class="btn-primary browse-btn">Browse</a>
                                </div>
                               
                                {{-- @if($category->video_url != '')
                                <div class="category-video">
                                    <a id="category-video" data-toggle="modal" data-target="#categoryVideo" data-url={{$category->video_url ?? ' '}}><img src="{{ asset('front-end/assets/image/youtube-icon.png') }}" class="d-block w-100" alt=""></a>
                                </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
        </div>
        
        
    </div>
</section>