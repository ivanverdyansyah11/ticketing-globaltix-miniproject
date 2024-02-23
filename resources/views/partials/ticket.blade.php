<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Modal Add New Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ticket.store') }}" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_site_facilities_id" class="form-label">Tourist Site Facility</label>
                        <select name="tourist_site_facilities_id" class="form-control @error('tourist_site_facilities_id') is-invalid @enderror" id="tourist_site_facilities_id">
                            <option value="-">Choose tourist site</option>
                            @foreach ($tourist_site_facilities as $tourist_site_facility)
                                <option value="{{ $tourist_site_facility->touristsite->id }}">{{ $tourist_site_facility->touristsite->name }}</option>
                            @endforeach
                        </select>
                        @error('tourist_site_facilities_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ticket_categories_id" class="form-label">Ticket Category</label>
                        <select name="ticket_categories_id" class="form-control @error('ticket_categories_id') is-invalid @enderror" id="ticket_categories_id">
                            <option value="-">Choose ticket category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('ticket_categories_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input required name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label for="stock_per_day" class="form-label">Stock per Day</label>
                        <input required name="stock_per_day" type="number" class="form-control @error('stock_per_day') is-invalid @enderror" id="stock_per_day">
                        @error('stock_per_day')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Add</button>
                    <button type="submit" class="btn btn-primary">Add New Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailModalLabel">Modal Detail Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="d-inline-block w-100">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_site_facilities_id" class="form-label">Tourist Site Facility</label>
                        <input readonly name="tourist_site_facilities_id" type="text" class="form-control" id="tourist_site_facilities_id" data-value="tourist_site_facilities_id">
                    </div>
                    <div class="mb-3">
                        <label for="ticket_categories_id" class="form-label">Ticket Category</label>
                        <input readonly name="ticket_categories_id" type="text" class="form-control" id="ticket_categories_id" data-value="ticket_categories_id">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input readonly name="price" type="text" class="form-control" id="price" data-value="price">
                    </div>
                    <div class="mb-0">
                        <label for="stock_per_day" class="form-label">Stock per Day</label>
                        <input readonly name="stock_per_day" type="text" class="form-control" id="stock_per_day" data-value="stock_per_day">
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
                <h1 class="modal-title fs-5" id="editModalLabel">Modal Edit Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonEditTicket" method="POST" class="d-inline-block w-100">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tourist_site_facilities_id" class="form-label">Tourist Site Facility</label>
                        <select required name="tourist_site_facilities_id" class="form-control @error('tourist_site_facilities_id') is-invalid @enderror" id="tourist_site_facilities_id" data-element="row-edit-select">
                        </select>
                        @error('tourist_site_facilities_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ticket_categories_id" class="form-label">Ticket Category</label>
                        <select required name="ticket_categories_id" class="form-control @error('ticket_categories_id') is-invalid @enderror" id="ticket_categories_id" data-element="row-edit-select-category">
                        </select>
                        @error('ticket_categories_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input required name="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price" data-value="price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-0">
                        <label for="stock_per_day" class="form-label">Stock per Day</label>
                        <input required name="stock_per_day" type="number" class="form-control @error('stock_per_day') is-invalid @enderror" id="stock_per_day" data-value="stock_per_day">
                        @error('stock_per_day')
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
                <h1 class="modal-title fs-5" id="deleteModalLabel">Modal Delete Ticket</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonDeleteTicket" method="POST" class="d-inline-block w-100">
                @csrf
                @method("DELETE")
                <div class="modal-body">
                    <p>Are your sure want to delete this ticket?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Delete</button>
                    <button type="submit" class="btn btn-primary">Delete Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>