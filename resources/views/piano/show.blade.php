@extends('layouts.master')

@section('title')
    Nathan Hunt
@endsection

@section('header')
    <h1 style="margin-bottom:70px;">🎵 Fun with Musical Scales 🎵</h1>
@endsection

@section('pre_input_explanation')
    <h4>Derive a musical scale here, and see it on the piano!  🎹</h4>
@endsection

@section('input_form')
    <div id="options">
            <form action="./scales.php" method="get">
                <label>
                    Root note: <input type="text" name="root" value="C" size="4" maxlength="1">
                </label>
                <input type="radio" name="root_opts" value="nat" checked>♮
                <input type="radio" name="root_opts" value="sharp">♯
                <input type="radio" name="root_opts" value="flat">♭<br>
                <br>
                <!-- <input type="checkbox" name="display_opts" value="solfege">Solfege<br> -->
                <select name="scale_type"> <!-- replace with radio buttons? or checkboxes? -->
                    <option value="major">Major</option>
                    <option value="minor">Minor</option>
                </select>
                <br>
                <input type="submit" value="Submit" id="submit-button">
            </form>
        </div>
@endsection

@section('piano')
    {{ $rootNote }}
@endsection
