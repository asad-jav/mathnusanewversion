@component('mail::message')
# Instructor Invitation

Hi, Mr. {{$user->first_name}} {{$user->last_name}} you have been selected as a instructor in MATHNUSA. Below are the credentials please join us.


{{-- <table class="table table-bordered" cellpadding="20">
    <tr>
        <td colspan="2"><b>Credentials</b></td>
    </tr>
    <tr>
        <td style="width: 50px"><b>Email</b></td>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <td><b>Password &nbsp;&nbsp;&nbsp;</b></td>
        <td>{{$password}}</td>
    </tr>
</table> --}}
<h4 class="lead">Credentials</h4>
<div class="form-group">
    <b>Email</b>
    <p>{{$user->email}}</p>
</div>
<div class="form-group">
    <b>Password</b>
    <p>{{$password}}</p>
</div>

@component('mail::button', ['url' => route('instructor.login')])
Login Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
