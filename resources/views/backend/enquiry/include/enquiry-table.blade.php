@if (isset($contactUsData))
    @forelse ($contactUsData as $key => $contact)
    <tr>
        <td class="text-center">{{ paginatePage($contactUsData,$key)}}</td>
        <td> 
            @if (strlen($contact->name) > 20)
                <span class="tooltip-top-large-contain" data-tooltip="{{ucwords($contact->name) ?? '-'}}">{{ Str::limit(ucwords($contact->name), 20) ?? '-'}}</span>
            @else
                <span>{{ ucwords($contact->name) ?? '-'}}</span>
            @endif
        </td>
        <td>{{ $contact->email ?? '-' }}</td>
        <td class="text-center">{{ $contact->mobile ?? '-' }}</td>
        <td class="text-center"><i class="fa fa-calendar"></i> {{dbCustomDateFormat($contact->created_at) ?? ''}}</td>
        <td class="action-wrap text-center">
            <a class="view-customer-profile contactUsDetail btn tooltip-left button-view btn-xs" data-url="{{ route('contact-us.show', $contact['id']) }}" id="contactUsDetail" data-tooltip="Enquiry Details"><i class="c-sidebar-nav-icon fe-icon" data-feather="eye"></i></a>
            <a class="delete-enquiry btn tooltip-left button-view btn-xs" data-url="{{ route('contact-us.destroy', $contact['id']) }}" id="contactUsDetail" data-tooltip="Delete Enquiry"><i class="c-sidebar-nav-icon fe-icon" data-feather="trash"></i></a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="15">
            <div class="text-center mb-3">
                <i data-feather="alert-circle"></i>
                <h4 class="title">@lang($flag == 1 ? 'no_enquiry_found' : 'no_enquiry')</h4>
            </div>
        </td>
    </tr>
    @endforelse
@else
<tr>
    <td colspan="15">
        <div class="text-center mb-3">
            <i data-feather="alert-circle"></i>
            <h4 class="title">@lang($flag == 1 ? 'no_enquiry_found' : 'no_enquiry')</h4>
        </div>
    </td>
</tr>
@endif