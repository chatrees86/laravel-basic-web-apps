@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <ul class="list-group">
                        <a href="{{action('HomeController@welcome')}}"> <li class="list-group-item">Bx.in.th Crypto Markets (Demo Call API)</li> </a>
                        <a href="{{action('CryptoController@index')}}"> <li class="list-group-item">Crypto News (Demo CRUD)</li> </a>
                        <a href="{{action('CryptoController@api')}}" target="_blank"> <li class="list-group-item">Crypto News APIs (Demo Provide API)</li> </a>
                    </ul>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
