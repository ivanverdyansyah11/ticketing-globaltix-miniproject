<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Modal Add New Region Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('regioncategory.store') }}" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regions_id" class="form-label">Region</label>
                        <select required name="regions_id" class="form-control @error('regions_id') is-invalid @enderror" id="regions_id">
                            <option value="-">Choose region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                        @error('regions_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Category</label>
                        <div class="row row-cols-2">
                          @foreach ($categories as $category)
                            <div class="col mb-1">
                              <input type="checkbox" name="categories_id[]" id="{{ $category->name }}" value="{{ $category->id }}">
                              <label for="{{ $category->name }}">{{ $category->name }}</label>
                            </div>
                          @endforeach
                        </div>
                        @error('categories_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Add</button>
                    <button type="submit" class="btn btn-primary">Add New Region Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Modal Detail Region Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="d-inline-block w-100">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regions_id" class="form-label">Region</label>
                        <input readonly name="regions_id" type="text" class="form-control" id="regions_id" data-value="regions_id">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Category</label>
                        <div class="row row-cols-2" data-element="row-detail-checkbox">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close Modal Detail</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Modal Edit Region Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonEditRegionCategory" method="POST" class="d-inline-block w-100">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="regions_id" class="form-label">Region</label>
                        <select required name="regions_id" class="form-control @error('regions_id') is-invalid @enderror" id="regions_id" data-element="row-edit-select">
                        </select>
                        @error('regions_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Category</label>
                        <div class="row row-cols-2" data-element="row-edit-checkbox">
                        </div>
                        @error('categories_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Edit</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Modal Delete Region Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonDeleteRegionCategory" method="POST" class="d-inline-block w-100">
                @csrf
                @method("DELETE")
                <div class="modal-body">
                    <p>Are your sure want to delete this region category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Delete</button>
                    <button type="submit" class="btn btn-primary">Delete Region Category</button>
                </div>
            </form>
        </div>
    </div>
</div>