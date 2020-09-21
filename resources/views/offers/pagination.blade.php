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
    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('massages.Offer Name')}}</th>
            <th scope="col">{{__('massages.Offer Price')}}</th>
            <th scope="col">{{__('massages.Offer Details')}}</th>
            <th scope="col">{{__('massages.Offer Image')}}</th>
            <th scope="col">{{__('massages.options')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($offers as $offer)
        <tr>
            <th scope="row">{{$offer -> id}}</th>
            <td>{{$offer -> name}}</td>
            <td>{{$offer -> pric}}</td>
            <td>{{$offer -> details}}</td>
            <td><img src="{{asset('images/offers/'.$offer -> photo)}}" class="img-thumbnail" width="100" height="100"></td>
            <td>
                <a href="{{url('offer/edit/'.$offer -> id)}}" class="btn btn-success btn-sm">{{__('massages.update')}}</a>
                <a href="{{route('offer.delete',$offer -> id)}}" class="btn btn-danger btn-sm">{{__('massages.Delete')}}</a>
            </td>
        </tr>
        @endforeach


        </tbody>
    </table>
        <div class="d-flex justify-content-center">
            {{$offers->links()}}
        </div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

