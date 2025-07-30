@if (isset($listingData))
@forelse ($listingData as $key => $listing)

<tr>
  <td class="text-center">{{ paginatePage($listingData,$key)}}</td>
    <td><a class="edit-listing-modal"  data-url="{{route('listing.edit',$listing->id)}}" role="tooltip"><span class="tooltip-top" data-tooltip="Click to edit">{{Str::limit(ucwords($listing->name ?? ''),40)}}</span></a></td>
    <td>{{ ucwords(($listing->category->name) ?? '')}}</td>
    <td  class="text-center">{{Str::limit(ucwords($listing->price ?? ''),40)}}</td>
    <td class="text-center  text-dark"><span class="badge btn-type badge-{{ $listing['listening_status'] == '1' ? 'success' : 'secondary'  }}" aria-hidden="true" style="cursor: not-allowed;"><span>{{$listing['listening_status'] == '1' ? 'Sold' : 'Available' }}</span></span></td>
    <td class="text-center status-render">
        @include('backend.listing.include.status')
    </td>
    <td class="action-wrap text-center">
      
        <a class="edit-listing-modal btn button-success btn-xs tooltip-left" data-url="{{route('listing.edit',$listing->id)}}"  id="profileEdit" title="" data-tooltip="Edit Raffle"><i class="fe-icon" data-feather="edit"></i></a>
      
      <a class=" btn button-danger btn-xs tooltip-left delete-listing" data-url="{{route('listing.destroy',$listing->id)}}" data-id="{{ $listing['id'] }}" data-tooltip="Delete Listing"><i class="fe-icon" data-feather="trash"></i></a>
  
      <a class=" btn button-danger btn-xs tooltip-left" href="{{ route('home.listing.details', $listing->slug) }}" data-toggle="tooltip" aria-hidden="true" data-tooltip="View Details"><i class="fe-icon" data-feather="eye"></i></a>
    </td>
  </tr>
@empty
<tr>
    <td colspan="15">
     <div class="text-center mb-3">
      <i data-feather="alert-circle"></i>
      <h4 class="title">@lang('no_listing') </h4>
     </div>
    </td>
 </tr>
@endforelse
@endif