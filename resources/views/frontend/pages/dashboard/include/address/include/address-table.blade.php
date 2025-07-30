@if (isset($addressData) && count($addressData) > 0)
    <div class="order-address-block more-address-block">
        <div class="order-address-carousel">
            @forelse ($addressData as $address)
                <div class="card address-card-block mt-2 mb-2">
                    @if ($address['default_address'] == '1')
                        <div class="address-checkbox">
                            <span class="p-2" style="background: var(--light-green);color:#fff">Default</span>
                        </div>
                    @endif
                    <div class="user-detail-block mt-2">
                        <p class="text-capitalize"><span class="arrow-icon"><i data-feather="user"
                                    class="feather mr-2"></i></span>
                            {{ ($address->first_name ?? ' ') . ' ' . ($address->last_name ?? ' ') }}</p>
                        <p><span class="arrow-icon"><i data-feather="mail" class="feather mr-2"></i></span>
                            {{ $address->email ?? '-' }}</p>
                        <p><span class="arrow-icon"><i data-feather="phone" class="feather mr-2"></i></span>
                            {{ $address->mobile ?? '-' }}</p>
                        <p class="text-capitalize"><span class="arrow-icon user-address-block"><i
                                    data-feather="navigation" class="feather mr-2"></i></span> <span
                                class="user-inner-address-block">{{ $address->address ?? '-' }}</span></p>
                        <p class="text-capitalize"><span class="arrow-icon"><i data-feather="map-pin"
                                    class="feather mr-2"></i></span> {{ $address->state ?? '-' }}</p>
                        <p class="text-capitalize"><span class="arrow-icon"><i data-feather="globe"
                                    class="feather mr-2"></i></span> {{ $address->city ?? '-' }}</p>
                        <p><span class="arrow-icon"><i data-feather="flag" class="feather mr-2"></i></span>
                            {{ $address->zipcode ?? '-' }}</p>
                    </div>
                    <div class="order-btn-block">
                        <ul class="order-btn-action-block">
                            <li><a href="{{ route('address.edit', $address['id']) }}"
                                    class="order-action-btn edit-btn"><img
                                        src="{{ asset('front-end/assets/image/edit-icon.svg') }}" alt=""
                                        class="mr-2"> Edit</a></li>
                            <li><a href="#" class="order-action-btn delete-btn address-delete"
                                    data-id="{{ $address['id'] }}"
                                    data-url="{{ route('address.destroy', $address['id']) }}"><img
                                        src="{{ asset('front-end/assets/image/delete-icon.svg') }}" alt=""
                                        class="mr-2"> Delete</a></li>
                        </ul>
                    </div>
                </div>
            @empty
                <div class="card address-card-block address-card-empty mt-2 mb-2">
                    <!-- <h4 class="title text-uppercase">@lang('no_address') </h4> -->
                    <section class="no-data-section">
                        <div class="container">
                            <div class="no-data-block">
                                <img alt="logo" src="{{ asset('front-end/assets/image/no-data-empty.png') }}"
                                    height="200" width="200" />
                                <h3 class="mt-3">You don't have any saved address please add an address to continue shopping.</h3>
                                <!-- <p>The data you are looking for might have been removed had its name changed or is temporarily unavailable.</p> -->
                                <a href="{{ 'home' }}" class="btn-primary">Go to homepage</a>
                            </div>
                        </div>
                    </section>
                </div>
            @endforelse
        </div>
    </div>
@else
    <div class="card address-card-block address-card-empty mt-2 mb-2">
        <!-- <h4 class="title text-uppercase">@lang('no_address') </h4> -->
        <section class="no-data-section">
            <div class="container">
                <div class="no-data-block">
                    <img alt="logo" src="{{ asset('front-end/assets/image/no-data-empty.png') }}" height="200"
                        width="200" />
                    <h3 class="mt-3">You don't have any saved address please add an address to continue shopping.</h3>
                    <!-- <p>The data you are looking for might have been removed had its name changed or is temporarily unavailable.</p> -->
                    <a href="{{ 'home' }}" class="btn-primary">Go to homepage</a>
                </div>
            </div>
        </section>
    </div>
@endif
