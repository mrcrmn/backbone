@extends('layouts.master')

@section('page_title', $error)
@section('page_description', $msg)

@section('content')
    <h1>
        Error: {{$error}} <br>
        {{ $msg }}
    </h1>
@endsection
