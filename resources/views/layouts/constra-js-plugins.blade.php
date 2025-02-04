<!-- Javascript Files
 ================================================== -->

<!-- initialize jQuery Library -->
<script src="{{asset('constra/plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap jQuery -->
<script src="{{asset('constra/plugins/bootstrap/bootstrap.min.js')}}" defer></script>
<!-- Slick Carousel -->
<script src="{{asset('constra/plugins/slick/slick.min.js')}}"></script>
<script src="{{asset('constra/plugins/slick/slick-animation.min.js')}}"></script>
<!-- Color box -->
<script src="{{asset('constra/plugins/colorbox/jquery.colorbox.js')}}"></script>
<!-- shuffle -->
<script src="{{asset('constra/plugins/shuffle/shuffle.min.js')}}" defer></script>




<!-- Google Map API Key-->
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>--}}
<!-- Google Map Plugin-->
<script src="{{asset('constra/plugins/google-map/map.js')}}" defer></script>

<!-- Template custom -->
<script src="{{asset('constra/js/script.js')}}"></script>

{{-- SWAL 2 --}}
<script type="text/javascript" src="{{asset('constra/js/sweetalert2.all.min.js')}}"></script>

<script type="text/javascript">
    function validationError(form,response){
        $.each(response.responseJSON.errors,function (key,value){
            let input =  form.find("input[name='"+key+"'], textarea[name='"+key+"']");
            input.addClass('is-invalid');
            input.parent('div.form-group').append('<div class="invalid-feedback">'+value[0]+'</div>');
        });
    }
    function unmarkValidationErrors(form){
        form.find("input, textarea").each(function (){
            $(this).removeClass('is-invalid');
            $(this).parent('div.form-group').find('.invalid-feedback').each(function (){
                $(this).remove();
            })
        })
    }
</script>

<script src="{{asset('constra/plugins/swiper/swiper-bubdle.min.js')}}" ></script>