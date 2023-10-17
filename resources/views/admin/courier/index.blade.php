
<!-- ========================= Index courier page, from admin end  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Our Couriers')

<!-- css here including datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')<!-- content start  -->

<!-- Alert here -->
<div class="col-12">
    @include('admin.alert')
</div>

<div class="col-12">

    <div class="card-header">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('admin.courier.add')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                    Add New
                    Courier</a>
            </div>
        </div>
    </div><!-- card-header end  -->

    <div class="card-body">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Branch</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Vehicle</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                 <!-- ========================= For each loop for couriers info from the courier_model table ========================= -->
                @foreach($couriers as $key => $courier)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td class="px-2">{{$courier->branch_id}}</td>
                    <td>{{$courier->name}}</td>
                    <td class="px-0">{{$courier->address}}</td>
                    <td>{{$courier->phone}}</td>
                    <td class="px-0">{{$courier->email}}</td>
                    <td>{{$courier->gender}}</td>
                    <td>{{$courier->vehicle}}</td>
                    <td> <img width="80" src="/courierimage/{{$courier->image}}" alt="">
                    </td>
                    <td class="px-3">
                        
                        <!-- edit and delete here -->
                        <a href="{{route('admin.courier.edit', $courier->id)}}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>

                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$courier->user_id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                        <form action="{{route('admin.courier.delete', $courier->user_id)}}" syle="display: none;"
                            method="post" id="delete-form-{{$courier->user_id}}">
                            @csrf
                            @method('DELETE')
                        </form>

                        @if($courier->role_id == '2')<!-- if courier role_id is 2, show this ready for suspension update -->
                        <div>
                            <form action="{{route('admin.suspend-courier',$courier->user_id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="role_id" value="3">
                                <button type="submit" class="btn btn-outline-warning my-3 btn-sm">Suspend</button>
                            </form>
                        </div>
                        @else<!-- otherwise, show this ready for suspension update -->

                        <div>
                            <form action="{{route('admin.suspend-courier',$courier->user_id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="role_id" value="2">
                                <button type="submit" class="btn btn-outline-danger my-3 btn-sm">Unsuspend</button>
                            </form>
                        </div>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table><!-- datatable end  -->
    </div><!-- card-body end  -->
</div><!-- col-12 end -->



@stop
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush