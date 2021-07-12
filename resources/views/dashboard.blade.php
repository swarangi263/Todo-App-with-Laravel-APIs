@extends('layouts.app')
@section('title','Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <h1 class="text-center fw-bold text-uppercase">@foreach ($names as $name)
                    {{ __('Hello '. $name->name.' !') }}
                    @endforeach
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection
