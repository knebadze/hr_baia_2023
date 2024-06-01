@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 

  <!-- /.content-header -->

    <!-- Main content -->
    
            <vacancy-attached :data='@json($data)' :auth='@json($auth)' :candidate='@json($candidate)'></vacancy-attached>
       
@endsection
