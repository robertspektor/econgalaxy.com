@props(['id', 'title', 'description', 'benefits', 'drawbacks' => [], 'selected' => false])


<div wire:click="chooseFaction({{ $id }})" class="
    p-4 group relative flex flex-col border rounded-lg

    {{ !$selected ? 'border-gray-200 bg-white hover:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700/50 dark:hover:border-neutral-700'
    : 'border-blue-500 bg-blue-50 dark:bg-blue-900 dark:border-blue-500' }}
    ">
    <div class="h-full flex gap-x-5">
        <div class="shrink-0 size-8">
            <svg class="shrink-0 size-8" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7326 0C9.96372 0.00130479 8.53211 1.43397 8.53342 3.19935C8.53211 4.96473 9.96503 6.39739 11.7339 6.39869H14.9345V3.20065C14.9358 1.43527 13.5029 0.00260958 11.7326 0C11.7339 0 11.7339 0 11.7326 0M11.7326 8.53333H3.20053C1.43161 8.53464 -0.00130383 9.9673 3.57297e-06 11.7327C-0.00261123 13.4981 1.4303 14.9307 3.19922 14.9333H11.7326C13.5016 14.932 14.9345 13.4994 14.9332 11.734C14.9345 9.9673 13.5016 8.53464 11.7326 8.53333V8.53333Z" fill="#36C5F0"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M32 11.7327C32.0013 9.9673 30.5684 8.53464 28.7995 8.53333C27.0306 8.53464 25.5976 9.9673 25.5989 11.7327V14.9333H28.7995C30.5684 14.932 32.0013 13.4994 32 11.7327ZM23.4666 11.7327V3.19935C23.4679 1.43527 22.0363 0.00260958 20.2674 0C18.4984 0.00130479 17.0655 1.43397 17.0668 3.19935V11.7327C17.0642 13.4981 18.4971 14.9307 20.2661 14.9333C22.035 14.932 23.4679 13.4994 23.4666 11.7327Z" fill="#2EB67D"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2661 32C22.035 31.9987 23.4679 30.566 23.4666 28.8007C23.4679 27.0353 22.035 25.6026 20.2661 25.6013H17.0656V28.8007C17.0642 30.5647 18.4972 31.9974 20.2661 32ZM20.2661 23.4654H28.7995C30.5684 23.4641 32.0013 22.0314 32 20.266C32.0026 18.5006 30.5697 17.068 28.8008 17.0654H20.2674C18.4985 17.0667 17.0656 18.4993 17.0669 20.2647C17.0656 22.0314 18.4972 23.4641 20.2661 23.4654V23.4654Z" fill="#ECB22E"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.93953e-07 20.266C-0.00130651 22.0314 1.43161 23.4641 3.20052 23.4654C4.96944 23.4641 6.40235 22.0314 6.40105 20.266V17.0667H3.20052C1.43161 17.068 -0.00130651 18.5006 8.93953e-07 20.266ZM8.53342 20.266V28.7993C8.53081 30.5647 9.96372 31.9974 11.7326 32C13.5016 31.9987 14.9345 30.566 14.9332 28.8007V20.2686C14.9358 18.5032 13.5029 17.0706 11.7339 17.068C9.96372 17.068 8.53211 18.5006 8.53342 20.266C8.53342 20.2673 8.53342 20.266 8.53342 20.266Z" fill="#E01E5A"></path>
            </svg>
        </div>

        <div class="grow">
            <div class="h-full flex flex-col">
                <div>
                    <h3 class="inline-flex items-center gap-x-1 font-medium text-gray-800 dark:text-neutral-200">
                        {{ $title }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        {{ $description }}
                    </p>

                    <ul class="mt-2 text-sm text-gray-500 dark:text-neutral-500">
                        @foreach($benefits as $benefit)
                            <li class="flex gap-x-1">
                                <svg class="size-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $benefit }}
                            </li>
                        @endforeach
                    </ul>

                    <ul class="mt-2 text-sm text-gray-500 dark:text-neutral-500">
                        @foreach($drawbacks as $drawback)
                            <li class="flex gap-x-1">
                                <svg class="size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ $drawback }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <a class="after:absolute after:inset-0 after:z-10" href="#"></a>
</div>
