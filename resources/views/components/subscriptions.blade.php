<section class="container">
    <!-- Modules & Subscription levels  -->
    <div class="row mt-8 mb-4 py-4">
        <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
            <h4>
                Enabled Modules & Subscription levels
            </h4>

            <div class="form-check form-check-inline fw-bold">
                <label class="form-check-label fs-6" for="module-timeline">
                    Timeline Organizer
                </label>
                <input class="form-check-input fs-6 border-secondary-subtle" type="checkbox" id="module-timeline" name="timeline_organizer" value="1" {{$venue != null ? ($venue->timeline_organizer == 1 ? "checked" : '') : ''}}>
            </div>
            <div class="form-check form-check-inline fw-bold">
                <label class="form-check-label fs-6" for="module-menu-builder">
                    Menu Designer
                </label>
                <input class="form-check-input fs-6 border-secondary-subtle" type="checkbox" id="module-menu-builder" name="menu_designer" value="1" {{$venue != null ? ( $venue->menu_designer == 1 ? "checked" : '') : '' }}/>
            </div>

            <p class="my-2 fs-6">
                WIP/Future: Checking a module will cause the feature to appear in the customer’s Portal, or remove the feature. An automated "welcome" email can be sent. We'll need to work on the billing backend.
            </p>
        </div>
        <!-- end row -->
    </div>
</section>