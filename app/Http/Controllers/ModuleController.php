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
        phpinfo();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            $data = Question::select('q_id','answer')->get();

            $count = Question::count();

            return json_encode(array('data' => $data,'count' => $count));

        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }

    }

    public function answer(Request $request){

        try {

            $answer = DB::table('questions')->where('q_id', $request->id)->first();
 
            return $answer->correct_answer;

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
