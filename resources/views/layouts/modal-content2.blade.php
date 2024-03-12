@isset($form_id)
    <form id= "{{$form_id}}"
          @if(isset($slug))
              data="{{$slug}}"
          @endif

          @if(isset($uri))
              uri="{{$uri}}"
            @endif

    >
        @csrf
        @endisset

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                @yield('modal-header')
            </h4>
        </div>
        @php($style = '')
        @isset($decolor)
            @php($style = '#ecf0f5')
        @endisset
        <div class="modal-body"  style="background-color: {{$style}}">
            @yield('modal-body')
        </div>


        <div class="modal-footer">
            @yield('modal-footer')
        </div>


        @isset($form_id)
    </form>
@endisset

@yield('scripts')