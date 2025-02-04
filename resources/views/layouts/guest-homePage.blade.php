<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home | Sugar Regulatory Administration</title>
    <meta property="og:title" content='SRA | Sugar Regulatory Administration'/>
    <meta property="og:image" content='https://demo.sra.gov.ph/constra/images/SRA/SRA_thumbnail.png'/>
    <meta property="og:description" content="SRA is committed to promote the advancement and competitiveness
                                            of the sugarcane industry amidst global challenges. It shall continue to improve the way it does its business,
                                             in an effort to meet the expectations of its clientele while maintaining compliance, to applicable legal requirements.
                                             It shall ensure the continual improvement of its human resource capabilities, as response to the current and strategic
                                             needs of the industry."/>
    <meta property="og:url" content='https://demo.sra.gov.ph'/>
    <meta property='og:image:width' content='1000' />
    <meta property='og:image:height' content='800' />
    <!-- Twitter Card metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SRA | Sugar Regulatory Administration">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="https://sra.gov.ph/constra/images/SRA/SRA_thumbnail.png">
    <meta property="fb:app_id" content="1152765825738860">
    <meta property="og:type" content='website'/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@include('layouts.constra-css-plugins')
    <body>
        <section>
            <div class="container">
                <h2>Hello Aten (Home Page)</h2>
            </div>
        </section>

@include('layouts.constra-js-plugins')


@yield('scripts')
        <script>

        </script>
    </body>
</html>