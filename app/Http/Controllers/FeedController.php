<?php

namespace App\Http\Controllers;

use App\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $feeds = Feed::with('user')->get();
            return response()->json([
                'message' => 'Success Retrieved Feeds',
                'feeds' => $feeds,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:1',
        ]);
        try {
            $content = $request->input('content');
            $img = $request->input('img');
            $user_id = Auth::id();    

            $newFeed = Feed::create([
                'content' => $content,
                'img' => $img,
                'user_id' => $user_id
            ]);
            return response()->json([
                'message' => 'Successed Create New Feed',
                'feed' => $newFeed,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $feed = Feed::with('user')->find($id);
            if ($feed) {
                return response()->json([
                    'message' => 'Success Retrieved Feed',
                    'feed' => $feed,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Feed Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|min:1',
        ]);
        try {
            $feed = Feed::find($id);
            if ($feed) {
                $content = $request->input('content');
                $img = $request->input('img');
                $user_id = Auth::id();  

                $feedUpdate = $feed->update([
                    'content' => $content,
                    'img' => $img,
                    'user_id' => $user_id
                ]);
                return response()->json([
                    'message' => 'Success Updated Data',
                    'feed' => $feed,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Feed Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $feed = Feed::find($id);
            if ($feed) {
                $feed->delete();
                return response()->json([
                    'message' => 'Success Deleted feed',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'feed Not Found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
            ], 500);
        }
    }
}
