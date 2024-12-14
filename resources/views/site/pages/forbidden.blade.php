<!DOCTYPE html>
<html>

<head>
    <title>Forbidden</title>
    <link rel="icon" href="{{ asset('site/img/filled_bow_tie_40px.png') }}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
</head>
<style>
    .errPage {
        background-image: url('site/img/forbidden.png');
        background-size: cover;
        background-position: center center;
        min-height: 100vh;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-direction: column;
    }
</style>
<body>

    <div>
        <div class="text-center errPage pb-4">
            <a href="{{ route('site.home') }}" class="btn btn-primary">
                <i class="flaticon-left-arrow" aria-hidden="true"></i>
                Back to Home
            </a>
        </div>
    </div>

    <script src="{{ asset('site/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('site/js/popper.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>

</body>

</html>
