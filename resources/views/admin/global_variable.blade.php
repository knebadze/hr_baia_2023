@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">გლობალური ცვლადები</h1>

        </div><!-- /.col -->
        {{-- <div class="col-md-6 d-flex justify-content-end">
        </div> --}}
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <hr>
  </div>

  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <global-variable :data='@json($data)'></global-variable>
        </div>
    </section>
@endsection
