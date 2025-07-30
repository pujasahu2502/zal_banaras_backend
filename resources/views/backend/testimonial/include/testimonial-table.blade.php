@if (isset($testimonialData))
    @forelse ($testimonialData as $key => $testimonial)
    <tr>
        <td class="text-center">{{ paginatePage($testimonialData,$key)}}</td>
        <td>
            @if(strlen($testimonial->name) > 20)
                <span data-toggle="tooltip" title="{{ucwords($testimonial->name) ?? '-'}}">{{ Str::limit(ucwords($testimonial->name), 20) ?? '-'}}</span>
            @else
                <span>{{ ucwords($testimonial->name) ?? '-'}}</span>
            @endif
        </td>
        <td>
            @if(strlen($testimonial->description) > 20)
                <span data-toggle="tooltip" title="{{ucwords($testimonial->description) ?? '-'}}">{{ Str::limit(ucwords($testimonial->description), 20) ?? '-'}}</span>
            @else
                <span>{{ ucwords($testimonial->description) ?? '-'}}</span>
            @endif
        </td>
        <td class="testimonial-date text-center">
            <i class="fa fa-calendar"></i> {{ dbCustomDateFormat($testimonial->created_at) ?? '' }}
        </td>
        <td class="status-render text-center">
            @include('backend.testimonial.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-testimonial-modal btn button-success tooltip-left btn-xs" data-url="{{ route('testimonial.edit', $testimonial['id']) }}" id="profileView" data-toggle="tooltip" data-placement="left" data-tooltip="Edit Testimonial"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete btn button-danger tooltip-left btn-xs" data-id="{{ $testimonial['id'] }}" data-url="{{route('testimonial.destroy',$testimonial['id'])}}" data-toggle="tooltip" data-placement="left" data-tooltip="Delete Testimonial"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_testimonial_found' : 'no_testimonial')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_testimonial_found' : 'no_testimonial')</h4>
            </div>
        </td>
    </tr>
@endif