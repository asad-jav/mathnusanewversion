@extends('layouts.admin')
@section('title', 'Quizizz Report') 
@section('content')

<div class="app-content content pt-2 pb-2">
    <div class="col-12">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
        @if (Session::has('failure'))
        <div class="alert alert-danger">
            {{ Session::get('failure') }}
        </div>
        @endif
        <h1>Quizizz Report</h1>
        <div class="card">
            <div id="invoice-template" class="card-body">
                <!-- Invoice Company Details -->
                <div id="invoice-print">
                    <div id="invoice-company-details" class="row">
                        <div class="col-md-6 col-sm-12 text-left text-md-left">
                            <img src="{{asset('public/app-assets/images/logo/t-logo.png')}}" alt="company logo" class="mb-2" width="70">
                            <ul class="px-0 list-unstyled">
                                <li class="text-bold-700">Title: {{$quiz->title}}</li>
                                <li>Course: {{$quiz->course->title}}</li>
                            </ul>

                        </div>
                        <div class="col-md-6 col-sm-12 text-center text-md-right">

                        </div>
                    </div>
                    <!-- Invoice Items Details -->
                    <div id="invoice-items-details" class="pt-2">
                        <div class="row">
                            <div class="table-responsive col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th  class="text-center">Total Questions</th>
                                            <th  class="text-center">Total Question Marks</th>
                                            <th  class="text-center">My Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td class="text-center"> {{count($questions) ?? 0}} </td>
                                            <td class="text-center"> {{$questions->sum('points') ?? 0}} </td>
                                            <td class="text-center">{{$studentQuiz->score ?? 0}} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
                <!-- Invoice Footer -->
                <div id="invoice-footer">
                    <div class="row">
                        <div class="col-md-7 col-sm-12">
                            
                        </div>
                        <div class="col-md-5 col-sm-12 text-center">
                            <button type="button"  onclick="printDiv('invoice-print')"class="btn btn-info btn-lg my-1" style="float: right;"><i class="ft-printer"></i> Print</button>
                        </div>
                    </div>
                </div>
                <!--/ Invoice Footer -->

            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection