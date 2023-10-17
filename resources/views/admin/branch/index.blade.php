
<!-- ========================= Index Branch page  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Company Master')

@push('css')<!-- css here include datatable css file  -->
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
            <div class="col-6">
                <h4>All Branches</h4>
            </div>
            <div class="col-6 text-right">
                <a href="{{route('admin.branch.add')}}" class="btn btn-primary">Add New Branch</a>
            </div>
        </div>
    </div><!-- card-header end  -->

    <div class="card-body">
        <table id="table_id" class="display"><!-- datatable start  -->
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Branch Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                 <!-- ========================= For each loop for branch info from the branches table ========================= -->
                @foreach($branches as $key => $branch)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$branch->branch_name}}</td>
                    <td>{{$branch->branch_address}}</td>
                    <td>{{$branch->branch_phone}}</td>
                    <td>{{$branch->branch_email}}</td>

                    <!-- edit and delete here -->
                    <td>
                        <a href="{{route('admin.branch.edit', $branch->id)}}" class="btn btn-outline-primary btn-sm"><i
                                class="fas fa-edit"></i></a>
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$branch->id}}').submit();" class="btn btn-outline-danger btn-sm mx-2"><i
                                class="fas fa-trash"></i></a>

                        <form action="{{route('admin.branch.delete', $branch->id)}}" syle="display: none;" method="post"
                            id="delete-form-{{$branch->id}}">
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

<!-- js here include datatable js file  -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush