@props(['post'])

@if ($post->bookmarks->contains('user_id', auth()->id()))
    <form method="POST" action="/bookmark/{{ $post->id }}">
        @csrf
        @method('DELETE')

        <x-form.button>
            <i class="fas fa-bookmark mr-2"></i>
            Remove from Bookmark
        </x-form.button>
    </form>
@else
    <form method="POST" action="/bookmark/{{ $post->id }}">
        @csrf

        <x-form.button>
            <i class="fas fa-bookmark mr-2"></i>
            Add to Bookmark
        </x-form.button>
    </form>
@endif