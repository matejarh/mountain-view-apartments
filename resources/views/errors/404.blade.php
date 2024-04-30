@extends('errors::tailwind')

@section('title', __('Something\'s missing'))
@section('code', '404')
@section('message', __('Sorry, we can\'t find that page. You\'ll find lots to explore on the home page.'))

@section('icon')
    <svg class="mx-auto mb-4 w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
    </svg>

@endsection
@section('action')
    <a href="/"
        class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-700 my-4">
        {{ __('Back to Homepage') }}
    </a>
@endsection
