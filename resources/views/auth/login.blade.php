@extends('layouts.auth')

@section('content')
<section class="h-screen dark:bg-gray-800">
    <div class="px-6 h-full text-gray-800 dark:text-gray-50">
      <div
        class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
      >
        <div
          class="grow-0 shrink-1 md:shrink-0 basis-auto xl:w-6/12 lg:w-6/12 md:w-9/12 mb-12 md:mb-0"
        >
          <img
            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="w-full"
            alt="Sample image"
          />
        </div>
        <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
          <form method="POST" action="{{ route('login') }}">
            @csrf
  
            <!-- Email input -->
            <div class="mb-6">
              <input
                type="text"
                class="form-control @error('email') border-red-500 @enderror block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white dark:bg-gray-800 dark:text-gray-50 bg-clip-padding border border-solid rounded transition ease-in-out m-0 focus:text-gray-700 dark:focus:text-gray-100 focus:bg-white dark:focus:bg-gray-800 focus:border-blue-600 focus:outline-none"
                id="exampleFormControlInput2"
                placeholder="Email"
                name="email"
                value="{{ old('email') }}"
              />
              @error('email')
                <span class="text-red-500" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
  
            <!-- Password input -->
            <div class="mb-6">
              <input
                type="password"
                class="form-control @error('password') border-red-500 @enderror block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white dark:bg-gray-800 dark:text-gray-50 bg-clip-padding border border-solid rounded transition ease-in-out m-0 focus:text-gray-700 dark:focus:text-gray-100 focus:bg-white dark:focus:bg-gray-800 focus:border-blue-600 focus:outline-none"
                id="exampleFormControlInput2"
                placeholder="Password"
                name="password"
                value="{{ old('password') }}"
              />
              @error('password')
                <span class="text-red-500" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
  
            <div class="text-center lg:text-left">
              <button
                type="submit"
                class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
              >
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
