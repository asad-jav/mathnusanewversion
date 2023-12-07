@extends('layouts.admin')
@section('title', 'All standards')
@section('content')

<div class="app-content content pt-2 pb-2 p-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All standards
                        <a href="{{route('standards.create')}}" class="btn btn-primary"><i class="ft-plus"></i> Add New Standard</a>
                    </h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if (Session::has('failure'))
                        <div class="alert alert-danger">
                            {{Session::get('failure')}}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-border table-hover">
                                <thead>
                                    <tr>
                                        <th>Grade Name</th>
                                        <th>Parnet Standard</th>
                                        <th>Title</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($standards as $key => $standard)
                                    <tr>
                                        <td>{{$standard->grade->name ?? ''}}</td>
                                        <td>{{$standard->standard->title ?? ''}}</td>
                                        <td data-toggle="modal" data-target="#opentitle{{$standard->id}}" class="hover-title">
                                            {{$standard->title ?? ''}}
                                        </td>
                                        <td>{{$standard->created_at->format('d-m-Y')}}</td>
                                        <td>

                                            <div class="form-group">
                                                <a href="{{route('standards.edit',$standard->id)}}">Edit</a> |
                                                <a href="javascript:void(0)" class="delete-standard" data-id="{{ $standard->id }}">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <div class="modal fade" id="opentitle{{$standard->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modelHeading"></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $standard->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.hover-title').hover(
            function() {
                var modalId = $(this).data('target');
                $(modalId).modal('show');
            },
            function() {
                var modalId = $(this).data('target');
                $(modalId).modal('hide');
            }
        );
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $(".delete-standard").click(function() {
            const gradeId = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this standard!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, send an AJAX request to delete the grade
                    $.ajax({
                        url: "{{ route('standards.destroy', ':id') }}".replace(':id', gradeId),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the response, e.g., remove the grade row from the table
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The standard has been deleted.',
                                    'success'
                                );
                                window.location.reload();
                                // Reload or update the grade list as needed
                                // Example: location.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the standard.',
                                    'error'
                                );
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
    });
</script>

@endsection