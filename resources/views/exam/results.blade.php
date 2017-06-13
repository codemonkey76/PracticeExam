@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h3>{{ $exam->exam_name }}</h3>
            <form method="POST" action="results">
                {{ csrf_field() }}
                <?php
                    $correct = 0;
                    $incorrect = 0;
                    $unanswered = 0;
                    $index = 1;
                    $letters = range("a", "z");
                    foreach ($exam->questions()->get() as $question)
                    {

                        echo "<p>";
                        echo sprintf("<p>Q%s. %s</p>",
                                     $index,
                                     $question->questionText);
                        echo "<ul>";
                        
                        if ($question->options()->count()==0)
                        {
                            $output = "<textarea style=\"width: 500px; height: 140px\" name=\"$question->id\" rows=\"5\">";
                            if ($results != null)
                                if ($results[$question->id]!=null)
                                    $output = $output . $results[$question->id]->model_text;
                            $output = $output . "</textarea>";
                            if ($results != null)
                                if ($results[$question->id]->model_text != null)
                                    $output = $output . "<p style=\"color: green\" >Model Text: $question->model_text</p>";
                            echo $output;
                        }
                        else
                        {
                            $index2 = 0;
                            foreach ($question->options()->get() as $option)
                            {
                                if ($results==null || !array_key_exists($question->id, $results))
                                {
                                    $output = sprintf("%s) <input type=\"radio\" name=\"%s\" value=\"%s\" > %s<br>",
                                             $letters[$index2],
                                             $option->question_id,
                                             $option->id,
                                             $option->option_text);
                                }
                                else
                                {
                                    if ($results[$question->id]->option_id==null)
                                        $unanswered += 1;
                                    $sql = "select question_id, FLOOR(coalesce(count(case when option_id = $option->id then 1 end)/count(*), 0) * 100) Percentage FROM results GROUP BY question_id HAVING question_id = $option->question_id";
                                    $res = DB::select($sql);
                                    $output = sprintf("(%03s%%) %s) <input type=\"radio\" name=\"%s\" value=\"%s\" %s> %s<br>",
                                             $res[0]->Percentage,
                                             $letters[$index2],
                                             $option->question_id,
                                             $option->id,
                                             ($results[$question->id]->option_id==$option->id)?"checked":"",
                                             $option->option_text);
                                    
                                
                                            if ($results[$question->id]->option_id==$option->id)
                                            {
                                                if ($results[$question->id]->option_id==$question->option_id)
                                                {
                                                        $output = $output . "<br><p style=\"color: green\">&#10004; $option->option_text</p>";
                                                        $correct += 1;
                                                }
                                                else
                                                {
                                                    $output = $output . "<br><p style=\"color: red\">&#10008; $option->option_text</p>";
                                                    $incorrect += 1;
                                                }
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
                <div class="wrapper">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Practice Test Summary</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Correct</th>
                                            <th>Incorrect</th>
                                            <th>Unanswered</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>{{ $correct }}</td>
                                        <td>{{ $incorrect }}</td>
                                        <td>{{ $unanswered }}</td>
                                        <td><?php
                                         if (($correct+$incorrect+$unanswered)>0)
                                            round(($correct / ($correct+$incorrect+$unanswered))*100).'%'
                                        ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div clas="form-group">
                        <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop