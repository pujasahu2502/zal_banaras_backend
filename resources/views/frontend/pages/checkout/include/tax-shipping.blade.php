@if(session()->has($title))
    @if(count(session($title)))
        @foreach ( session($title) as $data)
            <div class="order-payment-field {{$title}}">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="order-payment-text">
                        <p class="text-uppercase">{{$title}} <span class="shiping-title text-capitalize {{$data["name"] ? "" : "d-none" }} ">({{$data["name"]}}) </span></p>
                    </div>
                    <div class="order-payment-price">
                        <p>${{ $title == "tax" ? $data["taxInDollar"].'('.$data["tax"].'%)' : $data["tax"]}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="order-payment-field {{$title}}">
            <div class="d-flex align-items-center justify-content-between">
                <div class="order-payment-text">
                    <p class="text-uppercase">{{$title}}</p>
                </div>
                <div class="order-payment-price">
                    <p>$0.00</p>
                </div>
            </div>
        </div>
    @endif
@else
    <div class="order-payment-field {{$title}}">
        <div class="d-flex align-items-center justify-content-between">
            <div class="order-payment-text">
                <p class="text-uppercase">{{$title}}</p>
            </div>
            <div class="order-payment-price">
                <p>$0.00</p>
            </div>
        </div>
    </div>
@endif