@vite('resources/js/validation-errors.js')
<div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
  <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
    <div class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black/5">
      <div class="p-4">
        <div class="flex items-start">
          <div class="shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>

          </div>
          <div class="ml-3 w-0 flex-1 pt-0.5">
            <p class="text-sm font-medium text-gray-900">{{ $title }}</p>
            @if (count($validationMessages) === 1)
                <p class="mt-1 text-sm text-gray-500">{{ $validationMessages[0] }}</p>
                @else
                <ul class="list-none">
                    @foreach ($validationMessages as $message)
                        <li class="mt-1 text-sm text-gray-500">{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>