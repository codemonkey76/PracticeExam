<div class="col-md-6">
    <h2>All Exams</h2>
    
    <form method="POST" action="/PracticeExam">
        {{ csrf_field() }}
        <select name="exams" size="10" style="width: 100%">
            @foreach ($exams as $exam)
                <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
            @endforeach
        </select>
       
        <br><br>
        
        @if (!$signedIn)
        You are not logged in, your results will not be saved.
        @endif

        <p>
            <div clas="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Sit Practice Test
                    </button>
            </div>
        </p>
    </form>
</div>
