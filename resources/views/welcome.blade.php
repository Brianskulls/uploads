<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
    <form action="emaildatabase" enctype="multipart/form-data" method="post">
        @csrf
        <input type="file" name="emaildatabase">
        <button type="submit">Submit</button>
    </form>
    @foreach ($errors->all() as $error)
        {!! $errors->first() !!}
    @endforeach
    </body>
</html>
