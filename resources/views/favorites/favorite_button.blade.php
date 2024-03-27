@if (Auth::id() != $user->id)
    @if (Auth::user()->is_favorite($micropost->id))
        {{-- お気に入り削除ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-sm normal-case"
                onclick="return confirm('id = {{ $micropost->id }}のお気に入りを外します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- お気に入りボタンのフォーム  --}}
        <form method="POST" action="{{ route('favorites.favorite',$micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm normal-case">Favorite</button>
        </form>
    @endif
@endif

