
@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf

            <header class="flex items-center">
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ ucwords(auth()->user()->name) }} avatar" width="40" height="40" class="rounded-full">
                <h2 class="ml-4">
                    Want to participate?
                </h2>
            </header>

            <div class="mt-6">
                <textarea class="w-full text-sm focus:outline-none focus:ring" name="body" id="" rows="5" 
                required placeholder="Quick, think of something to say!"></textarea>
                
                @error('body')
                    <span class="text-xs text-red-500">
                        {{ $message }}
                    </span>
                @enderror

                <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                    <x-form.button>
                        Post
                    </x-form.button>
                </div>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold">
        <a href="/register" class="hover:underline">Register</a> or
        <a href="/login" class="hover:underline">
            log in
        </a> to leave a comment
    </p>
@endauth