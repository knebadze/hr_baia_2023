@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">SMS შაბლონები</h1>

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
            <div class="row">
                <section class="col-lg-6">
                    <div class="card ">
                        <div class="card-header border-0">
                          <h3 class="card-title">
                            სახელი
                          </h3>
                          <!-- card tools -->
                          <div class="card-tools">
                            <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                          <textarea class="w-100" name="" id=""  rows="4"></textarea>
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer ">
                            <button class="btn btn-primary float-rigth">რედაქტირება</button>
                        </div>
                      </div>
                      <!-- /.card -->
                </div>

            </div>
            {{-- <testimonial-page :data='@json($testimonial)'></testimonial-page> --}}
        </div>
    </section>
@endsection
