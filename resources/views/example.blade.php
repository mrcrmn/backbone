@extends('layouts.master')

@section('page_title', $example)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    {{ $example }}
                </h1>
            </div>
        </div>
    </div>
@endsection
