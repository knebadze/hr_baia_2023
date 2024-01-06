@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

   <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $data['infoBox']['vacancyCount'] }}</h3>

              <p>ვაკანსიები</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.vacancy') }}" class="small-box-footer">სრულად <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $data['infoBox']['candidateCount'] }}</h3>

              <p>კანდიდატები</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.candidate') }}" class="small-box-footer">სრულად <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $data['infoBox']['enRollmentCount'] }}</h3>

              <p>ჩარიცხვები</p>
            </div>
            <div class="icon">
              <i class="ion ion-card"></i>
            </div>
            <a href="{{ route('admin.enrollment') }}" class="small-box-footer">სრულად <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $data['infoBox']['success'] }}<sup style="font-size: 20px">%</sup></h3>


              <p>დაკავებული %</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">სრულად <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <daily-reminder :data='@json($data['dailyReminder'])' :role_id='@json($role_id)'></daily-reminder>
            </section>
            <section class="col-lg-12 connectedSortable">
                <daily-work :data='@json($data["hrDailyWork"])' :role_id='@json($role_id)'></daily-work>
            </section>
        </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
