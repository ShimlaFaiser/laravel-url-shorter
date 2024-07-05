<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <title>url shortner</title>
</head>

<body>
    <div id="container">
        <h2 class="heading">URL Shortner</h2>
        @if (Session::has('errors'))
        <h3 class="error">{{ $errors->first('link') }}</h3>
    @endif

    @if (Session::has('message'))
        <h3 class="error"> {{ Session::get('message') }}</h3>
    @endif

    @if (Session::has('link'))
        <h3 class="error"><a href="{{ url(Session::get('link')) }}">{{ Session::get('link') }}</a> is your short link</h3>
    @endif
        <form action="{{ url('/') }}" method="POST">
            @csrf
            <input type="text"  id="urlInput" name="link" placeholder="insert url and press enter">
<button class="btn btn-success" id="button" type="submit">Generate Shorten Link</button>
        </form>


        <table class="table table-bordered ">

                <tr>
                    <th>ID</th>
                    <th>link</th>
                    <th>Short link</th>
                </tr>

            <tbody>
                @foreach ( $link as $links)
                <tr>
                    <td>{{$links->id}}</td>
                    <td>{{$links->url}}</td>
                    <td>{{$links->hash}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</body>

</html>
