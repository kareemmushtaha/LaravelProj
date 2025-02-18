@extends('layouts.main')
@section('title',trans('global.edit',[],session('locale')) .''. trans('cruds.user.title_singular',[],session('locale')))
@section('content')
    @include('includes.toolbar')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('global.edit',[],session('locale')) }} {{ trans('cruds.user.manager',[],session('locale')) }}</h3>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <span class="example-toggle" data-toggle="tooltip" title=""
                                  data-original-title="View code"></span>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="formUpdateUser" novalidate="novalidate"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-13 text-center">
                        </div>
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        @include('includes.form.photo',['name'=>'photo','value'=>$admin->photo])
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.first_name',[],session('locale')),'placeholder'=>trans('cruds.hospital.fields.name',[],session('locale')),'id'=>'first_name','name'=>'first_name','span'=>'first_name','value'=>$admin->first_name ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.last_name',[],session('locale')),'placeholder'=>trans('cruds.hospital.fields.last_name',[],session('locale')),'id'=>'last_name','name'=>'last_name','span'=>'last_name','value'=>$admin->last_name ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'email','label'=>trans('cruds.user.fields.email',[],session('locale')),'placeholder'=>trans('cruds.hospital.fields.email',[],session('locale')),'id'=>'email','name'=>'email','span'=>'email','value'=>$admin->email ])
                                </div>
                            </div>
                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'password','label'=>trans('cruds.user.fields.password',[],session('locale')),'placeholder'=>trans('cruds.hospital.fields.password',[],session('locale')),'id'=>'password','name'=>'password','span'=>'password','value'=>null ])
                                </div>
                            </div>

                            <div class="col-md-6 fv-row">
                                <div class="d-flex flex-column mb-8 fv-row">
                                    @include('includes.form.input',['type'=>'text','label'=>trans('cruds.user.fields.phone',[],session('locale')),'placeholder'=>trans('cruds.hospital.fields.phone',[],session('locale')),'id'=>'phone','name'=>'phone','span'=>'phone','value'=>$admin->phone  ])
                                </div>
                            </div>


                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.intro',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.user.fields.intro',[],session('locale'))}}"
                                        name="intro" id="intro">
                                    <option value="">{{trans('cruds.user.fields.intro',[],session('locale'))}}</option>
                                    @foreach($countries as $id => $country)
                                        <option @if($admin->intro  == $country->phone_code) selected
                                                @endif value={{$country->phone_code}}>{{$country->phone_code}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="intro_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.country',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.user.fields.country',[],session('locale'))}}"
                                        name="country_id" id="country_id">
                                    <option value="">{{trans('cruds.user.fields.country',[],session('locale'))}}</option>
                                    @foreach($countries as $id => $country)
                                        <option @if($admin->country_id  == $country->id) selected
                                                @endif value={{$country->id}}>{{$country->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="country_id_error"> </span>
                            </div>

                            <div class="col-md-6 fv-row">
                                <label
                                    class="required fs-6 fw-semibold mb-2">{{ trans('cruds.user.fields.city',[],session('locale')) }}</label>
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true"
                                        data-placeholder="{{trans('cruds.user.fields.city',[],session('locale'))}}"
                                        name="city_id" id="city_id">
                                    <option value="">{{trans('cruds.user.fields.city',[],session('locale'))}}</option>
                                    @foreach($cities as $id => $city)
                                        <option @if($admin->city_id  == $city->id) selected
                                                @endif value={{$city->id}}>{{$city->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors"
                                      id="city_id_error"> </span>
                            </div>

                            <div class="separator separator-dashed my-10"></div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-9 ml-lg-auto">
                                        <a class="btn btn-light-primary" onclick="history.back();">
                                            {{ trans('global.back',[],session('locale')) }}
                                        </a>
                                        <button class="btn btn-primary mr-2" type="button"
                                                id="btn_update_user"> {{ trans('global.edit',[],session('locale')) }}</button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden">
                            <div></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '#btn_update_user', function (e) {
            e.preventDefault();
            $('.errors').text('');

            var formData = new FormData($('#formUpdateUser')[0]); //get all data in form
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route("admin.manager.update",$admin->id)}}",
                data: formData, // send this data to controller
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#btn_update_user').html();

                    if (data.status == true) {
                        Swal.fire({
                            title: data.msg,
                            text: data.msg,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "{{trans('global.confirmation',[],session('locale'))}}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });

                    } else {
                        Swal.fire("{{trans('global.sorry_some_error',[],session('locale'))}}", "{{trans('global.sorry_some_error',[],session('locale'))}}", "error");
                    }
                }, error: function (reject) {
                    $('#btn_update_user').html('save');

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
