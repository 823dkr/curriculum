<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function ajaxfeed(Request $request)
    {
        $user_id = Auth::user()->id;
        $creature_id = $request->creature_id;
        $already_feed = Feed::where('user_id', $user_id)->where('creature_id', $creature_id)->firast();

        if (!$already_feed) {
            //空（まだ「給餌」していない）ならfeedsテーブルに新しいレコードを作成する
            $feed = new Feed;
            $feed->creature_id = $request->creature_id;
            $feed->user_id = $user_id;
            $feed->save();
        } else {
            // 空でない（既に給餌している）なら
            //feedsテーブルのレコードを削除           
            Feed::where('creature_id', $creature_id)->where('user_id', $user_id)->delete();
        }
        return response()->json();
    }
}
