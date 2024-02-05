<?php

namespace App\Http\Controllers;

use App\Creature;
use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeedController extends Controller
{
    public function feed(Request $request)
    {
        $user_id = Auth::user()->id;
        $creature_id = $request->creature_id;
        $today = Carbon::today();
        $already_feed = Feed::where('user_id', $user_id)->where('creature_id', $creature_id)->whereDate('created_at', $today)->first();

        if (!$already_feed) {
            //空（まだ「給餌」していない）ならfeedsテーブルに新しいレコードを作成する
            $feed = new Feed;
            $feed->creature_id = $request->creature_id;
            $feed->user_id = $user_id;
            $feed->save();
        } else {
            // 空でない（既に給餌している）なら
            //feedsテーブルのレコードを削除    
            Feed::where('creature_id', $creature_id)->where('user_id', $user_id)->whereDate('created_at', $today)->delete();
        }
        return response()->json();
    }
}
