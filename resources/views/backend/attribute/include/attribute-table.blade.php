@if (isset($attributeData))
    @forelse ($attributeData as $key => $attribute)
    <tr>
        <td class="text-center">{{ paginatePage($attributeData,$key) }}</td>
        <td>
            @if(strlen($attribute->name) > 20)
                <span data-toggle="tooltip" title="{{ucwords($attribute->name) ?? '-'}}">{{ Str::limit(ucwords($attribute->name), 20) ?? '-'}}</span>
            @else
                <span>{{ ucwords($attribute->name) ?? '-'}}</span>
            @endif
        </td>
        <td class="attribute-date text-center">
            <i class="fa fa-calendar"></i> {{ dbCustomDateFormat($attribute->created_at) ?? '' }}
        </td>
        <td class="status-render text-center">
            @include('backend.attribute.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-attribute-modal btn button-success tooltip-top btn-xs" data-url="{{ route('attribute.edit', $attribute['id']) }}" id="profileView" data-toggle="tooltip" data-placement="top" data-tooltip="Edit Attribute"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete btn button-danger tooltip-top btn-xs" data-id="{{ $attribute['id'] }}" data-url="{{route('attribute.destroy',$attribute['id'])}}" data-toggle="tooltip" data-placement="top" data-tooltip="Delete Attribute"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>

            <a href="{{ route('variant.index',$attribute->id) }}" class="btn button-success tooltip-top btn-xs" data-toggle="tooltip" data-placement="top" data-tooltip="View Variant"> <i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_attribute_found' : 'no_attribute')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_attribute_found' : 'no_attribute')</h4>
            </div>
        </td>
    </tr>
@endif