@if (isset($dealerData))
    @forelse ($dealerData as $key => $dealer)
    <tr>
        <td class="text-center">{{ paginatePage($dealerData,$key)}}</td>
        <td class="text-center">
            @if ($dealer->getMedia('dealer')->count())
                @foreach ($dealer->getMedia('dealer') as $media)
                    <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" height="60" width="60">
                @endforeach
            @else
                <img src="{{ asset('backend/no-img.png') }}" height="60" width="60">
            @endif
        </td>
        <td>
            @if(strlen($dealer->title) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($dealer->title) ?? '-'}}">{{ Str::limit(ucwords($dealer->title), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($dealer->title) ?? '-'}}</span>
            @endif
        </td>
        <td>
            @if(strlen($dealer->email) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{$dealer->email ?? '-'}}">{{ Str::limit($dealer->email, 30) ?? '-'}}</span>
            @else
                <span>{{ $dealer->email ?? '-'}}</span>
            @endif
        </td>
        <td class="text-center">{{ $dealer->phone ?? '-'}}</td>
        <td class="text-center">{{ $dealer['address']->state }}</td>       
        <td class="status-render text-center">
            @include('backend.dealer.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-dealer-modal btn button-success tooltip-top btn-xs" data-url="{{ route('dealer.edit', $dealer->id) }}" id="profileView" data-toggle="tooltip" data-placement="top" data-tooltip="Edit Dealer"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete-dealer btn button-danger tooltip-top btn-xs" data-id="{{ $dealer->id }}" data-url="{{route('dealer.destroy',$dealer->id)}}" data-toggle="tooltip" data-placement="top" data-tooltip="Delete Dealer"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_dealer_record_found' : 'no_dealer_record')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_dealer_record_found' : 'no_dealer_record')</h4>
            </div>
        </td>
    </tr>
@endif