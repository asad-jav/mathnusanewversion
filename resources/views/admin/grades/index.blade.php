@extends('layouts.admin')
@section('title', 'All Grades')
@section('css')
@endsection
@section('content')

<div class="app-content content pt-2 pb-2" style="overflow: scroll;">
    <div class="col-12">
    <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Grade</h4> 
            </div>
            <div class="card-content collapse show">
                <div class="card-body"> 
                    <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="number">Number:</label>
                                    <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}">
                                    @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">        
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Grades</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collapse show">
                <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table table-border table-hover">
                            <thead>
                                <tr> 
                                    <th class="text-center">Grade Name</th>
                                    <th class="text-center">Grade Number</th>
                                    <th class="text-center">Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($grades as $key => $grade)
                                <tr> 
                                    <td class="text-center">{{$grade->name ?? ''}}</td>
                                    <td class="text-center">{{$grade->number ?? ''}}</td>
                                    <td class="text-center">{{$grade->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        @php 
                                            $url = route('grades.update', $grade->id);
                                            $encodedGrade = json_encode($grade);
                                        @endphp
                                        <div class="form-group"> 
                                            <a href="javascript:void(0)" onclick="UpdateModal('{{$url}}', {{$encodedGrade}})">Edit</a> | 
                                            <a href="javascript:void(0)" class="delete-grade" data-id="{{ $grade->id }}">Delete</a>
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
    </div>
</div>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Modal</h5>
            </div>
            <div class="modal-body"  id="upmodal">

            </div>
        </div>
    </div>
</div>
@endsection 
@section('script')
<script>
    function UpdateModal(url, grade) {
    $("#upmodal").html('<div class="container">\
        <form action="' + url + '" method="POST">\
            @csrf\
            @method("PUT")\
            <div class="form-group">\
                <label for="name">Name:</label>\
                <input type="text" name="name" id="name" class="form-control @error("name") is-invalid @enderror" value="' + grade.name + '" required>\
                @error("name")\
                <div class="invalid-feedback">{{ $message }}</div>\
                @enderror\
            </div>\
            <div class="form-group">\
                <label for="number">Number:</label>\
                <input type="number" name="number" id="number" class="form-control @error("number") is-invalid @enderror" value="' + grade.number + '" required>\
                @error("number")\
                <div class="invalid-feedback">{{ $message }}</div>\
                @enderror\
            </div>\
            <button type="submit" class="btn btn-primary">Update</button>\
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
        </form>\
    </div>');

    $("#updateModal").modal('show');
}

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $(".delete-grade").click(function() {
            const gradeId = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this grade!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, send an AJAX request to delete the grade
                    $.ajax({
                        url: "{{ route('grades.destroy', ':id') }}".replace(':id', gradeId),
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the response, e.g., remove the grade row from the table
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'The grade has been deleted.',
                                    'success'
                                );
                                window.location.reload();
                                // Reload or update the grade list as needed
                                // Example: location.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the grade.',
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