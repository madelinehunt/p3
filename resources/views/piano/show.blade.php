@extends('layouts.master')

@section('title')
    Nathan Hunt
@endsection

@section('header')
    <h1 style="margin-bottom:70px;">🎵 Fun with Musical Scales 🎵</h1>
@endsection

@section('pre_input_explanation')
    {{-- @if (!isset($rootNote)) --}}
        <h4>Derive a musical scale here, and see it on the piano!  🎹</h4>
    {{-- @endif --}}
@endsection

@section('input_form')

    {{-- @if (!isset($rootNote)) --}}
    <div id="options">
        <form method="GET" action="/p3/public/piano/pianoProcess" >
            <label>
            Root note: <input type="text" name="root" value="{{ $inputs->root ?? 'C' }}" size="4" maxlength="1">
            </label>
            <input type="radio" name="root_opts" value="nat" @if( isset($inputs) && $inputs->root_opts != 'nat'){{ "" }} @else {{ "checked" }} @endif>♮
            <input type="radio" name="root_opts" value="sharp" @if(isset($inputs) && $inputs->root_opts == 'sharp'){{ "checked" }} @endif>♯
            <input type="radio" name="root_opts" value="flat" @if(isset($inputs) && $inputs->root_opts == 'flat'){{ "checked" }} @endif>♭<br>
            <br>
            <select name="scale_type">
                <option value="major">Major</option>
                <option value="minor" @if(isset($inputs) && $inputs->scale_type == 'minor'){{ "selected" }} @endif>Minor</option>
            </select>
            <br>
            <input type="submit" value="Submit" id="submit-button">
        </form>
    </div>
    {{-- @endif --}}

@endsection

@section('piano')

    @if (isset($rootNote))

        <div id="piano">

        @for ($n=0; $n < 2; $n++) {{-- iterates twice to get two octaves --}}

            @for ($i = 0; $i < sizeof($twelve_tones); $i++)
                @if (in_array($twelve_tones[$i], $black_keys))
                    @php ($class = 'blackkey') {{-- credit https://stackoverflow.com/questions/13002626/how-to-set-variables-in-a-laravel-blade-template --}}
                @else
                    @php ($class = 'whitekey')
                @endif

                @if ($twelve_tones[$i] == $rootNote)
                    @php ($hilite = 'highlighted-root')
                @elseif (in_array($twelve_tones[$i], $highlights))
                    @php ($hilite = 'highlighted')
                @else
                    @php ($hilite = '')
                @endif

                <div class="{{ $class }} {{ $hilite }}" data-note="{{ $twelve_tones[$i] }}"></div>
            @endfor

        @endfor

        </div>
    @endif

@endsection

@section('post_input_explanation')
    @if (isset($rootNote))
        <ul>
            <li><div class="whitekey highlighted-root"><b>Root note</b></br>{{ $inputs->root }}</div></li>
            <li><div class="whitekey highlighted"><b>Scale tones</b></div></li>
        </ul>
        <form method="GET" action="/p3/public" >
            <input type="submit" value="Clear" id="submit-button" style="position:absolute;top:75%">
        </form>
    @endif
@endsection
