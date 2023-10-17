
<!-- ========================= Sent messages from users and courier view page  ========================= -->

@extends('admin.layouts.master')<!-- include master file from layout folder  -->
@section('title', 'Recieved Messages')

<!-- css here include datatable css file  -->
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
@endpush

@section('content')<!-- content start  -->

<div class="col-12">
    <div class="card-body">
        <table id="table_id" class="display"><!-- datatable start  -->
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Seen</th>
                    <th scope="col">Del</th>
            </thead>
            <tbody>

             <!-- ========================= For each loop for sent messages info fetching from the messages table ========================= -->
                @foreach($messages as $message)
                <tr>
                    <th data-label="Id" style="border: 1px solid #add; ">{{$message->name}}</th>
                    <td style="border: 1px solid #add; ">
                        {{$message->email}}</td>
                    <td style="border: 1px solid #add; ">
                        {{$message->subject}}</td>
                    <td style="border: 1px solid #add; ">
                        {{$message->comment}}</td>

                        <!-- updating from unread to read -->
                    <form action="{{route('admin.read-messages',$message->id )}}" method="post">
                        @csrf
                        <input type="hidden" name="read" value="0">

                        @if($message->unread == '0')<!-- if column unread is 0, display this as unchecked -->
                        <td> <button class="btn btn-outline-primary btn-sm"></button> </td>

                        @else<!-- otherwise, display this as checked as default -->
                        <td> <button class="btn btn-primary btn-sm"></button> </td>
                        @endif

                        <!-- delete message here -->
                    </form>
                    <td style="border: 1px solid #add;">
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$message->id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a>
                        <form action="{{route('admin.message.delete', $message->id)}}" syle="display: none;"
                            method="post" id="delete-form-{{$message->id}}">
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
@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();
});
</script>
@endpush