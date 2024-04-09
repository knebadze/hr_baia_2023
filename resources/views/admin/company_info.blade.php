@extends('layouts.app')
@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">კომპანიის ინფორმაცია</h1>

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
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('update_company_info') }}">
                @csrf
                <div class="row">

                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="" for="ka">ნომერი</label>
                            <input class="form-control" type="text" id="number" name="number" value="{{ $data->number }}" />

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="" for="ka">შიდა ნომერი</label>
                            <input class="form-control" type="text" id="inside_number" name="inside_number" value="{{ $data->inside_number }}" />

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <label class="" for="ka">მაილი</label>
                            <input class="form-control" type="mail" id="gmail" name="gmail" value="{{ $data->gmail }}" />

                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="row border py-2">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">მისამართი 1</label>
                                    <input class="form-control" type="text" id="address_1" name="address_1" value="{{ $data->address_1 }}" />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">მისამართი 2</label>
                                    <input class="form-control" type="text" id="address_2" name="address_2" value="{{ $data->address_2 }}" />

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 mb-1">
                        <div class="row border py-2">
                            <div class="col-12"><p class="font-weight-bold font-italic">ლოკაცია 1</p></div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">latitude</label>
                                    <input class="form-control" type="text" id="lat_1" name="lat_1" value="{{ $data->lat_1 }}" />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">longitude</label>
                                    <input class="form-control" type="text" id="long_1" name="long_1" value="{{ $data->long_1 }}" />

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="row border py-2">
                            <div class="col-12"><p class="font-weight-bold font-italic">ლოკაცია 2</p></div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">latitude</label>
                                    <input class="form-control" type="text" id="lat_2" name="lat_2" value="{{ $data->lat_2 }}" />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">longitude</label>
                                    <input class="form-control" type="text" id="long_2" name="long_2" value="{{ $data->long_2 }}" />

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <div class="row border py-2">
                            <div class="col-12"><p class="font-weight-bold font-italic">links</p></div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">fb_link</label>
                                    <input class="form-control" type="text" id="fb_link" name="fb_link" value="{{ $data->fb_link }}" />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="" for="ka">tw_link</label>
                                    <input class="form-control" type="text" id="tw_link" name="tw_link" value="{{ $data->tw_link }}" />

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">ცვლილების შენახვა</button>
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection
