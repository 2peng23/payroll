@extends('admin.layout.app')

@section('title') holiday @endsection

@section('css')
<style type="text/css">
    .overflow-visible{
        overflow: visible !important;
    }
    td.p-0 img.img-thumbnail{
      width: 140px;
    }
    button.h-33{
      height: 33px !important;
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
          <h5>Holidays</h5>
          <span>You can show and manage Holidays from here.</span>
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
          <li class="breadcrumb-item active" aria-current="page">List of Holidays</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 mt-4">
      <div class="card-body table-responsive p-0">
        <table id="state_data_table" class="table mb-0 table-hover">
          <thead>
            <tr>
              <th width="2" class="text-center">No.</th>
              <th width="35" class="text-center">Name</th>
              <th width="35" class="text-center">Description</th>
              <th width="5">Actions</th>
               
            </tr>
          </thead>
          <tbody>
            @foreach($holidays as $holiday)
            <tr>
              <td class="text-center">
                {{ ($loop->index + 1) }}
              </td>
              <td>
                <div class="text-center">
                  <span><b>{{ $holiday->date }}</b></span>
                </div>
              </td><td>
                <div class="text-center">
                  <span><b>{{ $holiday->description }}</b></span>
                </div>
              </td>
              <td>
                  <div class="btn-group btn-sm" role="group" aria-label="Basic example">
                    <a href="{{ route('admin.holiday.edit',['holiday'=>$holiday]) }}" type="button" class="btn btn-sm btn-outline-primary">
                      <i class="ik edit-2 ik-edit-2"></i>
                    </a>
                    <a data-href="{{ route('admin.holiday.destroy',['holiday'=>$holiday]) }}" type="button" class="btn btn-sm btn-outline-danger delete">
                      <i class="ik trash-2 ik-trash-2"></i>
                    </a>
                  </div>
              </td>
              
            </tr>
            @endforeach
          </tbody>
           
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="deleteForm" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" name="submit" class="hidden">
        </form>
    </div>
</div>

<div class="showBannerModel">
 
</div>

@endsection

@section('js') 
@endsection