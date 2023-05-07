<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">新規投稿フォーム</h2>
	</x-slot>
	<div class="max-w-7xl mx-auto px-6">
		@if(session('message'))
			<div class="text-red-600 font-bold">{{ session('message') }}</div>
		@endif
		<form name="post_create" method="post">
			@csrf
			<div class="w-full flex flex-col">
				<label for="title" class="font-semibold mt-4">タイトル</label>
				<input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title" value="{{ old('title') }}">
			</div>
			<div class="w-full flex flex-col">
				<label for="lead" class="font-semibold mt-4">リード</label>
				<input type="text" name="lead" class="w-auto py-2 border border-gray-300 rounded-md" id="lead" value="{{ old('lead') }}">
			</div>
			<div class="w-full flex flex-col">
				<label for="thumbnail" class="font-semibold mt-4">サムネイル</label>
				<div class="w-full flex">
					<x-primary-button class="shrink-0" id="lfm" data-input="thumbnail" data-preview="holder">選択する</x-primary-button>
					<input type="text" name="thumbnail" class="flex-1 py-2 border border-gray-300 rounded-md ml-2" id="thumbnail" value="{{ old('thumbnail') }}">
				</div>
				<div id="holder" class="mt-2 max-h-full">
					<img src="{{ old('thumbnail') }}" alt="{{ old('thumbnail_alt') }}">
				</div>
			</div>
			<div class="w-full flex flex-col">
				<label for="body" class="font-semibold mt-4">内容</label>
				<textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body">{{ old('body') }}</textarea>
			</div>
			<x-primary-button class="mt-4" data-submit-form>送信する</x-primary-button>
		</form>
	</div>
	<x-slot name="footer">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
		<script>
			const options = {
				filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
				filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
				filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
				filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
			};
			CKEDITOR.replace('body',options);

			//サムネイル用ファイルマネージャーの処理
			$('#lfm').filemanager('image');

			//エディタ内のimgタグのパス調整処理
			document.querySelector("[data-submit-form]").addEventListener("click", (event) => {
				event.preventDefault();

				document.querySelector(".cke_wysiwyg_frame").contentWindow.document.querySelectorAll('[data-cke-saved-src]').forEach((img) => {
            img.src = img.src.replace(
                /^https?:\/{2,}(.*?)(?:\/|\?|#|$)/,
                "/"
            );
            img.dataset.ckeSavedSrc = img.dataset.ckeSavedSrc.replace(
                /^https?:\/{2,}(.*?)(?:\/|\?|#|$)/,
                "/"
            );
						img.removeAttribute("style");
        });

				document.post_create.action = "{{ route('post.store') }}";
				document.post_create.submit();
			});
		</script>
	</x-slot>
</x-app-layout>