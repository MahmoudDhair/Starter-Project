<!DOCTYPE html>
<html lang="en">

@include('includes.head')

<body id="page-top">

@include('includes.header')

@yield('content', 'Default Content')

@include('includes.footer')


@include('PortfolioModals.model1')


@include('PortfolioModals.model2')


@include('PortfolioModals.model3')


@include('PortfolioModals.model4')


@include('PortfolioModals.model5')


@include('PortfolioModals.model6')



<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="{{URL::asset('assets/mail/jqBootstrapValidation.js')}}"></script>
<script src="{{URL::asset('assets/mail/contact_me.js')}}"></script>
<!-- Core theme JS-->
<script src="{{URL::asset('js/scripts.js')}}"></script>
</body>
</html>
