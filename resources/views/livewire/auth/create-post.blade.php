@section('title', 'Create post')

<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new post</h2>
        <form wire:submit="save">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    @foreach ($tabs as $tab)
                        <li wire:key='$tab' class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="{{ $tab }}-tab"
                                data-tabs-target="{{ '#' . $tab }}" type="button" role="tab"
                                aria-controls="{{ $tab }}" aria-selected="false">{{ $tab }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="default-tab-content">
                @foreach ($tabs as $tab)
                    <div wire:key='$tab' class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                        id="{{ $tab }}" role="tabpanel" aria-labelledby="{{ $tab }}-tab">
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label for="title.{{ $tab }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                                    Title ({{ $tab }})</label>
                                <input type="text" wire:model="{{ 'form.translations.' . $tab . '.title' }}"
                                    name="title.{{ $tab }}" id="title.{{ $tab }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type post title" required="">
                            </div>
                            @error('form.translations.' . $tab . '.title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="sm:col-span-2">
                                <label for="title.{{ $tab }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post
                                    slug ({{ $tab }})</label>
                                <input type="text" wire:model="{{ 'form.translations.' . $tab . '.slug' }}"
                                    name="slug.{{ $tab }}" id="slug.{{ $tab }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type post slug" required="">
                            </div>
                            @error('form.translations.' . $tab . '.slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="sm:col-span-2">
                                <label for="content.{{ $tab }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content
                                    ({{ $tab }})
                                </label>
                                <textarea wire:model="{{ 'form.translations.' . $tab . '.text' }}" id="content.{{ $tab }}" rows="8"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Your post content here"></textarea>
                            </div>
                            @error('form.translations.' . $tab . '.text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="sm:col-span-2">
                                <label for="title.{{ $tab }}"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image excerpt
                                    ({{ $tab }})</label>
                                <input type="text" wire:model="{{ 'form.translations.' . $tab . '.excerpt' }}"
                                    name="excerpt.{{ $tab }}" id="excerpt.{{ $tab }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Type image excerpt" required="">
                            </div>
                            @error('form.translations.' . $tab . '.excerpt')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-4 bg-gray-50 dark:bg-gray-800">
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Post
                        image</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" wire:model='form.photo' wire:click="uploadPhoto">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                        (MAX.
                        800x400px).</p>


                    @error('form.photo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="false" class="sr-only peer" wire:model='form.active'>
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Inactive/Active
                            post</span>
                    </label>
                </div>

            </div>









            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Create post
            </button>
        </form>
    </div>
</section>
