@extends('errors::tailwind')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))

@section('action')
    <a href="/"
        class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">
        {{ __('Back to Homepage') }}
    </a>
@endsection
