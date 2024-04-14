<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Question;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
       //   phpinfo();

         $data = Question::where('verse_no','1:1:1')->get();

         return $data;

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

    public function verses(Request $request){

        try {

        $surah_no = Question::select('verse_no')->where('verse_no','LIKE',"%$request->id%")->orderBy('verse_no','asc')->get();

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
