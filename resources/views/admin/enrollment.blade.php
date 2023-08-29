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
    <section class="content">
        <div class="container-fluid">
                {{-- <vacancy-page :data='@json($data)'></vacancy-page> --}}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <enrolled-page :data='@json($data['enrolled'])'></enrolled-page>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <p>2</p>
                    </div>
                </div>

        </div>
    </section>
@endsection
