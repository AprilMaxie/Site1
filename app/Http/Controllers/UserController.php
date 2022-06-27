<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
    use ApiResponser;

    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function getUsers(){
        $users = DB::connection('mysql')
        ->select("Select * from tbluser");
    
            return $this->successResponse($users);  
    }

    // shows all data in the database
    public function index(){
        $users = User::all();

            return $this->successResponse($users);
    }

    // adds data to the database
    public function add(Request $request){
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',
            'jobId' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        $userjob = UserJob::findOrFail($request->jobId);
        $user = User::create($request->all());
    }

    // shows a specific data using userID
    public function show($userId){
        $user = User::where('userId', $userId)->first();
        if($user){
            return $this->successResponse($user);
        }

            return $this->errorResponse("User id not found", Response::HTTP_NOT_FOUND);
        }

    
    // updates data in the database using userId
    public function update(Request $request, $userId)  {
        $user = User::findOrFail($userId);
        $user->update($request->all());

            return $this->successResponse($user, Response::HTTP_CREATED);
    }

    // deletes data using userId
    public function delete($userId, Request $request)
    {
        $user = User::findOrFail($userId);
        $user->delete($request->all());

        return $this->successResponse($user, Response::HTTP_OK);
    }

}