<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="flex h-full items-center">
    <main class="w-full max-w-md mx-auto p-6">
      <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign up</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
              Already have an account?
              <a wire:navigate
                class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                href="/login">
                Sign in here
              </a>
            </p>
          </div>
          <hr class="my-5 border-slate-300">
          <!-- Form -->
          <form wire:submit.prevent="register">
            <div class="grid gap-y-4">
              <!-- Form Group -->
              <div>
                <label for="name" class="block text-sm mb-2 dark:text-white">Name</label>
                <div class="relative">
                  <input wire:model="name" type="text" id="name" name="name"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    required>
                  <!-- Validation Error Message -->
                  @error('name') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>
              </div>
              <!-- End Form Group -->

              <!-- Form Group -->
              <div>
                <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                <div class="relative">
                  <input wire:model="email" type="email" id="email" name="email"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    required>
                  <!-- Validation Error Message -->
                  @error('email') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>
              </div>
              <!-- End Form Group -->

              <!-- Form Group -->
              <div>
                <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                <div class="relative">
                  <input wire:model="password" type="password" id="password" name="password"
                    class="py-3 border px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                    required>
                  <!-- Validation Error Message -->
                  @error('password') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>
              </div>
              <!-- End Form Group -->

              <button type="submit" wire:loading.attr="disabled"
                class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                <span wire:loading wire:target="register"
                  class="h-4 w-4 border-t-2 border-r-2 border-blue-500 rounded-full animate-spin"></span>
                Sign up
              </button>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
  </div>
</div>