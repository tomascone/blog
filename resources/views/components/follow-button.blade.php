@props(['post'])

@if ($post->author->followed->contains('user_id', auth()->id()))   
    <form method="POST" action="/follow/{{ $post->author->id }}">
        @csrf
        @method('DELETE')

        <x-form.button>
            Following
        </x-form.button>
    </form>
@else
    <form method="POST" action="/follow/{{ $post->author->id }}">
        @csrf

        <x-form.button>
            Follow
        </x-form.button>
    </form>
@endif