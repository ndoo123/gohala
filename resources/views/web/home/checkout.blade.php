@extends('web.master_web')
@section('content')
<div class="main-container col1-layout">
     <div class="container">

    <div class="row">
        <div class="col-md-6 col-md-6">
            <div class="page-content checkout-page">
                @include('web.home.components.checkout_address')
                @include('web.home.components.delivery')
            </div>
        </div>
    </div>
</div>
</div>

@stop
