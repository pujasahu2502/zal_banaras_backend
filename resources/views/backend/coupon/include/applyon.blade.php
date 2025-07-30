@if(isset($data) && $data != [])
<div class="form-group coupon-input">
    <label>Select {{ $applied ?? '' }}<span class="text-danger">*</span></label>
    <select class="form-control form-select apply_on_value" name="apply_on_value[]" data-rule-required="true" data-msg-required="The {{ lcfirst($applied) ?? '' }} field is required." data-url="{{ route('coupon.applyon') }}" multiple="multiple">
        @forelse($data as $key => $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @empty

        @endforelse
    </select>
    <span class="text-danger error apply_on_value-error"></span>
</div>
@endif