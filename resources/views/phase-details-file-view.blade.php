@extends('layouts.master')

@section('title', 'Phase Details Files')
{{-- @section('page-name', 'Project Details') --}}

@section('extra-css')
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    <style>
        .image-showing {
            max-width: 100%;
            height: auto;
            padding: 20px;
        }

        @media only screen and (max-width: 600px) {
            .image-showing {
                max-width: 290%;
                height: auto;
                padding: 20px;
                width: 304px;
            }
        }

        @media only screen (min-width: 601px) and (max-width: 768px) {
            .image-showing {
                max-width: 190%;
                height: auto;
                padding: 20px;
            }
        }

    </style>
@endsection


@section('main-content')
@csrf
    <div class="row">
        <div class="col-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h4 class="card-title"> {{ $projects->name }} Files</h4>
                </div>
                <div class="card-body">
                    <div class="mb-2 ">
                        <div class="float-right mb-4">
                            {{-- <select class="custom-select" style="width: auto;" data-sortOrder>
                                <option value="index"> Sort by Position </option>
                                <option value="sortData"> Sort by Custom Data </option>
                            </select> --}}
                            <div class="btn-group">
                                <a class="btn btn-outline-dark" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                <a class="btn btn-outline-dark" href="javascript:void(0)" data-sortDesc> Descending </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="btn-group w-100 mb-2">
                            <a class="btn btn-outline-dark clicked" href="javascript:void(0)" data-filter="0"
                                onclick="viewSelection(0)"> All Files </a>
                            @foreach ($phases as $phase)
                                <a class="btn btn-outline-dark clicked" href="javascript:void(0)"
                                    data-filter="{{ $phase->id }}" onclick="viewSelection({{ $phase->id }})">
                                    {{ $phase->name }} </a>
                            @endforeach
                        </div>

                    </div>
                    <div>
                        <div class="filter-container p-0 row">
                            {{-- filtr-item --}}
                            @foreach ($phaseFiles as $phasefile)

                                <div class="col-md-3 col-sm-12 class{{ $phasefile->phase_id }} class0 "
                                    data-category="{{ $phasefile->phase_id }}" data-sort="{{ $phasefile->created_at }}">

                                    <img class="image-showing "
                                        src="{{ URL::asset('pocheImages') }}/{{ $phasefile->file_name }}"
                                        alt="{{ $phasefile->file_name }}" />
                                    <div class="text-center">
                                        <a href="{{ route('file.edit', ['id' => $phasefile->id, 'name' => $phasefile->file_name]) }}"><button
                                                type="button" class="btn btn-outline-secondary btn-flat"><i
                                                    class="fa fa-edit"></i></button></a>
                                        <button type="button" class="btn btn-outline-secondary btn-flat"
                                            onclick="deleteFile('{{ $phasefile->id }}')"><i
                                                class="fas fa-trash-alt"></i></button>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('extra-js')

    <script src="{{ URL::asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <script src="{{ URL::asset('admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <script>
        //$(function() {
        //     $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        //         event.preventDefault();

        //         $(this).ekkoLightbox({
        //             alwaysShowClose: true,

        //         });

        //     });

        //     $('.filter-container').filterizr({
        //         gutterPixels: 3
        //     });
        //     $('.btn[data-filter]').on('click', function() {
        //         $('.btn[data-filter]').removeClass('active');
        //         $(this).addClass('active');
        //     });
        // })

        // $('#open-image').click(function(e) {
        //     e.preventDefault();
        //     $(this).ekkoLightbox();
        // });

        function viewSelection(id) {
            $('.class0').hide();
            $('.class' + id).show("slow");
        }

        $(document).ready(function() {
            $(".clicked").click(function() {
                $(".clicked").removeClass("active");
                $(this).addClass("active");
            });
        });


        function deleteFile(id) {

            if (confirm("Do You Really Want To Delete This FIle ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('file.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'file has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 1500,
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

                    }

                });
            }
        }
    </script>

@endsection
