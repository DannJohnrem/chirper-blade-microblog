<x-app-layout>
    <div class="max-w-2xl p-4 mx-auto sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('comment.update', $comment) }}">
            @csrf
            @method('patch')
            <textarea name="message" id="Message"
                class="block w-full border-gray-500 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('message', $comment) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Update') }}</x-primary-button>
                <x-secondary-button :href="route('comment.index')">{{ __('Cancel') }}</x-secondart-button>
            </div>
        </form>
    </div>
</x-app-layout>
