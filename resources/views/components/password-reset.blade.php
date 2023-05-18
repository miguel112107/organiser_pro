<!-- Customer Password Reset  -->
<section class="container">
    <div class="row mt-8 mb-4 py-4">
        <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">

            <h4>
                Customer Password Reset
            </h4>
            <p class="my-2 fs-6">
                If the customer's admin loses their password, they can initiate a pwd reset from their Portal. If they have trouble or call in, our tech support can also send the pwd reset email.
            </p>

            <form action="/admin/password-reset/{{$venue->url_handle}}" method="Post" name="Reset Customer Password">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-secondary shadow-sm m-2 fs-6">
                    <i class="fa-solid fa-envelope me-2"></i>
                    Reset Password
                </button>
                <span>and email a link </span>

                <div class="form-check my-2">
                    <input class="form-check-input border-dark" type="checkbox" id="disable_customer" name="confirm_reset" value=1 />
                    <label class="form-check-label fw-bold fs-6" for="disable_customer">
                        Check this box then press the "Reset" button
                    </label>
                </div>
            </form>
            <p class="UX_note">
                A link will be sent to the email on file with a reset action.
            </p>

        </div>
        <!-- end row -->
    </div>
</section>