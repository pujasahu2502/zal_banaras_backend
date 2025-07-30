@if (isset($pages))
    @forelse ($pages as $key => $page)
        <tr>
            <td class="text-center">{{ paginatePage($pages,$key)}}</td>
            <td>
                @if(strlen($page->title) > 20)
                    <span data-toggle="tooltip" title="{{ucwords($page->title) ?? '-'}}">{{ Str::limit(ucwords($page->title), 20) ?? '-'}}</span>
                @else
                    <span>{{ ucwords($page->title) ?? '-'}}</span>
                @endif
            </td>
            <td>
                @if(strlen($page->slug) > 20)
                    <span data-toggle="tooltip" title="{{ $page->slug ?? '-' }}">{{ Str::limit($page->slug, 20) ?? '-'}}</span>
                @else
                    <span>{{ $page->slug ?? '-'}}</span>
                @endif
            </td>
            <td class="status-render text-center">
                @include('backend.pages.include.status')
            </td>
            <td class="action-wrap text-center">
                <a class="edit-pages-modal btn button-success tooltip-top btn-xs" data-url="{{ route('page.edit', $page->id)}}" data-toggle="tooltip" data-placement="top" data-tooltip="Edit Page"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>
                {{--<a href="@if($page->slug == 'terms-and-conditions') {{route('terms-and-conditions')}} @elseif($page->slug == 'privacy-policy') {{route('privacy-policy')}} @elseif($page->slug == 'sweepstakes-rules') {{route('sweepstakes-rules')}} @else {{route('about-us')}} @endif" class="delete btn button-danger tooltip-top btn-xs" data-tooltip="View {{$page->title}}"> <i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>--}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="15">
                <div class="text-center mb-3">
                    <i data-feather="alert-circle"></i>
                    <h4 class="title">@lang($flag == 1 ? 'no_pages_found' : 'no_pages') </h4>
                </div>
            </td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_pages_found' : 'no_pages') </h4>
            </div>
        </td>
    </tr>
@endif