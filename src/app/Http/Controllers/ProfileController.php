<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\MyPage;
use App\Models\ItemListing;
use App\Models\Image;

class ProfileController extends Controller
{
    public function showMyPage(Request $request){
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        $myPage = $user->myPage;
        return view('edit_mypage', compact('myPage'));
    }

    public function updateMypage(AddressRequest $addressRequest){
        $profileValidator = Validator::make(
            $addressRequest->all(),
            (new ProfileRequest)->rules(),
            (new ProfileRequest)->messages(),
        );
        if ($profileValidator->fails()){
            return redirect()->back()
            ->withErrors($profileValidator)
            ->withInput();
        };
        $myPage = auth()->user()->myPage;
        $updateData = $addressRequest->only(
            ['postcode', 'address', 'building',]
        );
        if  ($addressRequest->hasFile('profile_image_url')) {
            $file = $addressRequest->file('profile_image_url');
            $path = $file->store('profile_images', 'public');
            $updateData['profile_image_url'] = '/storage/'. $path;
        }
        MyPage::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge(
                ['user_id' => auth()->id()],
                $updateData
            )
        );
        return redirect('/');
    }

    public function update(Request $request){
        $data = $request->all();
        if ($request->hasFile('profile_image')) {
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $data['profile_image_url'] = '/storage/' . $path;
        }
        $myPage = MyPage::where('user_id', auth()->id())->first();
        $myPage->update($data);
        return redirect()->back();
    }


    public function showAddress($item_id){
        $itemListing = ItemListing::with('user.myPage')->find($item_id);
        return view('address', compact('item_id', 'itemListing'));
    }

    public function updateAddress(AddressRequest $request, $item_id){
        $user = Auth::user();
        $data = $request->only(['postcode', 'address', 'building']);
        if ($user->myPage) {
            $user->myPage->update($data);
        } else {
            $user->mypage()->create($data);
        }
        return back();
    }

    public function mypage(Request $request){
        $user = Auth::user();
        $tab = $request->query('tab', 'sell');
        $myPage = auth()->user()->myPage;
        if ($tab === 'buy'){
            $items = $user->itemPurchases()->with('itemListing', 'images')->get();
        } else {
            $items = $user->itemListings()->get();
        }

        return view('mypage', compact('tab', 'items', 'user', 'myPage'));
    }

}
