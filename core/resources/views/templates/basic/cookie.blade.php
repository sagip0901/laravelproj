@extends('Template::layouts.frontend')
@section('content')
    <section class="pt-70 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @php
                        echo $cookie->data_values->description;
                    @endphp
                </div>
            </div>
        </div>
    </section>
@endsection
