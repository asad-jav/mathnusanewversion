@extends('layouts.student')
@section('title', 'All Students')
@section('css')
    
@endsection

@section('content')
    <div class="app-content content pt-2 pb-2" style="overflow: scroll;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Students</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            {{-- <a href="{{ url('course/create') }}" class=""> Create Course ></a> --}}
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="w-20">Frist Name</th>
                                        <th class="w-10">Last Name</th>
                                        <th>Email</th>
                                        <th>Grade</th>
                                        <th>Country</th>
                                        <th>Contact</th>
                                        <th>Date of Birth</th>
                                        <th>Gender</th>
                                        <th>Coins</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles[0]->users as $student)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                <a href="{{ url('student/courses/'.$student->id) }}" title="See Lectures">{{ $student->first_name }}</a>
                                            </td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->grade->name ?? ''}}</td>
                                            <td>{{ $student->country }}</td>
                                            <td>{{ $student->contact }}</td>
                                            <td>{{ date('d M Y', strtotime($student->dob)) }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{$student->coins}}</td>
                                            <td style="text-align: right; width:230px">
                                                <div class="form-group">
                                                    <a href="{{ url('student/edit/'.$student->id) }}" class="">Edit </a> |
                                                    <a href="{{ url('student/delete/'.$student->id) }}" class=" confirm">Delete</a>
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
@endsection

@section('script')
    
@endsection