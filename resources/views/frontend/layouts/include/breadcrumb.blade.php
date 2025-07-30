@if(Request::segment(2) == '')
    {{-- For Front Pages --}}
    <section class="jumbotron-section">
        <div class="container">
            <div class="jumbotron-bg-img">
                <div class="jumbotron-content wow slideInLeft">
                    <div class="bs-example">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-arrow"><i data-feather="chevron-right"></i></li>
                                <li class="breadcrumb-item active"><a href="{{$url}}">{{$title}}</a></li>
                            </ol>
                        </nav>
                    </div>
                    <h3>{{$subTitle}}</h3>
                    {{-- <p>Lorem ipsum dolor sit amet consectetur. Sodales amet magnis in nibh. Urna ipsum arcu tortor iaculis neque. Dictum faucibus elementum est pretium. Iaculis magnis viverra urna morbi habitasse ipsum fringilla adipiscing habitant. Ultrices eget morbi purus eu tempor ultrices mauris morbi amet. A non nulla sed commodo. Etiam et convallis sed ullamcorper ut in cras netus. Nisi congue nisl euismod sit. Tristique mauris blandit pellentesque quam.</p> --}}
                </div>
            </div>
        </div>
    </section>
@else 
    {{-- For Front Pages --}}
    <section class="breadcrumb-section">
        <div class="container">
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
                        <li class="breadcrumb-arrow"><i data-feather="chevron-right"></i></li>
                        <li class="breadcrumb-item"><a href="{{$url}}">{{$title}}</a></li>
                        <li class="breadcrumb-arrow"><i data-feather="chevron-right"></i></li>
                        <li class="breadcrumb-item active">{{$subTitle}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
@endif 
