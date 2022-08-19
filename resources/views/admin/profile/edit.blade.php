<x-layout>
    <x-setting heading="Edit your profile">
        <form method="POST" action="/profile/edit/" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="username" :value="old('username', $user->username)" />

            <div class="flex mt-6 ">
                <div class="flex-1">
                    <x-form.input name="avatar" type="file" value="old('avatar', $user->avatar)" />
                </div>
                
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile avatar" class="rounded-xl ml-6" width="100">
            </div>

            <x-form.button>
                Update Profile
            </x-form.button>
        </form>
    </x-setting>
</x-layout>