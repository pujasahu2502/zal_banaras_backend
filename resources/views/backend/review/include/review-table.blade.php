@if (isset($reviews))
    @forelse ($reviews as $key => $review)
    <tr>
        <td class="text-center">{{ paginatePage($reviews,$key)}}</td>
        <td>
            @if(strlen($review->product->name) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($review->product->name) ?? '-'}}">{{ Str::limit(ucwords($review->product->name), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($review->product->name) ?? '-'}}</span>
            @endif            
        </td>
        <td>
            @php $fullName = $review->user->first_name. ' ' .$review->user->last_name; @endphp
            @if(strlen($fullName) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($fullName) ?? '-'}}">{{ Str::limit(ucwords($fullName), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($fullName) ?? '-'}}</span>
            @endif
        </td>
        {{-- <td class="text-center">
            @if(isset($review->rating))
                @for($i=0; $i<$review->rating; $i++)
                    <i class="fe-icon text-warning fill-star-color" data-feather="star"></i>
                @endfor
                @for($i=0; $i<(5-$review->rating); $i++)
                    <i class="fe-icon fill-star-null" data-feather="star"></i>
                @endfor
            @endif
        </td> --}}
        <td class="text-center"><i class="fa fa-calendar pt-1"></i> {{ dbCustomDateFormat($review->created_at) ?? '' }}</td>
        <td class="status-render text-center">
            @include('backend.review.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="view-customer-profile reviewDetail btn tooltip-top button-view btn-xs" data-url="{{ route('review.show', $review['id']) }}" id="reviewDetail" data-tooltip="Review Details"><i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_review_found' : 'no_review')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_review_found' : 'no_review')</h4>
            </div>
        </td>
    </tr>
@endif