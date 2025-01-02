<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Models\Question;
use App\Models\Member;
use App\Models\Question;
use App\Models\Verb;
use App\Models\QuestionBk; 
use App\Models\VerbBk; 




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

     public function TestClass(Request $request){

        return 'TestClass is working';
     }

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

          $data = Question::select('q_id','answer','question')
          ->where('verse_no', 'LIKE', $request->id . ':%')
          ->orderBy('q_id','asc')
          ->get();
      
          $count = Question::where('verse_no','LIKE', $request->id.':%')->count();

 
          return json_encode(array('data' => $data,'count' => $count));

        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

     public function renderQuestion(Request $request)
    {

     
        try {

     

            // Cast $request->id to a string to avoid unexpected errors
            $requestId = (string) $request->id;

            // Check if $request->id is provided and not empty
            if (empty($requestId)) {
              return json_encode(['error' => 'Invalid ID provided']);
            }

            // Retrieve the data
            $data = verb::select('q_id', 'answer', 'question')
            ->where('verb_no', 'LIKE', $requestId . ':%')
            ->orderBy('q_id', 'asc')
            ->get();

            // Count the results
            $count = verb::where('verb_no', 'LIKE', $requestId . ':%')->count();

            // Encode to JSON, converting $data to an array if necessary
            return json_encode(['data' => $data->toArray(), 'count' => $count]);

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

    public function verbAnswer(Request $request){

        return $request; 

        try {

            $answer = Verb::select('correct_answer')->where('verb_no',$request->id)->orderBy('verb_no','asc')->first();

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


    public function listQuizNo(Request $request){

        try {


        $verb_names = Verb::select('question')->where('verb_no', 'like', '%:1:1')
        ->orderBy('verb_no', 'asc')
        ->pluck('question'); // pluck function transform object into array format

        $quiz_tense = Verb::orderBy('title', 'desc')->distinct()->pluck('title');

        $title = Verb::select('verb_no', 'question')
        ->orderBy('verb_no', 'asc')->first()->question;

        $quiz_no = Verb::orderBy('verb_no', 'desc')->distinct()->pluck('verb_no');

        //pluck function provide answer in array format rather than object format
        
  
        $filteredValues = collect($quiz_no)->map(function ($value) {
        $parts = explode(':', $value);

        $cleanedValue = str_replace(['\"', '"', '\\'], '', $parts[0]);

        return $cleanedValue;
        
        })->unique()->sort();



    return json_encode(['verb_id' => $filteredValues->values(), 'tense' => $quiz_tense, 'title' => $verb_names, ]);

        } catch (\Exception $e){
           die("Error" + $e);
        }
    }

    
    public function verbDropdown(Request $request){

    $chapter_data =   Verb::select('category', 'verb_no')
    ->where('category', 'like', "%verb%")
    ->orderBy('verb_no','asc')
    ->get() // Get the collection
    ->toArray(); // Convert it to an array


    $response_no = ['no' => array_map(function ($item) {
        return explode(':', $item)[0]; // Split by ':' and take the first part
    }, array_column($chapter_data, 'verb_no'))
    ];


    // Transform the data to the desired structure
    $response_cat = ['cat' => array_column($chapter_data, 'category'), // Extract 'category'
    ];

    $validated_cat = array_map(function ($remove_surah) {
    // Split the string by dashes
    $parts = explode('-', $remove_surah);

    // Join only the second and third parts if they exist, ignoring anything after the third dash
    return isset($parts[1]) ? $parts[1] . (isset($parts[2]) ? '-' . $parts[2] : '') : '';
    
    }, $response_cat['cat']);



              return json_encode(['chapter' =>  $response_no['no'], 'title' =>  $validated_cat, ]);




    }


    public function verseList(Request $request){

          $chapter_data = Question::select('category', 'verse_no')
    ->where('category', 'like', "%verse%")
    ->get() // Get the collection
    ->toArray(); // Convert it to an array


    $response_no = ['no' => array_map(function ($item) {
        return explode(':', $item)[0]; // Split by ':' and take the first part
    }, array_column($chapter_data, 'verse_no'))
    ];


    // Transform the data to the desired structure
    $response_cat = ['cat' => array_column($chapter_data, 'category'), // Extract 'category'
    ];

    $validated_cat = array_map(function ($remove_surah) {
    // Split the string by dashes
    $parts = explode('-', $remove_surah);

    // Join only the second and third parts if they exist, ignoring anything after the third dash
    return isset($parts[1]) ? $parts[1] . (isset($parts[2]) ? '-' . $parts[2] : '') : '';
    
    }, $response_cat['cat']);

        try {

              return json_encode(['chapter' =>  $response_no['no'], 'title' =>  $validated_cat, ]);

        } catch (\Exception $e){
           die("Error" + $e);
        }


    }

     public function chapterList(Request $request){


    // $chapter_data = Question::select('category', 'verse_no')
    // ->where('category', 'like', "%surah%")
    // ->get() // Get the collection
    // ->toArray(); // Convert it to an array

    $chapter_data = Question::select('category', 'verse_no')
    
    ->where(function ($query) {
        $query->where('category', 'like', '%surah%')
              ->orWhere('category', 'like', '%verse%');
    })
    ->get() // Get the collection
    ->toArray(); // Convert it to an array


    $response_no = ['no' => array_map(function ($item) {
        return explode(':', $item)[0]; // Split by ':' and take the first part
    }, array_column($chapter_data, 'verse_no'))
    ];


    // Transform the data to the desired structure
    $response_cat = ['cat' => array_column($chapter_data, 'category'), // Extract 'category'
    ];

    $validated_cat = array_map(function ($remove_surah) {
    // Split the string by dashes
    $parts = explode('-', $remove_surah);

    // Join only the second and third parts if they exist, ignoring anything after the third dash
    return isset($parts[1]) ? $parts[1] . (isset($parts[2]) ? '-' . $parts[2] : '') : '';
    
    }, $response_cat['cat']);


 

        try {

     
              return json_encode(['chapter' =>  $response_no['no'], 'title' =>  $validated_cat, ]);


        } catch (\Exception $e){
           die("Error" + $e);
        }
    }

    public function chapterTest(Request $request){


        // $chapter_data = Question::select('category', 'verse_no')
        // ->where('category', 'like', "%surah%")
        // ->get() // Get the collection
        // ->toArray(); // Convert it to an array
    
        $chapter_data = Question::select('category', 'verse_no')
        
        ->where(function ($query) {
            $query->where('category', 'like', '%surah%')
                  ->orWhere('category', 'like', '%verse%');
        })
        ->get() // Get the collection
        ->toArray(); // Convert it to an array
    
    
        $response_no = ['no' => array_map(function ($item) {
            return explode(':', $item)[0]; // Split by ':' and take the first part
        }, array_column($chapter_data, 'verse_no'))
        ];
    
    
        // Transform the data to the desired structure
        $response_cat = ['cat' => array_column($chapter_data, 'category'), // Extract 'category'
        ];
    
        $validated_cat = array_map(function ($remove_surah) {
        // Split the string by dashes
        $parts = explode('-', $remove_surah);
    
        // Join only the second and third parts if they exist, ignoring anything after the third dash
        return isset($parts[1]) ? $parts[1] . (isset($parts[2]) ? '-' . $parts[2] : '') : '';
        
        }, $response_cat['cat']);
    
    
     
    
            try {
    
         
                  return json_encode(['chapter' =>  '123', 'title' =>  $validated_cat, ]);
    
    
            } catch (\Exception $e){
               die("Error" + $e);
            }
        }

    public function loadVerbs(Request $request){

        try {


        $surah_no = Verb::select('verb_no')->where('verb_no','LIKE',$request->id.'%')->orderBy('verb_no','asc')->get();

        $filteredValues = collect($surah_no)->map(function ($value) {
         $parts = explode(':', $value);
         return $parts[2];
        
        })->unique()->sort();

        return $filteredValues->values();

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


        $questionAll = Question::select('q_id','question','verse_no','answer','updated_date','correct_answer')->where('q_id',$maxId)->orderBy('verse_no','asc')->get(); 
        
        return response()->json(['data' => $questionAll]);

        
    }

      public function listLastVerb(){

        $maxId = Verb::max('q_id');


        $questionAll = Verb::select('q_id','question','verb_no','answer','updated_date','correct_answer')->where('q_id',$maxId)->orderBy('verb_no','asc')->get(); 
        
        return response()->json(['data' => $questionAll]);

        
    }

    public function search(Request $request)
    {

        $data = $request->id;

        $questionAll = Question::select('q_id','question','verse_no','answer','correct_answer','category')->where('verse_no','LIKE',$request->id.'%')->orderBy('q_id','asc')->get(); 
       // return response()->json(['data' => $questionAll]);
      /// return json_encode(['data' => $questionAll]);
//         return response()->json([
//     'data' => $questionAll,
// ], 200, ['Content-Type' => 'application/json']);

return response()->json([
    'data' => $questionAll,
], 200, [
    'Access-Control-Allow-Origin' => 'https://create-react-app-nine-rosy-76.vercel.app',
    'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
    'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
]);

    }

     public function searchVerb(Request $request)
    {

        $data = $request->id;

        $questionAll = Verb::select('q_id','question','verb_no','answer','correct_answer','category')->where('verb_no','LIKE',$request->id.'%')->orderBy('q_id','asc')->get(); 
        return response()->json(['data' => $questionAll]);

    }

    public function store(Request $request)
    {


  //  return $request; 

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
         $category = $request->category;

    // Format the array as a string with curly braces
    $formattedArray = '{' . implode(',', array_map(function($item) {
        return '"' . $item . '"';
    }, $arrayData)) . '}';

// Execute the raw SQL query
    $result = DB::statement('INSERT INTO questions (question,verse_no,answer,updated_date,correct_answer,category) VALUES (?,?,?,?,?,?)', [$question,$verse_no,$formattedArray,$date,$correctAnswer,$category]);


    // $question = new QuestionBk(); //
    // $question->q_id = $maxId; 
    // $question->question = $request->word; 
    // $question->verse_no = $verse_no; 
    // $question->answer = $formattedArray; 
    // $question->updated_date = $date; 
    // $question->correct_answer = $correctAnswer; 
    // $question->category = $category; 
    // $question->save();

        return response()->json(['status' => true]);
    }

    

    }

    public function storeVerb(Request $request){


     //  return $request;

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
         $category = $request->category;

    // Format the array as a string with curly braces
    $formattedArray = '{' . implode(',', array_map(function($item) {
        return '"' . $item . '"';
    }, $arrayData)) . '}';

// Execute the raw SQL query
    $result = DB::statement('INSERT INTO verbs (question,verb_no,answer,updated_date,correct_answer,category) VALUES (?,?,?,?,?,?)', [$question,$verse_no,$formattedArray,$date,$correctAnswer,$category]);

  
    // $question = new VerbBk();
    // // $question->q_id = $maxId; 
    // $question->question = $request->word; 
    // $question->verb_no = $verse_no; 
    // $question->answer = $formattedArray; 
    // $question->updated_date = $date; 
    // $question->correct_answer = $correctAnswer; 
    // $question->category = $category; 
    // $question->save();

     ///  return $question; 

      return  $result; 

     //   return response()->json(['status' => true]);
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
       
          //  return $request;

            $qId = $request->qId; 
           
            $arrayData = [$request->answer1,$request->answer2,$request->answer3,$request->answer4];
    
             $question =  $request->question;
            // $date = $request->date;
             $verseNo = $request->verseNo; 
             $correctAnswer = $request->correctAnswer; 
             $category = $request->category;
    
        // Format the array as a string with curly braces
        $formattedArray = '{' . implode(',', array_map(function($item) {
            return '"' . $item . '"';
        }, $arrayData)) . '}';
    
    // Execute the raw SQL query
            $result = DB::update('UPDATE questions SET question = ?, verse_no = ?, answer = ?,correct_answer = ?,category = ? WHERE q_id = ?', [$question, $verseNo, $formattedArray,$correctAnswer,$category,$qId]);
            
            // $result = QuestionBk::where('q_id', $qId)
            // ->update([
            // 'question' => $request->question,
            // 'verse_no' => $verseNo,
            // 'answer' => $formattedArray,
            // 'correct_answer' => $correctAnswer,
            // 'category' => $category, 
            // ]);
            
            return response()->json(['status' => true]);
       
    }



    public function updateVerb(Request $request)
    {



      //  return $request;

            $qId = $request->qId; 


            $arrayData = [$request->answer1,$request->answer2,$request->answer3,$request->answer4];
    
             $question =  $request->question;
      
             $verbNo = $request->verseNo; 
             $correctAnswer = $request->correctAnswer; 
             $category = $request->category;
    
        // Format the array as a string with curly braces
        $formattedArray = '{' . implode(',', array_map(function($item) {
            return '"' . $item . '"';
        }, $arrayData)) . '}';
    
            // Execute the raw SQL query
            $result = DB::update('UPDATE verbs SET question = ?, verb_no = ?, answer = ?,correct_answer = ?,category = ? WHERE q_id = ?', [$question, $verbNo, $formattedArray,$correctAnswer,$category,$qId]);
            
            // $result = VerbBk::where('q_id', $qId)
            // ->update([
            // 'question' => $request->question,
            // 'verb_no' => $verbNo,
            // 'answer' => $formattedArray,
            // 'correct_answer' => $correctAnswer,
            // 'category' => $category,
            // ]);
            
            return response()->json(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
