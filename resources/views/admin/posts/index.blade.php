<x-layout>
    <x-setting heading="Manage Posts">
        <table class="table-auto w-full">
           <tbody>
                @foreach ($posts as $post)
                    <tr class="border">
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-[#F3F6FF]
                            "
                            >
                            <a href="/posts/{{ $post->slug }}">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-white
                            "
                            >
                            <a
                                href="/admin/posts/{{ $post->id }}/edit"
                                class="
                                text-blue-500
                                hover:text-blue-600
                                py-2
                                px-6
                                text-primary
                                inline-block
                                rounded
                                hover:bg-primary hover:text-white
                                "
                                >
                            Edit
                            </a>
                        </td>
                        <td
                            class="
                            text-center text-dark
                            font-medium
                            text-base
                            py-5
                            px-2
                            bg-white
                            "
                            >
                            <form method="POST" action="/admin/posts/{{ $post->id }}">
                                @csrf
                                @method('DELETE')

                                <button class="
                                    text-red-500
                                    hover:text-red-600" 
                                    type="submit">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
           </tbody>
        </table>
    </x-setting>
</x-layout>