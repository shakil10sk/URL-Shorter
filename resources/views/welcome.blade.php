<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body class="antialiased">
        <div class="row p-4">
            <div class="col-md-8 mx-auto">
                <form action="{{url('short/url')}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Input Long URL:</span>
                        <input  name="longUrl" type="text" class="form-control" placeholder="longUrl" aria-label="longUrl" aria-describedby="basic-addon1">
                      </div>
                      <button type="submit" class="btn btn-primary">Short Url</button>
                </form>
                <br>
                @if (!empty(session('shortUrl')) && session('shortUrl') != 'Invalid URL')
                    <h4>Your Short Url is : </h4> <a href="{{ url('/redirect/short/url/'.session('shortUrl')) }}" target="_blank">
                    {{ url('/'.session('shortUrl')) }}</a>
                @else
                        <h4 class="text-danger">{{session('shortUrl')}}</h4>
                @endif
            </div>
        </div>
    </body>
</html>
