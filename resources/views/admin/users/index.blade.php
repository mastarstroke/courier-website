<!-- ========================= Index registered Users Page ========================= -->

@extends('admin.layouts.master')
<!-- include master file from layout folder  -->
@section('title', 'Registered Users')

<!-- Css here including datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')
<!-- content start  -->

<div class="col-12">

    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4>All Users</h4>
            </div>

        </div>
    </div><!-- card-header end  -->

    <div class="card-body">
        <table id="table_id" class="display">
            <!-- Datatable start  -->
            <thead>
                <tr>
                    <th scope="col">Sl.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Country</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Pincode</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- ========================= Fetching info from the users table on the DB ========================= -->
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->city}}</td>
                    <td>{{$admin->state}}</td>
                    <td>{{$admin->country}}</td>
                    <td>{{$admin->phone}}</td>
                    <td>{{$admin->gender}}</td>
                    <td>{{$admin->pincode}}</td>
                    <td><a href="{{route('admin.user.edit', $admin->id)}}" class="btn btn-outline-primary btn-sm"><i
                                class="fas fa-edit"></i></a></td>
                </tr>

                <!-- ========================= For each loop for users info from the users table ========================= -->
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->city}}</td>
                    <td>{{$user->state}}</td>
                    <td>{{$user->country}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->pincode}}</td>
                    <td>
                        <!-- Edit and delete here  -->
                        <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-outline-primary btn-sm"><i
                                class="fas fa-edit"></i></a>

                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$user->id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                        <form action="{{route('admin.user.delete', $user->id)}}" syle="display: none;" method="post"
                            id="delete-form-{{$user->id}}">
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

@stop
<!-- content end  -->


<!-- Js here including datatable js file  -->
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush