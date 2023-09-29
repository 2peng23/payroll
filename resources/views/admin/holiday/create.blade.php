@extends('admin.layout.app')

@section('title') Create Holiday @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
</style>
@endsection

@section('content')

<div class="page-header">
  <div class="row align-items-end">
     <div class="col-lg-8">
        <div class="page-header-title">
           <i class="ik ik-file-minus bg-blue"></i>
           <div class="d-inline">
              <h5>Create Holiday</h5>
              <span>Create Holiday, Please fill all field correctly.</span>
          </div>
      </div>
  </div>
  <div class="col-lg-4">
    <nav class="breadcrumb-container" aria-label="breadcrumb">
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
         </li>
         <li class="breadcrumb-item">
             <a href="{{ route('admin.holiday.index') }}">Holiday</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Create</li>
     </ol>
 </nav>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xl-6 offset-md-3 offset-xl-3">

        <div class="widget overflow-visible">
            <div class="progress progress-sm progress-hi-3 hidden">
                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
            </div>
            <div class="widget-body">
                <div class="overlay hidden">
                    <i class="ik ik-refresh-ccw loading"></i>
                    <span class="overlay-text">New Holiday Creating...</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="Holiday">
                        <h5 class="text-secondary">Create Holiday</h5>
                    </div>
                </div>

                <form action="{{ route('admin.holiday.store') }}" method="POST" id="createHoliday">
                    @csrf
                    <div class="form-group">
                        <label for="name">Date</label><small class="text-danger">*</small>
                        <input type="date" name="date" class="form-control" id="name" placeholder="ex: Standard Holiday" autocomplete="off">
                        <small class="text-danger err" id="name-err"></small>
                    </div>
                      
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Some description about holiday..."></textarea>
                                <small class="text-danger err" id="description-err"></small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="ik save ik-save"></i>Submit</button>
                    
                    <a href="{{ route('admin.holiday.index') }}" class="btn btn-light"><i class="ik arrow-left ik-arrow-left"></i> Go Back</a>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
 
@endsection