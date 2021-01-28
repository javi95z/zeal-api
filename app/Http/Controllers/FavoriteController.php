<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all Favorites from auth user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $favs = Favorite::where('user_id', auth()->user()->id)->get();
        // Attach resource name for each entry
        $favs->each(function ($item) {
            $item->name = DB::table($item->item_type)->find($item->item_id)->name;
        });
        return response()->json($favs, 200);
    }


    /**
     * Create new favorite
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $fav = Favorite::firstOrCreate([
                'item_id' =>  $request->item_id,
                'item_type' => $request->item_type,
                'user_id' => auth()->user()->id
            ]);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return response()->json($fav->refresh());
    }

    /**
     * Delete one Role
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Favorite::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete favorite'], 400);
        return response()->json(true, 200);
    }
}
