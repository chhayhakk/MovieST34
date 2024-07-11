<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Reviews;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    //
    public function index(Request $request)
    {
        $movies = Movies::all();
        return view('auth.guest', compact('movies'));
        
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
            'select' => 'required|integer|min:1|max:10',
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
        // Calculate average rating and total number of reviews


        $avg_rate = $reviews->avg('rate') ?? 0; // Default to 0 if no reviews found
        $total_reviews = $reviews->count();
        return view('auth.detail', compact('movie', 'reviews', 'avg_rate', 'total_reviews'));
}
    

    

    /**
     * Show the form for creating a new resource.
     */
    
    public function detail($movie_id)
    {
        //Fetch current movie
        $movie = Movies::findOrFail($movie_id);
        $reviews = Reviews::where('movie_id', $movie_id)->get();

        $avg_rate = $reviews->avg('rate') ?? 0; // Default to 0 if no reviews found
        $total_reviews = $reviews->count();
        return view('auth.detail', compact('movie', 'reviews', 'avg_rate', 'total_reviews'));
    }

}
