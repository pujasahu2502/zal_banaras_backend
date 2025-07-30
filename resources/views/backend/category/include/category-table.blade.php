@if (isset($categoryData))
    @forelse ($categoryData as $key => $category)
    <tr>
        <td class="text-center">{{ paginatePage($categoryData,$key)}}</td>
        <td class="text-center">
            @if ($category->getMedia('category')->count())
                @foreach ($category->getMedia('category') as $media)
                    <img src="{{ $media->hasGeneratedConversion('thumb') ? $media->geturl('thumb') : $media->geturl()  }}" height="60" width="60">
                @endforeach
            @else
                <img src="{{ asset('backend/no-img.png') }}" height="60" width="60">
            @endif
        </td>
        <td>
            @if(strlen($category->name) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($category->name) ?? '-'}}">{{ Str::limit(ucwords($category->name), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($category->name) ?? '-'}}</span>
            @endif
        </td>
        <td>
            @php $type = ""; @endphp
            @if($category->type == '1')
                @php $type = "Scope Mounts and Rings"; @endphp
            @elseif($category->type == '2')
                @php $type = "Gun Accessories"; @endphp
            @elseif($category->type == '3')
                @php $type = "DNZ Hats & Apparel"; @endphp
            @elseif($category->type == '4')
                @php $type = "Other Useful Products"; @endphp
            @endif
            {{ $type ?? '-' }}
        </td>
        <td class="category-date text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($category->created_at) ?? '' }}</td>
        <td class="status-render text-center">
            @include('backend.category.include.status')
        </td>
        <td class="action-wrap text-center">
            <a class="edit-category-modal btn button-success tooltip-left btn-xs" data-url="{{ route('category.edit', $category['id']) }}" id="profileView" data-toggle="tooltip" data-placement="left" data-tooltip="Edit Category"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="delete btn button-danger tooltip-left btn-xs" data-id="{{ $category['id'] }}" data-url="{{route('category.destroy',$category['id'])}}" data-toggle="tooltip" data-placement="left" data-tooltip="Delete Category"> <i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_category_found' : 'no_category')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_category_found' : 'no_category')</h4>
            </div>
        </td>
    </tr>
@endif