<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * 投稿をお気に入りにするアクション。
     */
    public function store($id)
    {
        \Auth::user()->favorite($id);

        return back();
    }

    /**
     * お気に入りを削除するアクション。
     */
    public function destroy($id)
    {
        \Auth::user()->unfavorite($id);

        return back();
    }
}
