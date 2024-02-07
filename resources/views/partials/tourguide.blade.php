<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Modal Delete Tour Guide</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="buttonDeleteTourGuide" method="POST" class="d-inline-block w-100">
                @csrf
                <div class="modal-body">
                    <p>Are your sure want to delete this tour guide?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel Delete</button>
                    <button type="submit" class="btn btn-primary">Delete Tour Guide</button>
                </div>
            </form>
        </div>
    </div>
</div>