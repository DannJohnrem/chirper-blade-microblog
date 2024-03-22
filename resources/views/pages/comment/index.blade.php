<x-app-layout>
    <div class="max-w-2xl p-4 mx-auto sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf

            <textarea name="message" id="Message" placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-500 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
            <x-primary-button class="mt-4">{{ __('Send') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm">
            @foreach($chirps as $comment)
                <div class="flex p-6 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                {{-- <span class="d-gray-800">{{ optional($comment->users)->name }}</span> --}}
                                <span class="d-gray-800">{{ $comment->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($comment->created_at->eq($comment->updated_at))
                                    <small class="text-sm text-gray-600">{{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if ($comment->user->as(auth()->user()))
                                <div>

                                </div>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $comment->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
