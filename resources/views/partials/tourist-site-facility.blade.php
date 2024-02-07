<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Modal Add New Tourist Site Facility</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('toursitefacility.store') }}" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_sites_id" class="form-label">Tourist Site</label>
                        <select name="tourist_sites_id" class="form-control @error('tourist_sites_id') is-invalid @enderror" id="tourist_sites_id">
                            <option value="-">Choose tourist site</option>
                            @foreach ($tourist_sites as $tourist_site)
                                <option value="{{ $tourist_site->id }}">{{ $tourist_site->name }}</option>
                            @endforeach
                        </select>
                        @error('tourist_sites_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label for="facilities_id" class="form-label">Facility</label>
                        <div class="row row-cols-2">
                            @foreach ($facilities as $facility)
                              <div class="col mb-1">
                                <input type="checkbox" name="facilities_id[]" id="{{ $facility->name }}" value="{{ $facility->id }}">
                                <label for="{{ $facility->name }}">{{ $facility->name }}</label>
                              </div>
                            @endforeach
                        </div>
                        @error('facilities_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Add</button>
                    <button type="submit" class="btn btn-primary">Add New Tourist Site Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Modal Detail Tourist Site Facility</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="d-inline-block w-100">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_sites_id" class="form-label">Tourist Site</label>
                        <input readonly name="tourist_sites_id" type="text" class="form-control" id="tourist_sites_id" data-value="tourist_sites_id">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Facility</label>
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
                <h1 class="modal-title fs-5" id="editModalLabel">Modal Edit Tourist Site Facility</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonEditTouristSiteFacility" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_sites_id" class="form-label">Tourist Site</label>
                        <select required name="tourist_sites_id" class="form-control @error('tourist_sites_id') is-invalid @enderror" id="tourist_sites_id" data-element="row-edit-select">
                        </select>
                        @error('tourist_sites_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Facility</label>
                        <div class="row row-cols-2" data-element="row-edit-checkbox">
                        </div>
                        @error('facilities_id')
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
                <h1 class="modal-title fs-5" id="deleteModalLabel">Modal Delete Tourist Site Facility</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonDeleteTouristSiteFacility" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <p>Are your sure want to delete this tourist site facility?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Delete</button>
                    <button type="submit" class="btn btn-primary">Delete Tourist Site Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>