<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;                        
use App\Models\User;                                        

class UsersController extends Controller
{
    public function index()                                        
    {                                                       
        $users = User::orderBy('id', 'desc')->paginate(10); 

        return view('users.index', [                        
            'users' => $users,                              
        ]);                                                 
    }                                                       
    
    public function show($id)                               
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);                                                 
    }
    
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    /**
     * ユーザのお気に入り一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */    
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        // ユーザのお気に入り一覧を取得
        $favorites = $user->favorites()->paginate(10);
//dd($favorites);
        // フォロー一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
        ]);
    }
    
}
