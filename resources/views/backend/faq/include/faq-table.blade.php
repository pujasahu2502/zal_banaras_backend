@forelse ($faqs as $key => $faq)
    <tr>
        <td class="text-center">{{ paginatePage($faqs,$key) }}</td>
        <td>{{ $faq->faq_category ?? '-' }}</td>
        <td>
            @if(strlen($faq->question) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($faq->question) ?? '-'}}">{{ Str::limit(ucwords($faq->question), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($faq->question) ?? '-'}}</span>
            @endif
        </td>
        <td>
            @if(strlen($faq->answer) > 40)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($faq->answer) ?? '-'}}">{{ $faq->answer ? Str::limit(ucwords($faq->answer), 40) : 'Video'}}</span>
            @else
                <span>{{ $faq->answer ? ucwords($faq->answer) : 'Video'}}</span>
            @endif
        </td>
        <td class="status-render text-center">
            @include('backend.faq.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-faq-modal btn button-success tooltip-top btn-xs" data-url="{{ route('faq.edit', $faq['id']) }}" id="faqEdit" data-tooltip="Edit FAQ"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete btn button-danger tooltip-top btn-xs" data-id="{{ $faq['id'] }}" data-url="{{route('faq.destroy',$faq['id'])}}" data-tooltip="Delete FAQ"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>    
@empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_faq_found' : 'no_faq') </h4>
            </div>
        </td>
    </tr>
@endforelse