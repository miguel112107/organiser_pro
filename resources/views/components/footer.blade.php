<footer class="container bg-white pt-5 pb-3">
  <div class="row mt-lg-5 mt-3">
    <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto pb-3">
      <div class="footer-menu d-flex flex-row justify-content-center gap-5">
        @if(Auth::user()->role != 'admin')
        <a href="/events" class="d-inline-block text-dark text-capitalize fs-6 fw-bold">Home</a>
        @if(Auth::user()->role== 'owner')
        <a href="/customer-client/manage" class="d-inline-block text-dark text-capitalize fs-6 fw-bold">Your Account</a>
        <a href="/support" class="d-inline-block text-dark text-capitalize fs-6 fw-bold">Support</a>
        @endif
        @if(Auth::user()->role== 'user')
        @endif
        @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button type="Submit" href="{{ url('/logout') }}" class="button-link d-inline-block text-dark text-capitalize fs-6 fw-bold">Sign out</button>
        </form>
      </div>
    </div>
    <div class="col-12 col-lg-8 m-lg-auto">
      <p>&copy; Event Organizer Pro LLC. All rights reserved.</p>
    </div>
  </div>
</footer>