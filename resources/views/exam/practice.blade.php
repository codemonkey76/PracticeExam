@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10">
        <h3>{{ $exam->exam_name }}</h3>
        <form method="POST" action="results">
            {{ csrf_field() }}
            <?php
                $index = 1;
                $letters = range("a", "z");
                foreach ($exam->questions()->get() as $question)
                {
                    echo "<p>";
                    echo sprintf("<p>Q%s. %s</p>",
                                 $index,
                                 $question->questionText);
                    echo "<ul>";
                    $results = null;
                    if ($signedIn)
                    {
                        $results = App\Results::where('user_id', '=', Auth::user()->id)
                        ->where('question_id','=',$question->id)->first();
                    }
                    if ($question->options()->count()==0)
                    {
                        $output = "<textarea style=\"width: 500px; height: 140px\" name=\"$question->id\" rows=\"5\">";
                        if ($results != null)
                            $output = $output . $results->model_text;
                        $output = $output . "</textarea>";
                        //var_dump($question->model_text);

                        if ($results != null)
                            if ($results->model_text != null)
                                $output = $output . "<p style=\"color: green\" >Model Text: $question->model_text</p>";
                        echo $output;
                    }
                    else
                    {
                        $index2 = 0;
                        foreach ($question->options()->get() as $option)
                        {
                            if ($results==null)
                            {
                                $output = sprintf("%s) <input type=\"radio\" name=\"%s\" value=\"%s\" > %s<br>",
                                         $letters[$index2],
                                         $option->question_id,
                                         $option->id,
                                         $option->option_text);
                            }
                            else
                            {
                                $sql = "select question_id, FLOOR(coalesce(count(case when option_id = $option->id then 1 end)/count(*), 0) * 100) Percentage FROM results GROUP BY question_id HAVING question_id = $option->question_id";
                                $res = DB::select($sql);
                                $output = sprintf("(%03s%%) %s) <input type=\"radio\" name=\"%s\" value=\"%s\" %s> %s<br>",
                                         $res[0]->Percentage,
                                         $letters[$index2],
                                         $option->question_id,
                                         $option->id,
                                         ($results->option_id==$option->id)?"checked":"",
                                         $option->option_text);
                                
                            
                                        if ($results->option_id==$option->id)
                                        {
                                            if ($results->option_id==$question->option_id)
                                                $output = $output . "<br><p style=\"color: green\">&#10004; $option->option_text</p>";
                                            else
                                                $output = $output . "<br><p style=\"color: red\">&#10008; $option->option_text</p>";
                                        }
                                        else
                                        {
                                            if ($option->id==$question->option_id)
                                                $output = $output . "<br><p style=\"color: green\">&#10004; $option->option_text</p>";
                                        }
                            
                                        
                            }
                            echo $output;
                            $index2 += 1;
                        }
                    }
                        echo "</ul>";
                        $index += 1;
                        echo "</p>";
                }

            ?>
            <div clas="form-group">
                    <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>
@stop