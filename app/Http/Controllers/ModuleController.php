<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Question;
use App\Models\Member;
use App\Models\Question;
use App\Models\QuestionBk; 



class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
       //   phpinfo();

       $data = QuestionBk::get();

       return $data;

        //  $data = Question::where('verse_no','1:1:1')->get();

        //  return $data;

// $host = 'ep-ancient-hat-81967113.us-east-1.aws.neon.tech';
// $port = '5432';
// $db = 'verceldb';
// $user = 'default';
// $password = 'PZceg7UF1MpN';
// $endpoint = 'ep-ancient-hat-81967113';

// $connection_string = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $user . " password=" . $password . " options='endpoint=" . $endpoint . "' sslmode=require";

// $dbconn = pg_connect($connection_string);

// if (!$dbconn) {
//     die("Connection failed: " . pg_last_error());
// }
// echo "Connected successfully";

    }

    /**
     * Show the form for creating a new resource.
     */

     public function specQuiz(Request $request)
     {


        try {

            $separatedAnswers = [];

            $new = [];

            //   $data = Question::select('q_id','answer','question')->where('verse_no', 'LIKE', $request->id . ':%')->orderBy('q_id','asc')->get();
          
                $data = Question::select('q_id','answer','question')->where('verse_no', 'LIKE','1:1:1%')->orderBy('q_id','asc')->get();
    
                $count = Question::where('verse_no','LIKE', $request->id.':%')->count();
    
            //    return $data; 
    
                $dataArray = json_decode($data, true);
    
        
    
            foreach ($dataArray as $item) {
            
            // Remove curly braces from the answer string
             $cleanedAnswer = str_replace(['{', '}'], '', $item['answer']);

             $question = $item['question'];
        
            // Split the answers by commas
            $answersArray = explode(',', $cleanedAnswer);
            $answersQues = explode(',', $question);
            // Store separated answers in a new array
            $separatedAnswers[] = $answersArray;
            $separatedQues[] = $answersQues;
            }

            return json_encode(array('data' => $data, 'questions'=>$separatedQues, 'answers'=>$separatedAnswers,'count' => $count));
    
            } catch (\Exception $e) {
                die("Could not connect to the database.  Please check your configuration. error:" . $e );
            }

    }  


     public function quizInfo(Request $request)
     {


        try {

            $separatedAnswers = [];

            $new = [];

            //   $data = Question::select('q_id','answer','question')->where('verse_no', 'LIKE', $request->id . ':%')->orderBy('q_id','asc')->get();
          
                $data = Question::select('q_id','answer','question')->where('verse_no', 'LIKE','1:1:%')->orderBy('q_id','asc')->get();
    
                $count = Question::where('verse_no','LIKE', $request->id.':%')->count();
    
            //    return $data; 
    
                $dataArray = json_decode($data, true);
    
        
    
            foreach ($dataArray as $item) {
            
            // Remove curly braces from the answer string
             $cleanedAnswer = str_replace(['{', '}'], '', $item['answer']);

             $question = $item['question'];
        
            // Split the answers by commas
            $answersArray = explode(',', $cleanedAnswer);
            $answersQues = explode(',', $question);
            // Store separated answers in a new array
            $separatedAnswers[] = $answersArray;
            $separatedQues[] = $answersQues;
            }

            return json_encode(array('data' => $data, 'questions'=>$separatedQues, 'answers'=>$separatedAnswers,'count' => $count));
    
            } catch (\Exception $e) {
                die("Could not connect to the database.  Please check your configuration. error:" . $e );
            }

    }  

    public function create(Request $request)
    {

     
        try {

          $data = Question::select('q_id','answer','question')->where('verse_no', 'LIKE', $request->id . ':%')->orderBy('q_id','asc')->get();
      
          $count = Question::where('verse_no','LIKE', $request->id.':%')->count();

 
          return json_encode(array('data' => $data,'count' => $count));

        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

    public function answer(Request $request){

        try {

            $answer = Question::select('correct_answer')->where('verse_no',$request->id)->orderBy('verse_no','asc')->first();

            return $answer->correct_answer;

        } catch (\Exception $e){
           die("Error" + $e);
        }
    }

    public function words(Request $request){

        return 'success';
    }

    public function verses(Request $request){

        try {

        $surah_no = Question::select('verse_no')->where('verse_no','LIKE',$request->id.'%')->orderBy('verse_no','asc')->get();

        $filteredValues = collect($surah_no)->map(function ($value) {
        $parts = explode(':', $value);
        return $parts[2];
        
        })->unique()->sort();

        return $filteredValues->values();
       // return sort($filteredValues->values());

        } catch (\Exception $e){
           die("Error" + $e);
        }
    }



    /**
     * Store a newly created resource in storage.
     */

    public function listSurah(){

        $questionAll = Question::select('verse_no')->where('verse_no','LIKE',$request->id.'%')->orderBy('verse_no','asc')->get(); 
        return response()->json(['data' => $questionAll]);
    }

    public function listLastVerse(){

        $maxId = Question::max('q_id');

//echo $maxId;

        // $questionAll = Question::select('q_id','question','verse_no')->where('verse_no','LIKE','89%')->orderBy('verse_no','desc')->first(); 
        // return response()->json(['data' => $questionAll]);

        $questionAll = Question::select('q_id','question','verse_no','answer','updated_date','correct_answer')->where('q_id',$maxId)->orderBy('verse_no','asc')->get(); 
        return response()->json(['data' => $questionAll]);

        
    }

    public function searchWord(Request $request)
    {
      //  return $request;

        $data = $request->id;

        $questionAll = Question::select('q_id','question','verse_no','answer','correct_answer')->where('verse_no','LIKE',$request->id.'%')->orderBy('q_id','asc')->get(); 
        return response()->json(['data' => $questionAll]);

      //  return $questionAll;

       // $texts = Answer::pluck('text');

    }

    public function store(Request $request)
    {
       $maxId = Question::max('q_id') + 1;

    if (request('answer1') == null || request('answer2') == null  || request('answer3') == null  || request('answer4') == null ) {
        
        return response()->json(['status' => false]);
    
        } else {
       
        $arrayData = [$request->answer1,$request->answer2,$request->answer3,$request->answer4];

         $qid = $request->qId; 
         $question =  $request->word;
         $date = $request->date;
         $verse_no = $request->verseNo;
         $correctAnswer = $request->correctAnswer; 

    // Format the array as a string with curly braces
    $formattedArray = '{' . implode(',', array_map(function($item) {
        return '"' . $item . '"';
    }, $arrayData)) . '}';

// Execute the raw SQL query
    $result = DB::statement('INSERT INTO questions (question,verse_no,answer,updated_date,correct_answer) VALUES (?,?,?,?,?)', [$question,$verse_no,$formattedArray,$date,$correctAnswer]);

    $question = new QuestionBk();
    $question->q_id = $maxId; 
    $question->question = $request->word; 
    $question->verse_no = $verse_no; 
    $question->answer = $formattedArray; 
    $question->updated_date = $date; 
    $question->correct_answer = $correctAnswer; 
    $question->save();

        return response()->json(['status' => true]);
    }

    

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // if (request('answer1') == null || request('answer2') == null  || request('answer3') == null  || request('answer4') == null ) {
        
        //     return response()->json(['status' => false]);
        
        //     } else {

          //  return $request;

            $qId = $request->qId; 

           // return $qId;
           
            $arrayData = [$request->answer1,$request->answer2,$request->answer3,$request->answer4];
    
             $question =  $request->question;
            // $date = $request->date;
             $verseNo = $request->verseNo; 
             $correctAnswer = $request->correctAnswer; 
    
        // Format the array as a string with curly braces
        $formattedArray = '{' . implode(',', array_map(function($item) {
            return '"' . $item . '"';
        }, $arrayData)) . '}';
    
    // Execute the raw SQL query
            $result = DB::update('UPDATE questions SET question = ?, verse_no = ?, answer = ?,correct_answer = ? WHERE q_id = ?', [$question, $verseNo, $formattedArray,$correctAnswer,$qId]);
            
            $result = QuestionBk::where('q_id', $qId)
            ->update([
            'question' => $request->question,
            'verse_no' => $verseNo,
            'answer' => $formattedArray,
            'correct_answer' => $correctAnswer,
            ]);
            
            return response()->json(['status' => true]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
