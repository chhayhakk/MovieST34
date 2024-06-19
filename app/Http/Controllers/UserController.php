<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Reviews;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   

    public function index(Request $request)
    {
        //
        
        $movies = Movies::all();
       
        return view('auth.user', compact('movies'));
        
    }
    public function review(Request $request, $movie_id)
{
    $movie = Movies::findOrFail($movie_id);

    // Verify if the user has already reviewed this movie
    $existingReview = Reviews::where('movie_id', $movie_id)
                             ->where('user_id', Auth::user()->id)
                             ->first();

    if ($existingReview) {
        // Update existing review
        $existingReview->title_review = $request->input('title');
        $existingReview->content = $request->input('review');
        $existingReview->rate = $request->input('select');
        $existingReview->save();
    } else {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'review' => 'required|string',
            'select' => 'required|integer|min:1|max:5',
        ]);

        // Create a new review
        $review = new Reviews();
        $review->title_review = $validatedData['title'];
        $review->content = $validatedData['review'];
        $review->rate = $validatedData['select'];
        $review->user_id = Auth::user()->id;
        $review->movie_id = $movie_id;
        $review->save();
    }

    // Fetch all reviews for the current movie
    $reviews = Reviews::where('movie_id', $movie_id)->get();

    // Return the view with movie and review data
    return view('auth.detail', compact('movie', 'reviews'));
}
    

    

    /**
     * Show the form for creating a new resource.
     */
    
    public function detail($movie_id)
    {
    $movie = Movies::findOrFail($movie_id);
    $reviews = Reviews::where('movie_id', $movie_id)->get();
    return view('auth.detail', compact('movie', 'reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeimage(Request $request)
    {
       
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $imageName = time().'.'.$extension;
            $file->storeAs('public/image', $imageName);
            
            $user = Auth::user();
            DB::table('users')
                ->where('id', $user->id)
                ->update(['profile' => $imageName]);

            // Return the path to the stored file as a complete URL
            $imageUrl = Storage::url('public/image/' . $imageName);
            return response()->json(['path' => $imageUrl]);
        }
        
    
        return response()->json(['error' => 'No file uploaded.'], 400);
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
    public function updateprofile(Request $request, User $user)
    {
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        //     'oldpass' => 'required_with:newpass|min:6',
        //     'newpass' => 'nullable|string|min:6|confirmed',
        // ]);
        // //
        // if($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()->all()], 400);
        // }
        $user = Auth::user();
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => $request->username,
                'email'=>$request->email,
        ]);
       
        return redirect()->route('upload-profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatepassword(Request $request, User $user)
    {

        $user = Auth::user();
        
    
        // Redirect back with errors if validation fails
       
        if ($request->filled('newpass') && $request->filled('confirmpass')) {
            // Validate old password
            $currentPassword = DB::table('users')->where('id', $user->id)->value('password');

            if (!Hash::check($request->oldpass, $currentPassword)) {
                return back()->withErrors(['oldpass' => 'Old password is incorrect.'])->withInput();
    
            }
            else
            {
                if($request->newpass != $request->confirmpass){
                    return back()->withErrors(['confirmpass' => 'New pass and confirm does not.'])->withInput();
                }
                else
                {
                    $newPasswordHash = Hash::make($request->newpass);
    
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => $newPasswordHash]);

                }
                
            }
    
            // Hash and update new password
           
        }
    
        return redirect()->route('upload-profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
