@if( count($allProducts))
    <div class="select-pagination mb-4">
        <label for="select2-multiple-input-sm" class="control-label text-uppercase">Show: </label>
        <select class="field-select sortByPaginate" name="sortByPaginate">
            {{-- <option data-display="Choose an option" selected disabled>Choose an option</option> --}}
            <option value="12" {{ request()->input('paginate') == "12" ? 'selected' : ''}}>12 per page</option>
            <option value="24" {{ request()->input('paginate') == "24" ? 'selected' : ''}}>24 per page</option>
            <option value="50" {{ request()->input('paginate') == "50" ? 'selected' : ''}}>50 per page</option>
        </select>
    </div>

@endif