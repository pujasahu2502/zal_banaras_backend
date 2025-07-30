@if (isset($variationData))
    @forelse ($variationData as $key => $variation)
    <tr>
        <td class="text-center">{{ paginatePage($variationData,$key)}}</td>
        <td>
            @if(strlen($variation->name) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($variation->name) ?? '-'}}">{{ Str::limit(ucwords($variation->name), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($variation->name) ?? '-'}}</span>
            @endif
        </td>
        <td class="">{{ ucwords($variation->attribute->name)}}</td>
        <td class="variation-date text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($variation->created_at) ?? '' }}</td>
        <td class="status-render text-center">
            @include('backend.variation.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-variation-modal btn button-success tooltip-top btn-xs" data-url="{{ route('variant.edit', $variation['id']) }}" id="profileView" data-toggle="tooltip" data-placement="top" data-tooltip="Edit Variant"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete btn button-danger tooltip-top btn-xs" data-id="{{ $variation['id'] }}" data-url="{{route('variant.destroy',$variation['id'])}}" data-toggle="tooltip" data-placement="top" data-tooltip="Delete Variant"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang('no_variation')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang('no_variation')</h4>
            </div>
        </td>
    </tr>
@endif