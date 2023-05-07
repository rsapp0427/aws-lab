<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿一覧</h2>
	</x-slot>
	<div class="mx-auto p-6">
		@if(session('message'))
			<div class="text-red-600 font-bold">
				{{ session('message') }}
			</div>
		@endif
		@foreach($posts as $post)
			<a href="{{ route('post.show', $post) }}" class="@if(!$loop->last)mb-4 @endif bg-white max-w-7xl mx-auto rounded-2xl block">
				<h1 class="p-4 text-lg font-semibold hover:text-blue-600">{{ $post->title }}</h1>
				<div class="p-4 border-t border-t-gray-600">
					@if($post->lead)
						<p class="mb-4">{{ $post->lead }}</p>
					@endif
					@if($post->thumbnail)
						<figure class="mb-4 flex justify-center">
							<img src="{{ $post->thumbnail }}" alt="{{ $post->thumbnail_alt }}">
						</figure>
					@endif
					<p class="text-sm font-semibold flex gap-4 text-gray-600">
						<span>作成日：{{ $post->created_at }}</span>
						<span>更新日：{{ $post->updated_at }}</span>
					</p>
				</div>
			</a>
		@endforeach
	</div>
</x-app-layout>