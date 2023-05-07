<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">投稿表示</h2>
	</x-slot>
	<div class="max-w-7xl mx-auto p-6">
		<div class="bg-white w-full rounded-2xl">
			<div class="p-4">
				<div class="flex justify-between items-baseline border-b border-b-gray-600 pb-4 mb-4">
					<h1 class="text-lg font-semibold">{{ $post->title }}</h1>
					<div class="flex gap-2">
						<a href="{{ route('post.edit', $post) }}">
							<x-primary-button>編集</x-primary-button>
						</a>
						<form method="post" action="{{ route('post.destroy', $post) }}">
							@csrf
							@method('delete')
							<x-primary-button class="bg-red-700">削除</x-primary-button>
						</form>
					</div>
				</div>
				<div class="flex flex-col gap-4 border-b border-b-gray-600 pb-4 mb-4">
					<p>{{ $post->lead }}</p>
					<figure class="self-center">
						<img src="{{ $post->thumbnail }}" alt="{{ $post->thumbnail_alt }}">
					</figure>
				</div>
				<div class="mb-4">{!! $post->body !!}</div>
				<p class="text-sm font-semibold flex justify-end gap-4 text-gray-600">
					<span>作成日：{{ $post->created_at }}</span>
					<span>更新日：{{ $post->updated_at }}</span>
				</p>
			</div>
		</div>
	</div>
</x-app-layout>