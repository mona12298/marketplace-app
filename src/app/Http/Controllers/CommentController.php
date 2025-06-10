<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

use App\Models\User;
use App\Models\ItemListing;
use App\Models\Comment;


class CommentController extends Controller
{
    public function comment(CommentRequest $request, $item_id){
        $user = Auth::user();
        Comment::create([
            'user_id' => $user->id,
            'item_listing_id' => $item_id,
            'content' => $request->input('content'),
        ]);
        return redirect()->back();
    }
}
