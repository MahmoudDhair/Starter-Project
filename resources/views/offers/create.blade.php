<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item">
                <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>
<div class="container" style="margin-top: 40px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('massages.Add Offer')}}</div>

                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success', 'default')}}
                    </div>
                    @endif
                    <form method="POST" action="{{route('offer.store')}}" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary">{{__('massages.Offer Submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

