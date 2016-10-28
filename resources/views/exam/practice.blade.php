@extends('layouts.app')

@section('content')
<div class="container">
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
                        $results = App\Results::where('user_id', '=', Auth::user()->id)
                            ->where('question_id','=',$question->id)->first();
                        if ($question->options()->count()==0)
                        {
                            echo "<textarea style=\"width: 500px\" name=\"$question->id\" rows=\"5\">";
                            echo ($results!=null)?$results->model_text:"";
                            echo "</textarea>";
                        }
                        else
                        {
                            $index2 = 0;
                            foreach ($question->options()->get() as $option)
                            {
                                //dd($results->option_id);
                                //var_dump($option);
                                //dd($results);
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
                                    $output = sprintf("%s) <input type=\"radio\" name=\"%s\" value=\"%s\" %s> %s<br>",
                                             $letters[$index2],
                                             $option->question_id,
                                             $option->id,
                                             ($results->option_id==$option->id)?"checked":"",
                                             $option->option_text);
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
</div>
@stop