@yield('form-open')
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">
      @yield('title')
    </h4>
  </div>
  <div class="modal-body">
    @yield('body')
  </div>
  <div class="modal-footer">
    @yield('footer')
  </div>
</div>

@yield('form-close')

@yield('script')