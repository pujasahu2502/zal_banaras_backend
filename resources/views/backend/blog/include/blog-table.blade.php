@if (isset($blogData))
    @forelse ($blogData as $key => $blog)
    <tr>
        <td class="text-center">{{ paginatePage($blogData,$key)}}</td>
        <td class="text-center">
            @if ($blog->getMedia('blog')->count())
                @foreach ($blog->getMedia('blog') as $media)
                    <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" height="60" width="60">
                @endforeach
            @else
                <img src="{{ asset('backend/no-img.png') }}" height="60" width="60">
            @endif
        </td>
        <td>
            @if(strlen($blog->title) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($blog->title) ?? '-'}}">{{ Str::limit(ucwords($blog->title), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($blog->title) ?? '-'}}</span>
            @endif
        </td>
        <td class="status-render text-center">
            @include('backend.blog.include.status')
        </td>
        <td class="text-center"><i class="fa fa-calendar pt-1"></i> {{ dbCustomDateFormat($blog->created_at) ?? '' }}</td>
        <td class="action-wrap text-center">
            <a class="edit-blog-modal btn button-success tooltip-top btn-xs" data-url="{{ route('blogs.edit', $blog['id']) }}" id="profileView" data-tooltip="Edit Blog"><i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class=" btn button-danger btn-xs tooltip-top delete" data-url="{{route('blogs.destroy',$blog['id'])}}" data-id="{{ $blog['id'] }}" data-tooltip="Delete Blog"><i class="fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_blog_found' : 'no_blog') </h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_blog_found' : 'no_blog') </h4>
            </div>
        </td>
    </tr>
@endif