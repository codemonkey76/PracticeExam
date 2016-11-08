@if ($signedIn)
    <div class="col-md-6">

        <h2>Your Exams</h2>
        <select size="10" style="width: 100%">
            @foreach ($exams as $exam)
                @if ($exam->user_id==$user->id)
                    <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                @endif
            @endforeach
        </select>

        <br><br>

        <div class="col-md-2">
        <p>
            <a class="btn btn-lg btn-primary" href="exam" role="button">View Results</a>
        </p>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-2">
        <p>
            <a class="btn btn-lg btn-primary" href="exam/create" role="button">Create New Exam</a></p>
        </div>
    </div>
@endif
