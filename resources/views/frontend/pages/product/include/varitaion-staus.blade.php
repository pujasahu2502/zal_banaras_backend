<div class="modal login-modal-pop fade" id="availableVariant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-login modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header p-0">
                <div class="nav-home-logo mt-3 mb-3 relative">
                    <img alt="logo" src="{{ asset('front-end/assets/image/dnz-logo.png') }}" />
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true"><i class="fe-icon" data-feather="x"></i></span></button>
            </div>
            <div class="modal-body">
                <h4 class="text-uppercase">{{$product['name'] ?? '' }}</h4>
                <p>Available variant chart</p>
                <table class="table">
                    <thead>
                        <tr>
                            @foreach ( $product['productAttribute'] as $keyAttr => $attribute)
                                <th>
                                    {{ $attribute["attribute"]["name"] ?? '' }}
                                </th>
                            @endforeach
                            <th>
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( collect($product['productVariation'])->where('status','1') as $keyAttr => $variant)
                        <tr>
                            @foreach ( $variant["variation"] as $variation)
                                <td>
                                    {{$variation["name"] ?? ''}}
                                </td>
                            @endforeach
                            <td>
                                <span class="bg-success p-2 text-white">Available</span>
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                red
                            </td>
                            <td>
                                red
                            </td>
                            <td>
                                <span class="bg-danger p-2 text-white">Not Available</span>
                            </td>
                        </tr> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="modal-footer">Don't have an account? <a href="#registerModal" data-dismiss="modal" data-toggle="modal" class="ml-1"> Register Now</a></div> --}}
        </div>
    </div>
  </div>