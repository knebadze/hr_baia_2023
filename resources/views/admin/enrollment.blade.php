@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ჩარიცხვები</h1>

        </div><!-- /.col -->
        <div class="col-md-6 d-flex justify-content-end">
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">ჩაირიცხა</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">უნდა ჩაირიცხოს</a></li>
            </ul>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <hr>
  </div>

  <!-- /.content-header -->

    <!-- Main content -->
    <enrollment-page :data='@json($data)'></enrollment-page>
@endsection
