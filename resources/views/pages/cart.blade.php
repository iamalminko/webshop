@extends('layouts.base')

@section('content')

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div id="app">
            <cart-component></cart-component>
        </div>
    </div><!--end container-->

</main>

@endsection