<fieldset>
    <form method="POST" action="{{ route('user.store') }}">
        @csrf
        <div class="mb-3">
            <i class="fa-solid fa-user-circle"></i>
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Staff Name
            </label>
            <input type="text" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" id="exampleFormControlInput1" name="name" placeholder="Staff member's name" />
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Company Email
            </label>
            <input type="email" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="email" id="exampleFormControlInput1" placeholder="email@example.com" />
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Cell Phone
            </label>
            <input type="tel" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="cell" id="exampleFormControlInput1" placeholder="Include area code" />
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">
                Save changes
            </button>

            <!-- or use this button if no field was edited yet 
					<button type="submit" class="btn btn-primary disabled">
					No unsaved changes
					</button>
					-->
        </div>
        <p class="UX_note pt-2">
            Check this box then delete this staff admin
        </p>
    </form>
</fieldset>