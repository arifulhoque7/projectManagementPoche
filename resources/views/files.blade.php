@extends('layouts.master')

@section('title', 'File Upload')
@section('page-name', 'File Upload')

@section('extra-css')
    <link rel="profile" href="http://www.w3.org/1999/xhtml/vocab" />

    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/plugins/imageEditor/imageMaker.css') }}">



@endsection


@section('main-content')
    @csrf

    <!DOCTYPE html>
    <html lang="en" dir="ltr"
        prefix="content: http://purl.org/rss/1.0/modules/content/ dc: http://purl.org/dc/terms/ foaf: http://xmlns.com/foaf/0.1/ og: http://ogp.me/ns# rdfs: http://www.w3.org/2000/01/rdf-schema# sioc: http://rdfs.org/sioc/ns# sioct: http://rdfs.org/sioc/types# skos: http://www.w3.org/2004/02/skos/core# xsd: http://www.w3.org/2001/XMLSchema#">

    <head>


    </head>

    <body>
        <title>Jquery Image Maker Plugin Examples</title>
        <div id="custom-div">
            <h1>Custom Try</h1>
            <button class="replace_image">Replace Image</button>

        </div>
    </body>

    </html>

@endsection


@section('extra-js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
    <script src="{{ URL::asset('admin/plugins/imageEditor/imageMaker.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#custom-div').imageMaker({
                merge_images: [{
                    url: '{{ URL::asset('signs/approved.png') }}',
                    title: 'Approved'
                }, {
                    url: '{{ URL::asset('signs/rejected.png') }}',
                    title: 'Rejected'
                }, ],
                templates: [{
                    url: '{{ URL::asset('pocheImages/' . $fileName) }}',
                    title: '{{ $fileName }}'
                }],
                text_boxes_count: 0
            });

            $('#image-maker').imageMaker();
            //The following code is for animate scrolling when open the page
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery("#" + jQuery(":target").attr('id')).offset().top
            }, 1000);
        });

        function replaceImage(data) {
            var _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{ route('file.replace') }}",
                type: 'POST',
                data: {
                    id: {{ $fileId }},
                    image: data,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'file has been Edited Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        hidePreloader();
                        window.setTimeout(
                            function() {
                                window.location.href = "{{ route('phase.details.file.view') }}/" +
                                    response.project_id;
                            },
                            1000
                        );
                    }
                },

                error: function(xhr, status, error) {
                    hidePreloader();
                    $("#errorDivForReplaceDetails").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForReplaceDetails").append(
                            "<li class='alert alert-danger'>" + item +
                            "</li>")
                    });
                }
            });
        }
    </script>
@endsection
