<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item"><a href="{{route('admin-home')}}"><span>Dashboard</span></a></li>
            @if(Request::segment(2) == 'product')
                @if(Request::segment(3) != '')
                    <li class="breadcrumb-item"><a href="{{route('product.index')}}"><span>Product</span></a></li>
                    <li class="breadcrumb-item active"><span>{{$title ?? ''}}</span></li>
                @else
                    <li class="breadcrumb-item active"><span>Product</span></li>
                @endif
            @elseif(Request::segment(2) == 'variant')
                @if(Request::segment(3) != '')
                    <li class="breadcrumb-item"><a href="{{route('attribute.index')}}"><span>Attribute</span></a></li>
                    <li class="breadcrumb-item active"><span>Variant</span></li>
                    <li class="breadcrumb-item active"><span>{{$title ?? ''}}</span></li>

                @else
                    <li class="breadcrumb-item active"><span>Product</span></li>
                @endif
            @else
                @if($title != 'Dashboard')
                    <li class="breadcrumb-item active"><span>{{$title ?? ''}}</span></li>
                @endif
            @endif
        </ol>
    </nav>
</div>