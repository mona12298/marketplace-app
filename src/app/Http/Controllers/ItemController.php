<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\MyPage;
use App\Models\ItemListing;
use App\Models\ItemPurchase;
use App\Models\Image;
use App\Models\Like;
use App\Models\Category;
use App\Models\Comment;

class ItemController extends Controller
{
    public function index(Request $request){
        $tab = $request->query('tab');
        $keyword = $request->input('search');
        $itemListings = collect();
        if ($tab === 'mylist') {
            if (!Auth::check()) {
                return view('index', compact('itemListings', 'tab', 'keyword'));
            }
            $itemListings = Auth::user()
            ->likedListings()
            ->where('item_listings.user_id', '!=', Auth::id())
            ->with(['images'])
            ->withCount('likes')
            ->withCount('comments')
            ->when($keyword, function ($query, $keyword) {
                return $query->KeywordSearch($keyword);
            })
            ->latest()
            ->get();
        } else {
            $query = ItemListing::with(['images'])
            ->withCount('likes')
            ->withCount('comments');
            if (Auth::check()) {
                $query->where('user_id', '!=', Auth::id());
            }
            $itemListings = $query->KeywordSearch($keyword)->latest()->get();
        }
        return view('index', compact('itemListings', 'tab', 'keyword'));
    }

    public function detail($item_id) {
        $itemListing = ItemListing::with([
            'categories',
            'comments.user.myPage',
            'images',
            'purchase',
        ])
        ->withCount(['likes', 'comments'])
        ->findOrFail($item_id);
        return view('item', compact('item_id', 'itemListing'));
    }

    public function like($item_id){
        $user = Auth::user();
        $isLiked = $user->likedListings()->where('item_listing_id', $item_id)->exists();
        if ($isLiked) {
            $user->likedListings()
            ->detach($item_id);
        } else {
            $user->likedListings()
            ->attach($item_id);
        }
        return redirect()->back();
    }

    public function showPurchase($item_id){
        $itemListing = ItemListing::with([
            'images',
            'purchase.user',
            'user.myPage'
        ])
        ->findOrFail($item_id);
        $purchase = $itemListing->purchase;
        return view('purchase', compact('item_id', 'itemListing', 'purchase'));
    }

    public function purchase(PurchaseRequest $request, $item_id){
        $user = Auth::user();
        $item = ItemListing::with('images', 'purchase')->findOrFail($item_id);
        if ($item->purchase) {
            return back()->withErrors(['item_id' => 'この商品はすでに購入されています'])->withInput();
        }
        ItemPurchase::create([
            'user_id' => $user->id,
            'item_listing_id' => $item_id,
            'payment' => $request->input('payment'),
        ]);
        return redirect('/');
    }

    public function showListing(){
        $categories = Category::all();
        return view('sell',compact('categories'));
    }

    public function storeListing(ExhibitionRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('image_url')) {
            $tmpPath = $request->file('image_url')->store('tmp', 'public');
            session()->flash('tmp_image', $tmpPath);
            \Log::debug('tmp_image saved to session: ' . $tmpPath);
        }
        $user = auth()->user();
        $item = ItemListing::create([
            'item_name' => $request->input('item_name'),
            'brand_name' => $request->input('brand_name'),
            'condition' => $request->input('condition'),
            'price' => $request->input('price'),
            'description' =>$request->input('description'),
            'user_id' => $user->id,
        ]);
        $item->categories()->sync($validated['categories'] ?? []);
        if (isset($tmpPath)){
            $item->images()->create([
                'image_url' => $tmpPath,
            ]);
        }
        return redirect()->back()->withInput();
    }
}
