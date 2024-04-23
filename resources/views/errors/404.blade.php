@extends('errors::tailwind')

@section('title', __('Something\'s missing'))
@section('code', '404')
@section('message', __('Sorry, we can\'t find that page. You\'ll find lots to explore on the home page.'))
@section('icon')
    <h1>404</h1>
@endsection
@section('action')
    <a href="/"
        class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back
        to Homepage</a>
@endsection
