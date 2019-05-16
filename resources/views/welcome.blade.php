@extends('layouts.master')

@section('title')
    Welcome to Neuroscience Lab
@endsection

@section('splash')
    <div id="splash">
        <div class="welcome-splash">
            <h1>Welcome to Neuroscience Lab</h1>
            <p>
                <img src="/img/brain.png" style="max-width:40%" alt="an image of a brain"/>
            </p>
        </div>
    </div>
@endsection

@section('weclome_content')
    <div class="welcome-content">
        <p>Here, you can interface with the lab database. You can:</p>
        <ul>
            <li>Run reports on studies—local (fMRI) or MTurk</li>
            <li>Create studies and participants</li>
            <li>Update studies and participants</li>
            <li>Add participants to studies</li>
        </ul>
    </div>
@endsection
