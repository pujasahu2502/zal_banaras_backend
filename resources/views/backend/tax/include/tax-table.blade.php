@if (isset($taxes))
@php $i = 0; @endphp
@forelse ($taxes as $key => $tax)
<tr>
            {{-- {{dd($key)}} --}}
            <td class="text-center">{{ paginatePage($taxes,$i)}}</td>
            @php $i++ @endphp
            <td>
                @if(strlen($key) > 30)
                    <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($key) ?? '-'}}">{{ Str::limit(ucwords($key), 30) ?? '-'}}</span>
                @else
                    <span>{{ ucwords($key) ?? '-'}}</span>
                @endif
            </td>
            <td>{{ implode(',',collect($tax)->pluck('state')->toArray())}}</td>
            <td class="text-center">{{ collect($tax)->first()->tax.'%' ?? '-'}}</td>
            <td class="status-render text-center">
                @include('backend.tax.include.status')
            </td>
            <td class="action-wrap text-center">
                <a class="edit-tax-modal btn button-success tooltip-top btn-xs" id="faqEdit" data-url="{{route('tax.edit', Str::slug(collect($tax)->first()->name))}}" data-tooltip="Edit Tax"><i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

                <a class="delete-tax btn button-success tooltip-top btn-xs" data-url="{{route('tax.destroy',Str::slug(collect($tax)->first()->name))}}" data-tooltip="Delete Tax"><i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="15">
                <div class="text-center mb-3">
                    <i data-feather="alert-circle"></i>
                    <h4 class="title">@lang($flag == 1 ? 'no_taxes_found' : 'no_taxes') </h4>
                </div>
            </td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_taxes_found' : 'no_taxes') </h4>
            </div>
        </td>
    </tr>
@endif