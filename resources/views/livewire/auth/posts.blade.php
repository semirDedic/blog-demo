@section('title', 'Posts')

<div class="p-4 md:ml-64 h-auto pt-20">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div
        class="w-full text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @forelse ($posts as $post)
            <div wire:key='{{ $post->id }}'
                class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 rounded hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">

                @if (!$post->trashed())
                    @can('update', $post->user, $post)
                        <svg wire:click="editPost({{ $post }})" aria-label="Update post"
                            class="w-3 h-3 me-2.5 text-gray-800 dark:text-white hover:cursor-pointer" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.3 6.2H5a2 2 0 0 0-2 2V19a2 2 0 0 0 2 2h11c1.1 0 2-1 2-2.1V11l-4 4.2c-.3.3-.7.6-1.2.7l-2.7.6c-1.7.3-3.3-1.3-3-3.1l.6-2.9c.1-.5.4-1 .7-1.3l3-3.1Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M19.8 4.3a2.1 2.1 0 0 0-1-1.1 2 2 0 0 0-2.2.4l-.6.6 2.9 3 .5-.6a2.1 2.1 0 0 0 .6-1.5c0-.2 0-.5-.2-.8Zm-2.4 4.4-2.8-3-4.8 5-.1.3-.7 3c0 .3.3.7.6.6l2.7-.6.3-.1 4.7-5Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endcan
                @endif

                @if (!$post->trashed())
                    @can('delete', Auth::user(), $post)
                        <svg wire:click="deletePost({{ $post }})" aria-label="Delete post"
                            class="w-3 h-3 me-2.5 text-gray-800 dark:text-white hover:cursor-pointer" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    @endcan
                @endif

                {{ $post->title }}

                @if ($post->user->id == Auth::user()->id)
                    <span class="text-blue-600">(Your post)</span>
                @else
                    <span>(Author: {{ $post->user->name }})</span>
                @endif

                @if ($post->trashed())
                    <span class="text-red-600">(Deleted)</span>
                @endif
            </div>
        @empty
            <p>You have no posts</p>
            @if (Auth::user()->hasRole('member'))
                <p>As a member with no permissions you can't create posts.</p>
            @endif
        @endforelse

    </div>

</div>
