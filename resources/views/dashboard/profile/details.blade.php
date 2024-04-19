@extends('layouts.admin-master')
<style type="text/css">
  img {
  max-width: 100%; /* This rule is very important, please do not ignore this! */
}

.image_o {
    position:relative;
    width:200px;
    height:200px;
}

.image_o img {
    width:100%;
    vertical-align:top;
}
.image_o:after, .image_o:before {
    position:absolute;
    opacity:0;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}
.image_o:after {
    content:'\A';
    width:90px; height:90px;
    top:0; left:0;
    background:rgba(0,0,0,0.6);
    border-radius: 50%
}
.image_o:before {
    content: attr(data-content);
    width:88px;
    color:#fff;
    z-index:1;
    margin-top:30px;
    padding:4px 10px;
    text-align:center;
    background:red;
    box-sizing:border-box;
    -moz-box-sizing:border-box;
    border-radius: 10%
}
.image_o:hover{
  cursor: pointer;
}
.image_o:hover:after, .image_o:hover:before {
    opacity:1;
}

.input-group-btn button{
  height: 34px;
}
</style>



@section('content')

<section class="content-header">
    <h1>Profile</h1>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-4">
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua" style="background: url({{asset('images/sra.jpg')}}) center center; background-size: cover;">
          <h3 class="widget-user-username">{{ Auth::check() ? Auth::user()->fullname : '' }}</h3>
          <h5 class="widget-user-desc">{{ Auth::check() ? Auth::user()->position : '' }}</h5>
        </div>
        <div class="widget-user-image image_o" data-content="CHANGE" id="img-circ">

            <img class="img-circle"  src="{!! __html::check_img(Auth::user()->image) !!}" alt="User Avatar">

        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{number_format($total_encoded)}}</h5>
                <span class="description-text">Entries you encoded</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">{{number_format($total_updated) }}</h5>
                <span class="description-text">Entries last updated by you</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li class="bg-teal">
              <a href="#"  class="no-hover">
                <center>Account details</center>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Firstname
                <span class="pull-right text-strong">
                  {{ Auth::user()->firstname }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Middlename
                <span class="pull-right text-strong">
                  {{ Auth::user()->middlename }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user margin-r-5"></i> Lastname
                <span class="pull-right text-strong">
                  {{ Auth::user()->lastname }}
                </span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-male margin-r-5"></i> Position
                <span class="pull-right text-strong">
                  {{ Auth::user()->position }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-key margin-r-5"></i> Username
                <span class="pull-right text-strong" for="username">
                  {{ Auth::user()->username }}
                </span>
              </a>
            </li>


            <li>
              <a href="#">
                <i class="fa fa-envelope margin-r-5"></i> Email
                <span class="pull-right text-strong">
                  {{ Auth::user()->email }}
                </span>
              </a>
            </li>
            <li class="bg-teal">
              <a href="#"  class="no-hover ">
                <center>Account activity</center>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-clock-o "></i> Last Login Time
                <span class="pull-right text-strong">
                  {{ __dataType::date_parse(Auth::user()->last_login_time, 'M d, Y h:i A') }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa  fa-desktop margin-r-5"></i> Last Login Machine
                <span class="pull-right text-strong">
                  {{ Auth::user()->last_login_machine }}
                </span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa  fa-asterisk margin-r-5"></i> Last Login Local IP
                <span class="pull-right text-strong">
                  {{ Auth::user()->last_login_ip }}
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>



    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">
            <a id="a_s" href="#settings" data-toggle="tab" aria-expanded="false">
             <i class="fa fa-gears"></i> Account Settings
           </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="settings">
            <div class="row">

              {{-- USERNAME SETTINGS --}}
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Username
                  </div>
                  <div class="panel-body">
                    <form id="username_form" autocomplete="off" action="">

                      @csrf

                      <input name="_method" value="PATCH" type="hidden">

                      <div class="row">
                        {!! __form::textbox(
                          '12 username', 'username', 'text', 'Username *', 'Username', Auth::user()->username , 'username', '', ''
                        ) !!}

                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right">
                          <i class="fa fa-save "></i> Save
                        </button>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

              {{-- PASSWORD SETTINGS --}}

              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Password
                  </div>
                  <div class="panel-body">
                    <form id="password_form" autocomplete="off" action="">
                      <div class="row">
                        {!! __form::textbox_password_btn(
                        '4 old_password', 'old_password', 'Old Password *', 'Old Password', '', 'password', '', ''
                        ) !!}

                        {!! __form::textbox_password_btn(
                            '4 password', 'password', 'Password *', 'Password', '', 'password', '', ''
                        ) !!}

                        {!! __form::textbox_password_btn(
                            '4 password_confirmation', 'password_confirmation', 'Confirm Password *', 'Confirm Password', '', 'password_confirmation', '', ''
                        ) !!}
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn {!! __static::bg_color(Auth::user()->color) !!} pull-right">
                          <i class="fa fa-save"></i> Save
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                Color Scheme
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="scrolling-wrapper">
                      @php
                        $themes = __static::user_colors();
                        ksort($themes);
                      @endphp
                      @foreach($themes as $key => $color)
                        @if(Auth::user()->color == $color)
                          @php
                            $bg = 'bg-success';
                            $check = '<i class="fa fa-check"></i>';
                          @endphp
                        @else
                          @php
                            $bg = 'bg-none';
                            $check = '';
                          @endphp
                        @endif
                        <div class="scrolling-card" data="{{$color}}">
                          <ul class="mailbox-attachments">
                            <li class="scrolling-li {{$bg}}" data="{{$color}}">
                               <span class="mailbox-attachment-icon has-img"><img src="{{ asset('images/skins') }}/{{$color}}.jpg"></span>

                              <div class="mailbox-attachment-info">
                                <a href="#" class="mailbox-attachment-name">{{$key}}
                                  <span class="pull-right check text-green">
                                  @php echo $check;
                                  @endphp
                                  </span>
                                </a>
                              </div>
                            </li>
                          </ul>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</section>
</div>
@endsection



@section('modals')
<div id="change_pp" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Change picture</h4>
          </div>
          <div class="modal-body">
            <p>
    <!-- Below are a series of inputs which allow file selection and interaction with the cropper api -->
        <input type="file" id="fileInput" accept="image/*" hidden="" style="display: none" />


    </p>
    <div style="width: 100%" id="img_container" >
      <img id="image">
    </div>

    <div id="img_loader" style="display: none">
      <center>
        <img style="width: 100px" src="{{ asset('images/loader.gif') }}">
      </center>
    </div>
    <br>



      </div>
      <div class="modal-footer">
        <div class="progress" style="display: none;">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnCrop" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section('scripts')
  <script type="text/javascript">
    function filter_dt(){
      mod = $(".module").val();
      event = $(".event").val();
      date_range = $("#date_range").val();
      activity_tbl.ajax.url(
        "{{ route('dashboard.profile.details') }}?mod="+mod+"&event="+event+"&date_range="+date_range).load();

      $(".filters").each(function(index, el) {
        if($(this).val() != ''){
          $(this).parent("div").addClass('has-success');
          $(this).siblings('label').addClass('text-green');
        }else{
          $(this).parent("div").removeClass('has-success');
          $(this).siblings('label').removeClass('text-green');
        }
      });
    }
  </script>
  <script type="text/javascript">

    activity_tbl = $("#activity_logs_table").DataTable({
      'dom' : 'lBfrtip',
      "processing": true,
      "serverSide": true,
      "ajax" : '{{ route("dashboard.profile.details") }}',
      "columns": [
          { "data": "module" },
          { "data": "event" },
          { "data": "remarks" },
          { "data": "created_at" },
          { "data": "created_at_raw" },
      ],
      'order': [[4, 'desc']],
      buttons: [
          {!! __js::dt_buttons() !!}
      ],
      "columnDefs":[
        {
          "targets" : 0,
          "class" : 'th-90'
        },
        {
          "targets" : 1,
          "class" : 'sex-th'
        },
        {
          "targets" : 3,
          "class" : 'time-th'
        },
        {
          "targets": 4,
          "visible" :false
        }
      ],
      "responsive": false,
      "initComplete": function( settings, json ) {
          $('#tbl_loader').fadeOut(function(){
            $("#activity_logs_container").fadeIn();
          });
        },
      "language":
        {
          "processing": "<center><img style='width: 70px' src='{{ asset('images/loader.gif') }}'></center>",
        },
      "drawCallback": function(settings){
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="modal"]').tooltip();

      }
    })

    //Search Bar Styling
    style_datatable('#activity_logs_table');

    //Need to press enter to search
      $('#activity_logs_table_filter input').unbind();
      $('#activity_logs_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
              activity_tbl.search(this.value).draw();
          }
      });

    $("#date_range").daterangepicker({

    });
    $("#date_range").val('');

    $("body").on("click",".clearBtn", function(){
      $("#date_range").val('');
      $("#date_range").change();
      $(this).attr("disabled","disabled");
    })


    $(".filters").change(function(){
      filter_dt();
      if($("#date_range").val()!=""){
        $(".clearBtn").removeAttr('disabled');
      }
    })

    $(".scrolling-card").click(function(event) {
      color = $(this).attr('data');

      $.ajax({
        url: "{{ route('dashboard.profile.update_account_color') }}",
        data: {color:color},
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          $("body").attr("class","");
          $("body").addClass(response);
          $(".scrolling-li").each(function(index, el) {
            $(this).removeClass('bg-success');
            $(this).addClass('bg-none');
            $(this).find('.check').html('');
          });
          to_change = $(".scrolling-li[data='"+response+"']");
          to_change.removeClass('bg-none');
          to_change.addClass('bg-success');
          to_change.find('.check').html('<i class="fa fa-check"></i>');
          notify("Color scheme was changed.","success");
        },
        error: function(response){
          console.log(response);
          notify("Error: "+response, "danger");
        }
      })
    });

    $("#username_form").submit(function(e) {
      e.preventDefault();
      wait_button("#username_form");
      $.ajax({
        url : "{{ route('dashboard.profile.update_account_username') }}",
        data: $(this).serialize(),
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          succeed("#username_form","save",false);
          $("span[for='username']").html(response);
          notify("Username successfully updated.","success");
        },
        error: function(response){
          errored("#username_form","save",response);
        }
      })
    });

    $("#password_form").submit(function(e) {
      e.preventDefault();
      wait_button("#password_form");
      $.ajax({
        url: "{{ route('dashboard.profile.update_account_password') }}",
        data: $(this).serialize(),
        type: "PATCH",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          console.log(response);

          $(".old_password").removeClass('has-error');
          $(".old_password span").remove();


          if(response == -1){
            succeed("#password_form","save", false);
            $(".old_password").addClass('has-error');
            $(".old_password").append('<span class="help-block">Incorrect password.</span>');
          }
          if(response == 1){
            succeed("#password_form","save", true);
            notify("Password updated.","success");
          }
        },
        error: function(response){
          console.log(response);
          errored("#password_form","save",response);
        }
      })
    });

    {!! __js::show_hide_password() !!}


    // var canvas  = $("#canvas"),
    // context = canvas.get(0).getContext("2d"),
    // $result = $('#result');

    // $('#fileInput').on( 'change', function(){

    //     if (this.files && this.files[0]) {
    //       if ( this.files[0].type.match(/^image\//) ) {
    //         var reader = new FileReader();
    //         reader.onload = function(evt) {
    //           $("#change_pp").modal({backdrop: 'static', keyboard: false});
    //           $("#change_pp").modal('show');
    //            var img = new Image();
    //            img.onload = function() {
    //              context.canvas.height = img.height;
    //              context.canvas.width  = img.width;
    //              context.drawImage(img, 0, 0);
    //              image = document.getElementById('canvas');

    //              var cropper = new Cropper(image,{aspectRatio: 1 / 1,});
    //              $('#btnCrop').click(function() {
    //                 // Get a string base 64 data url
    //                 var imgurl =  cropper.getCroppedCanvas().toDataURL();
    //                 console.log(imgurl);
    //                 //var img = document.createElement("img");
    //                 // $result.append( $('<img>').attr('src', imgurl) );
    //              });


    //              $("#change_pp").on('hidden.bs.modal', function () {
    //                 cropper.destroy();
    //                 cropper = null;
    //               });

    //            };

    //            img.src = evt.target.result;
    //         };
    //         reader.readAsDataURL(this.files[0]);
    //       }
    //       else {
    //         alert("Invalid file type! Please select an image file.");
    //       }
    //     }
    //     else {
    //       alert('No file(s) selected.');
    //     }
    // });



    $("#img-circ").click(function() {
      $("#fileInput").click();
    })
  </script>


    <script>

      var avatar = document.getElementById('img-circ');
      var image = document.getElementById('image');
      var canvas = document.getElementById('canvas');
      var input = $('#fileInput');
      var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
      var $alert = $('.alert');
      var $modal = $('#change_pp');
      var cropper;


      $('[data-toggle="tooltip"]').tooltip();

      input.on('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal({backdrop: 'static'});
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });

      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 3,
        });
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      $('#btnCrop').on('click', function () {
        var initialAvatarURL;
        var canvas;

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 84,
            height: 84,
          });

          //initialAvatarURL = avatar.src;

          //avatar.src = canvas.toDataURL();
          //console.log(canvas.toDataURL());
          $progress.fadeIn();

          canvas.toBlob(function (blob) {
            var formData = new FormData();

            formData.append('avatar', blob, 'avatar.jpg');
            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });


            $.ajax({
              url : '{{route('dashboard.profile.update_image')}}',
              method: 'POST',
              data: formData,
              processData: false,
              contentType: false,

              xhr: function () {
                var xhr = new XMLHttpRequest();
                $("#img_loader").slideDown();
                $("#img_container").slideUp();
                $("#change_pp .modal-footer button").fadeOut();
                xhr.upload.onprogress = function (e) {
                  var percent = '0';
                  var percentage = '0%';

                  if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                  }
                };

                return xhr;
              },

              success: function () {
                notify("Profile picture successfully updated. This page will reload. Please wait","success");
                setTimeout(function(){location.reload();},2000);
              },

              error: function (jqXHR, status, errorThrown) {


                switch(jqXHR.status){
                  case(404):
                    notify("You don't have permission to change your profile picture.","warning");
                    break;
                }

                setTimeout(function(){location.reload();},2000);
              },

              complete: function () {

              },
            });

          });
        }
      });

  </script>



@endsection