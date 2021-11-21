<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;

class LikeController extends Controller
{
    public function like(LikeRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();
        $likeable = $request->likeable();

        if($user->isLiked($likeable)){
            $user->unlike($likeable);
        }else{
            $user->like($likeable);
        }

        return back();
    }
}
