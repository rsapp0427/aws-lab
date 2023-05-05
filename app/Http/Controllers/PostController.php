<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	//一覧表示
	public function index()
	{
		//データベース取得処理
		$posts = Post::all();

		return view('post.index', compact('posts'));
	}

	//個別表示
	public function show(Post $post)
	{
		return view('post.show', compact('post'));
	}

	//新規登録
	public function create()
	{
		return view('post.create');
	}

	//新規登録処理
	public function store(Request $request)
	{
		//バリデーション処理
		$validated = $request->validate([
			'title' => 'required',
			'body' => 'required',
		]);

		//データベース登録処理
		$post = Post::create($validated);

		return back()->with('message', '保存しました');
	}

	//更新表示
	public function edit(Post $post)
	{
		return view('post.edit', compact('post'));
	}

	//更新処理
	public function update(Request $request, Post $post)
	{
		$validated = $request->validate([
			'title' => 'required',
			'body' => 'required',
		]);

		$post->update($validated);

		return back()->with('message', '更新しました');
	}

	public function destroy(Post $post)
	{
		$post->delete();

		return redirect()->route('post.index')->with('message', '削除しました');
	}
}
