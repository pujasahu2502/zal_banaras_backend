@if (isset($userData))
    @forelse ($userData as $key => $user)
    <tr>
        <td class="text-center">{{ paginatePage($userData,$key)}}</td>
        <td>
            @if(strlen($user->full_name) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($user->full_name) ?? '-'}}">{{ Str::limit(ucwords($user->full_name), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($user->full_name) ?? '-'}}</span>
            @endif
        </td>
        {{-- <td>
            @if(strlen($user->display_name) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($user->display_name) ?? '-'}}">{{ Str::limit(ucwords($user->display_name), 30) ?? '-'}}</span>
            @else
                <span>{{ ucwords($user->display_name) ?? '-'}}</span>
            @endif
        </td> --}}
        <td>
            @if(strlen($user->email) > 30)
                <span class="tooltip-top-large-contain" data-tooltip="{{$user->email ?? '-'}}">{{ Str::limit($user->email, 30) ?? '-'}}</span>
            @else
                <span>{{ $user->email ?? '-'}}</span>
            @endif
        </td>
        
        <td class="text-center">{{ $user->mobile ?? '-' }}</td>
        <td class="text-center">
            <span class="tooltip-top badge bg-{{ $user['type'] == 'customer' ? 'success' : 'danger' }}" style="cursor: not-allowed;">{{ $user['type'] == 'customer' ? 'Customer' : 'Guest' }}</span>
        </td>
        <td class="text-center"><i class="fa fa-calendar"></i> {{ dbCustomDateFormat($user->created_at) ?? '' }}</td>
        <td class="text-center">{{ $user->last_login_at != null ? dbCustomDateFormat($user->last_login_at) : '-' }}</td>
        <td class="status-render text-center">
            @include('backend.user.include.status')
        </td>
        <td class="text-center">
            <a class="edit-user-modal edit-address-modal-{{$user->id}} btn button-success tooltip-top btn-xs" data-url="{{ route('customer.edit', $user['id']) }}" id="profileView" data-toggle="tooltip" data-placement="top" data-tooltip="Edit Customer"> <i class="c-sidebar-nav-icon fe-icon" data-feather="edit"></i></a>

            <a class="view-user-profile btn tooltip-left button-view btn-xs" data-url="{{ route('customer.show', $user['id']) }}" id="userProfile" data-tooltip="Customer Details"><i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>

            <a href="{{ url('proxy_login/' . $user['id'] ) }}" id="proxy-{{$user->id}}" class="btn tooltip-left button-view btn-xs" target="_blank" data-tooltip="Proxy Login to {{ ucwords($user->first_name) ?? '' }}'s Account"><i class="c-sidebar-nav-icon fe-icon" data-feather="user"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title"> @lang($flag == 1 ? 'no_customer_found' : 'no_customer') </h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title"> @lang($flag == 1 ? 'no_customer_found' : 'no_customer') </h4>
            </div>
        </td>
    </tr>
@endif