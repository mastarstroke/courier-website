
<!-- ========================= Index service page from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Services')

<!-- Css here including datatable css file -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')<!-- content start  -->

<!-- Alert here  -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="col-12">

    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4>Added Services</h4>
            </div>
            <div class="col-6 text-right">
                <a href="{{route('admin.service.add')}}" class="btn btn-primary">Add New Service</a>
            </div>
        </div>
    </div><!-- card-header end  -->

    <div class="card-body">
        <table id="table_id" class="display"><!-- datatable start  -->
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Modify</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>

             <!-- ========================= For each loop for added services info from the service table ========================= -->
                @foreach($services as $key => $service)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$service->service_name}}</td>
                    <td><small>{{$currency->currency}}</small> {{$service->price}}</td>
                    <td>{{$service->description}}</td>

                    <!-- edit and delete here  -->
                    <td><a href="{{route('admin.service.edit', $service->id)}}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$service->id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                        <form action="{{route('admin.service.delete', $service->id)}}" syle="display: none;"
                            method="post" id="delete-form-{{$service->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- datatable end  -->
    </div><!-- card-body end  -->

</div><!-- col-12 end  -->



@stop<!-- content end  -->

@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush