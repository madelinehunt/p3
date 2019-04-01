<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link href='./css/local.css' rel='stylesheet'>

</head>
<body>
    <div id="roundrect-container">
        <div id="intro">
            @yield('header')
        </div>


        <div id="explanation">
            @yield('pre_input_explanation')
        </div>

        <div id="form">
            @yield('input_form')
        </div>


        <div id="piano-div">
            @yield('piano')
        </div>

        <div id="explain-notes">
            @yield('post_input_explanation')
        </div>
    </div>
</body>
