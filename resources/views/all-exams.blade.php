<div class="col-md-6">
    <h2>All Exams</h2>
    
    
    <select size="10" style="width: 100%">
        @foreach ($exams as $exam)
            <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
        @endforeach
    </select>
   
    
    <br><br>
    
    @if (!$signedIn)
    You are not logged in, your results will not be saved.
    @endif

    <p>
        <a class="btn btn-lg btn-primary" href="exam" role="button">Sit Practice Test</a>
    </p>
</div>
