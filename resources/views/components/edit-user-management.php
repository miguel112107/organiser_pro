<fieldset class="fieldset">
    <form method="POST" action="{{ route('user.update',$user->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <i class="fa-solid fa-user-circle"></i>
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Staff Name
            </label>
            <input type="text" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="name" value="{{ old('name', $user->name ?? '') }}" id="exampleFormControlInput1" />
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Company Email
            </label>
            <input type="email" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="email" value="{{ old('email', $primaryUser->email ?? '') }}" id="exampleFormControlInput1" />
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                Cell Phone
            </label>
            <input type="tel" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="cell" value="{{ old('cell', $primaryUser->cell ?? '') }}" id="exampleFormControlInput1" />
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