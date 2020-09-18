@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 40px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('massages.Add Offer')}}</div>

                    <div class="card-body">
                        <div class="alert alert-success" id="success_msg" style="display: none" role="alert">
                            تم اضافة العرض بنجاح
                        </div>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success', 'default')}}
                            </div>
                        @endif
                        <form method="POST" id="data-offer" action="{{route('ajax.offer.store')}}">
                            @csrf
                            {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}

                            <div class="form-group">
                                <label for="name_ar">{{__('massages.Choose Photo')}}</label>
                                <input type="file" class="form-control" id="photo"   name="photo">
                                @error('photo')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name_ar">{{__('massages.Offer Name ar')}}</label>
                                <input type="text" class="form-control" id="name_ar" value="{{old('name_ar')}}"  name="name_ar" placeholder="{{__('massages.Offer Name ar')}}">
                                @error('name_ar')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name_en">{{__('massages.Offer Name en')}}</label>
                                <input type="text" class="form-control" id="name_en" value="{{old('name_en')}}"  name="name_en" placeholder="{{__('massages.Offer Name en')}}">
                                @error('name_en')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pric">{{__('massages.Offer Price')}}</label>
                                <input type="text" class="form-control" id="pric" value="{{old('pric')}}" name="pric" placeholder="{{__('massages.Offer Price')}}">
                                @error('pric')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="details_ar">{{__('massages.Offer Details ar')}}</label>
                                <input type="text" class="form-control" id="details_ar" value="{{old('details_ar')}}" name="details_ar" placeholder="{{__('massages.Offer Details ar')}}">
                                @error('details_ar')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="details_en">{{__('massages.Offer Details en')}}</label>
                                <input type="text" class="form-control" id="details_en" value="{{old('details_en')}}" name="details_en" placeholder="{{__('massages.Offer Details en')}}">
                                @error('details_en')
                                <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button id="save_offer" class="btn btn-primary">{{__('massages.Offer Submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click','#save_offer',function (e){
            // save_offer is the id of button
            e.preventDefault();
            //data-offer is the id of form
            var formData = new FormData($('#data-offer')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offer.store')}}",
                data:formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status === true){
                        $('#success_msg').show();
                    }else {
                        alert(data.msg);
                    }
                }, error: function (reject) {

                }
            });
        });
    </script>

@stop

