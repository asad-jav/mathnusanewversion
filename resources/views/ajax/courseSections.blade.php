
<form action="{{route('admin.instructors.assign.courses')}}" method="post">
    @csrf
    @foreach ($courses as $course)
        <div class="row">
            <div class="col-md-4">
                <label for="">{{$course->title}}</label>
                <input type="hidden" name="courses[]" value="{{ $course->id }}">
                <input type="hidden" name="user_id" value="{{$user_id}}">
            </div>
            <div class="col-md-8">
            @foreach ($course->sections as $section)
                <label for="">{{$section->name}}</label>
                <input type="checkbox" value="{{$section->id}}" name="sections[]" @if($section->users->contains($user_id)) checked @endif>
            @endforeach
            </div>
        </div>
    @endforeach
    <hr>
    <div class="row py-1">
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" class="btn btn-primary"value="Assign">
            </div>
        </div>
    </div>
</form>