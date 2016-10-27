@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h3>{{ $exam->exam_name }}</h3>
            <form method="POST" action="answers">
                {{ csrf_field() }}
                <?php
                    $index = 1;
                    $letters = range("a", "z");
                    foreach ($exam->questions()->get()->shuffle() as $question)
                    {
                        echo sprintf("<li>Q%s. %s</li>",
                                     $index,
                                     $question->questionText);
                        echo "<ul>";

                        $index2 = 0;
                        
                        if ($question->options()->get()->count()==0)
                        {
                            echo sprintf("<input type=\"text\" lines=\"5\" name=\"%s\"></input>", $question->id);
                        }
                        else
                        {
                            foreach ($question->options()->get()->shuffle() as $option)
                            {
                                // dd($option);
                                echo sprintf("%s) <input type=\"radio\" name=\"%s\" value=\"%s\"> %s<br>",
                                             $letters[$index2],
                                             $option->question_id,
                                             $option->id,
                                             $option->option_text);
                                $index2 += 1;
                            }
                        }
                        echo "</ul>";
                        $index += 1;
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