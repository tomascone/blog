<x-layout>
    <section class="px-6 py-8">

        <main class="max-w-lg mx-auto bg-gray-100 p-6 rounded-xl border-gray-200">
            <h1 class="text-center font-bold text-xl">
                Register!
            </h1>

            <form method="POST" action="/register" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 uppercase text-xs font-bold mb-2" for="name">
                    Name
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full" 
                        id="name" 
                        type="text" 
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 uppercase text-xs font-bold mb-2" for="username">
                    Username
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full" id="username" 
                        type="text" 
                        name="username"
                        value="{{ old('username') }}"
                        required
                    >

                    @error('username')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 uppercase text-xs font-bold mb-2" for="email">
                    Email
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full" 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 uppercase text-xs font-bold mb-2">
                    Password
                    </label>
                    <input 
                        class="border border-gray-400 p-2 w-full" id="password" 
                        type="password" 
                        name="password" 
                        required
                    >

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Submit
                    </button>
                </div>
                
            </form>
        </main>

    </section>
</x-layout>