@extends('layouts.appPage')
@section('title-block')
@section('title-block')
   {{ __('lang.page_title_individual') }}
@endsection
@endsection
@section('content')

<div id="page-content">

    <div class="content-admin-main">

        <div style="height:100px"></div>
        <!--Basic Information-->
        <post-vacancy-page :data='@json($data)'></post-vacancy-page>

    </div>

</div>

@endsection
