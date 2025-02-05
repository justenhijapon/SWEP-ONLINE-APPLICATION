<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>SRA | Imported Commodities</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.constra-css-plugins')

    {{--    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>--}}
    <!-- Your code -->

</head>
<body>
<style>
    p {
        text-justify: auto;
    }
</style>
<div class="body-inner">

    @include('layouts.guest-header')

    <img loading="lazy" class="image-clean"  style="width: 100%; height: 8%;" src="{{asset('/images/Guest/Banners/CLEARANCE_FOR_IMPORTED_COMMODITIES.png')}}" alt="">

<section id="main-container" class="main-container">
    <div class="container" style="height: 1000px">
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="row">
                    <div class="col-md-12">
                        {{--          action="{{route('contactUs.index')}}"--}}
                        <form id="contact-us-form" name="contact-us-form" method="post" role="form" autocomplete="off">
                            @csrf
                            <div class="box" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)">
                                <div class="row" style="padding: 10px">

                                    <div class="error-container"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Applicant Name:</label>
                                            <input class="form-control form-control-name" name="name" id="name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Application Designation:</label>
                                            <input class="form-control form-control-email" name="designation" id="designation" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company Name:</label>
                                            <input class="form-control form-control-subject" name="company" id="company" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Consignee TIN No.:</label>
                                            <input class="form-control form-control-subject" name="tin" id="tin" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Consignee Contact Details:</label>
                                            <input class="form-control form-control-subject" name="contact" id="contact" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Quantity in Mt:</label>
                                            <input class="form-control form-control-subject" name="quantity_mt" id="quantity_mt" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bill of Landing No.:</label>
                                            <input class="form-control form-control-subject" name="bill_landing_no" id="bill_landing_no" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Description:</label>
                                            <input class="form-control form-control-subject" name="prod_description" id="prod_description" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country of Origin:</label>
                                            <input class="form-control form-control-subject" name="country_origin" id="country_origin" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Port of Discharge:</label>
                                            <input class="form-control form-control-subject" name="port_discharge" id="port_discharge" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Purpose of Importation:</label>
                                            <input class="form-control form-control-subject" name="purpose_importation" id="purpose_importation" placeholder="" >
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h4 style="color: darkslategray">Attached are the required documents</h4>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bill of Landing</label>
                                            <input class="form-control form-control-subject" id="bill_landing_path" name="bill_landing_path" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Commercial Invoice</label>
                                            <input class="form-control form-control-subject" id="commercial_invoice_path" name="commercial_invoice_path" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Packing List</label>
                                            <input class="form-control form-control-subject" id="packing_list_path" name="packing_list_path" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Certificate of Origin:</label>
                                            <input class="form-control form-control-subject" id="cert_origin" name="cert_origin" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Certificate of Analysis:</label>
                                            <input class="form-control form-control-subject" id="cert_analysis_path" name="cert_analysis_path" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Notarized Declaration of GMO and Non-GMO:</label>
                                            <input class="form-control form-control-subject" id="notarized_gmo_non_gmo_path" name="notarized_gmo_non_gmo_path" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Important Declaration (once available):</label>
                                            <input class="form-control form-control-subject" id="important_declaration_path" name="important_declaration_path" type="file">
                                        </div>
                                    </div>

                                    <div class="text-right col-md-11"><br>
                                            <button id="submitButton" class="btn btn-primary solid blank" type="submit">Submit</button>
                                        </div>




                                    {{--                                <div class="col-md-4">--}}
                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label>Message</label>--}}
                                    {{--                                        <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="10"></textarea>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}

                                    {{--                                <div class="col-md-12">--}}
                                    {{--                                    <div class="form-group">--}}
                                    {{--                                        <label>Captcha:</label> <br>--}}
                                    {{--                                        <img id="captcha-img" src="{{ captcha_src() }}" alt="captcha" style="margin-bottom: 10px">--}}
                                    {{--                                        <input type="text" name="captcha" class="form-control" placeholder="Please type the characters above">--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div><!-- Content row end -->
    </div><!-- Container end -->
</section><!-- Main container end -->
    @include('layouts.guest-footer')
{{--    @include('layouts.constra-footer')--}}

{{--    @include('layouts.constra-js-plugins')--}}
    @yield('scripts')
    <script>
        $("#img_url").fileinput({
            theme: "fa",
            allowedFileExtensions: ["pdf", "jpeg", "jpg", "png", "txt"],
            maxFileCount: 1,
            showUpload: false,
            showCaption: false,
            overwriteInitial: true,
            fileType: "pdf",
            browseClass: "btn btn-primary btn-md",
        });
        $(".kv-file-remove").hide();
    </script>

    <!-- Replace the variables below. -->
{{--    <script>--}}
{{--        function onSubmit(token) {--}}
{{--            document.getElementById("contact-us-form").submit();--}}
{{--        }--}}
{{--        function makeid(length) {--}}
{{--            let result = '';--}}
{{--            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';--}}
{{--            const charactersLength = characters.length;--}}
{{--            let counter = 0;--}}
{{--            while (counter < length) {--}}
{{--                result += characters.charAt(Math.floor(Math.random() * charactersLength));--}}
{{--                counter += 1;--}}
{{--            }--}}
{{--            return result;--}}
{{--        }--}}

{{--    </script>--}}

{{--    <script type="text/javascript">--}}
{{--        $(function () {--}}
{{--            $('form#contact-us-form').on('submit', function (event) {--}}
{{--                event.preventDefault(); // Prevent the default form submission--}}
{{--                let form = $(this);--}}

{{--                unmarkValidationErrors(form);--}}
{{--                // Show the loading indicator--}}
{{--                $('#submitButton').prop('disabled', true).text('Loading...');--}}

{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: "{{ route('contactUsStore') }}",--}}
{{--                    data: $('form').serialize(),--}}
{{--                    success: function (response) {--}}
{{--                        $('form').trigger("reset");--}}

{{--                        // Hide the loading indicator--}}
{{--                        $('#submitButton').prop('disabled', false).text('Submit');--}}

{{--                        Swal.fire({--}}
{{--                            title: 'Success!',--}}
{{--                            text: 'Thank you for contacting us. We will get back to you as soon as possible.',--}}
{{--                            icon: 'success',--}}
{{--                            confirmButtonText: 'Done'--}}
{{--                        });--}}
{{--                    },--}}
{{--                    error: function (response) {--}}
{{--                        validationError(form,response);--}}
{{--                        // Hide the loading indicator--}}
{{--                        $('#submitButton').prop('disabled', false).text('Submit');--}}
{{--                        form.find('img').attr('src','{{asset('/')}}captcha/default?'+makeid(7));--}}
{{--                        if (response.status === 429) {--}}
{{--                            // Handle the case where the user has already submitted the form today--}}
{{--                            Swal.fire({--}}
{{--                                title: 'Submission Limit Reached',--}}
{{--                                text: 'You have already submitted the form today. Please try again tomorrow.',--}}
{{--                                icon: 'error',--}}
{{--                                confirmButtonText: 'OK'--}}
{{--                            });--}}
{{--                        }--}}
{{--                        // console.log(response);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}





</div><!-- Body inner end -->
</body>

</html>
