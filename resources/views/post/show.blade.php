<x-app-layout>
	<x-slot name="header">
		投稿表示
	</x-slot>
	<div class="max-w-7xl mx-auto px-6">
		<div class="bg-white w-full rounded-2xl">
			<div class="mt-4 p-4">
				<h1 class="text-lg font-semibold">
					{{ $post->title }}
				</h1>
				<div class="text-right flex">
					<a href="{{ route('post.edit', $post) }}" class="flex-1">
						<x-primary-button>
							編集
						</x-primary-button>
					</a>

					<form method="post" action="{{ route('post.destroy', $post) }}">
						@csrf
						@method('delete')
						<x-primary-button class="bg-red-700 ml-2">
							削除
						</x-primary-button>
					</form>
				</div>
				<hr class="w-full">
				<div class="mt-4 whitespace-pre-line">
					{!! $post->body !!}
				</div>
				<div class="text-sm font-semibold flex flex-row-reverse">
					<p>{{ $post->created_at }}</p>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>