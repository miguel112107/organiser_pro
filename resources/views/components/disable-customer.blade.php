<form method="POST" action="/venue/{{$venue->id}}/delete">
    {{ csrf_field() }}
    @method('PUT')
    <section class="container">
        <div class="row mt-8 mb-4 py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">

                <!-- Disable Customer Account  -->
                <div class="py-1 gap-3">
                    <h4>
                        Disable Customer Account
                    </h4>
                    <p class=" my-2 fs-6">
                        This is a "soft-delete" action. The Customer will lose login access immediately, but no data is deleted. All content is preserved for our analytics and even future reactivation (lapsed payment).
                    </p>
                    <form action="" name="Disable Customer access">
                        <button type="submit" class="btn btn-danger m-2 shadow-sm fs-6" id="disable_customer">
                            <i class="fa-solid fa-ban me-2"></i>
                            Disable Customer
                        </button>
                        <div class="form-check my-2">
                            <input class="form-check-input border-dark" type="checkbox" id="disable_customer" value="1" name="verify" />

                            <label class="form-check-label fw-bold fs-6" for="disable_customer">
                                Check this box then press "Disable" to remove the Customer's access.
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div>
    </section>
</form>