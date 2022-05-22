<!DOCTYPE html>
<html>
    <head>
        <title>Cache Status</title>
        <link type="text/css" href="/css/detailCache.css" rel="stylesheet"/>
    </head>
    <body>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="module" src="/js/contact_details.js"></script>
        <x-heading/>
        <x-summaryCard/>

        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />


    </body>
</html>
