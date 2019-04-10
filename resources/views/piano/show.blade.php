@extends('layouts.master')

@section('title')
    Piano Scales
@endsection

@section('header')
    <h1 style="margin-bottom:70px;">🎵 Fun with Musical Scales 🎵</h1>
@endsection

@section('pre_input_explanation')
        <h4>Derive a musical scale here, and see it on the piano!  🎹</h4>
@endsection

@section('input_form')
    @if (!isset($inputs))
        <!-- convenience to help with ternery operators -->
        @php ($inputs = ['root'=>null,'scale_type'=>null,'root_opts'=>null])
    @endif

    <div id="options">
        <form method="GET" action="/piano/pianoProcess" >
            <label>
            Root note: <input type="text" name="root" value="{{ old('root') ?: $inputs['root'] ?: 'C' }}" size="4" maxlength="1">
        </label>@include('snippets.req')
            <input type="radio" name="root_opts" value="nat"
                {{ (old('root_opts') != 'nat' || $inputs['root_opts'] != 'nat') ? 'checked' : '' }}
            >♮
            <input type="radio" name="root_opts" value="sharp"
                {{ (old('root_opts') == 'sharp' || $inputs['root_opts'] == 'sharp') ? 'checked' : ''  }}
            >♯
            <input type="radio" name="root_opts" value="flat"
                {{ (old('root_opts') == 'flat' || $inputs['root_opts'] == 'flat') ? 'checked' : ''  }}
             >♭@include('snippets.req')
             <br>
            <br>

            @if (isset($root_error))
                <ul id="errors-list">
                    <li class="errors">{{ $root_error }}</li>
                </ul>
                <br>
            @elseif(count($errors) > 0)
                <ul id="errors-list">
                    @foreach ($errors->all() as $error)
                        <li class="errors">{{ $error }}</li>
                    @endforeach
                </ul>
                <br>
            @endif

            <select name="scale_type">
                <option value="major">Major</option>
                <option value="minor"
                    {{ (old('scale_type') == 'minor' || $inputs['scale_type'] == 'minor') ? 'selected' : '' }}
                >Minor</option>
            </select>@include('snippets.req')
            <br>
            @if(!isset($rootNote))
                <br>
                <br>
            @endif
            <input type="submit" value="Submit" id="submit-button">
        </form>
        @if(!isset($rootNote))
            <br>
            <div id="req-explanation">@include('snippets.req')required</div>
        @endif
    </div>

@endsection

@section('piano')

    @if (isset($rootNote) && count($errors) <= 0)

        <div id="piano">

        @for ($n=0; $n < 2; $n++) {{-- iterates twice to get two octaves --}}

            @for ($i = 0; $i < sizeof($twelve_tones); $i++)
                @if (in_array($twelve_tones[$i], $black_keys))
                    @php ($class = 'blackkey')
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
    @if (isset($rootNote) && count($errors) <= 0)
        <ul>
            <li><div class="whitekey highlighted-root"><b>Root note</b></br>
                @if($inputs['root_opts'] == 'sharp')
                    {{ $inputs['root'].'♯' }}
                @elseif ($inputs['root_opts'] == 'flat')
                    {{ $inputs['root'].'♭' }}
                @else
                    {{ $inputs['root'] }}
                @endif
            </div></li>
            <li><div class="whitekey highlighted"><b>Scale tones</b></div></li>
        </ul>
    @endif

@endsection
