@section('title', 'Update post')

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update post</h2>
        <form wire:submit="save">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    @foreach ($locales as $locale)
                        <li wire:key='$locale' class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="{{ $locale }}-tab"
                                data-tabs-target="{{ '#' . $locale }}" type="button" role="tab"
                                aria-controls="{{ $locale }}" aria-selected="false">{{ $locale }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="default-tab-content">
                @foreach ($locales as $locale)
                    <div wire:key='$locale' class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                        id="{{ $locale }}" role="tabpanel" aria-labelledby="{{ $locale }}-tab">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="title.{{ $locale }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                                    Title ({{ $locale }})</label>
                                <input type="text" wire:model="{{ 'form.translations.' . $locale . '.title' }}"
                                    name="title.{{ $locale }}" id="title.{{ $locale }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type post title" required="">
                            </div>
                            @error('form.translations.' . $locale . '.title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="sm:col-span-2">
                                <label for="content.{{ $locale }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content
                                    ({{ $locale }})
                                </label>
                                <textarea wire:model="{{ 'form.translations.' . $locale . '.text' }}" id="content.{{ $locale }}" rows="8"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your post content here"></textarea>
                            </div>
                            @error('form.translations.' . $locale . '.text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            <div wire:dirty>Unsaved changes...</div>

            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Save post
            </button>
        </form>
    </div>
</section>
