@extends('layouts.main')
@section('content')
    @include('includes.toolbar')
    @include('admin.cities.create')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                <span
                    class="card-label fw-bold fs-3 mb-1">{{ trans('global.view') }} {{ trans('cruds.cities.title') }}</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href=" " class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_target">
                            <span class="svg-icon svg-icon-2 bi-bag-plus"></span>
                            {{ trans('global.add') }} {{ trans('cruds.cities.title_singular') }}</a>
                    </div>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bold text-muted">
                                <th class="w-25px">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    </div>
                                </th>
                                <th class="min-w-150px"> {{ trans('cruds.cities.fields.id') }}</th>
                                <th class="min-w-140px">    {{ trans('cruds.cities.fields.title') }}</th>
                                <th class="min-w-140px">    {{ trans('cruds.cities.fields.status') }}</th>
                                <th class="min-w-100px text-end"> {{ trans('global.actions') }}</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            @foreach ($cities  as $key => $city)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bold text-hover-primary fs-6">#{{ $key+1 }}</a>
                                    </td>
                                    <td>
                                        <a
                                           class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ $city->title ?? '' }}</a>
                                    </td>

                                    <td>
                            <span
                                class="badge  @if($city->status ==1) badge-success  @else badge-danger  @endIf">
                               @if($city->status ==1) {{trans('cruds.active')}} @else  {{trans('cruds.un_active')}}@endIf
                            </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.cities.edit', $city->id) }}"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            @include('partials.icons.edit')
                                        </a>
                                        <button category_id_attr="{{$city->id}}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                onclick="Confirm_Delete(this)"
                                                data-url="{{ route('admin.cities.destroy', $city->id) }}">
                                            @include('partials.icons.delete')
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
        </div>
    </div>
    <!--end::Tables Widget 13-->

@endsection



@section('script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '#btn_save_city', function (e) {
            $('#btn_save_city').html('{{trans('global.save')}} <i class="fa fa-spinner fa-spin"></i>');
            e.preventDefault();
            $('.errors').text('');
            var formData = new FormData($('#formSaveCity')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route("admin.cities.store",$countryId) }}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_save_city').html('save');
                    if (data.status == true) {

                        document.getElementById("formSaveCity").reset();
                        setTimeout(function () {
                            var url = "{{ route('admin.cities.index',$countryId) }}"; //the url I want to redirect to
                            $(location).attr('href', url);
                        }, 0);

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error')}}", "{{trans('global.sorry_some_error')}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_save_city').html("save");

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        // for loop to all validation and show all validate
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


    </script>

@endsection


