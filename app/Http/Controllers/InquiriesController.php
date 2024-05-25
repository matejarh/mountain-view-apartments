<?php

namespace App\Http\Controllers;

use App\Contracts\GuestInquiryStoreResponse;
use App\Contracts\StoresGuestInquiry;
use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class InquiriesController extends Controller
{
    public function index(Request $request) :Response
    {
        return Inertia::render('MyInquiries/Index', [
            'inquiries' => auth()->user()->inquiries->paginate(20, null,null, __('page'))->onEachSide(2)->withQueryString(),
            'seo' => [
                'title' => __('My Inquiries'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }

    public function store(Request $request, Property $property, StoresGuestInquiry $creator ) :GuestInquiryStoreResponse
    {
        // Gate::authorize('create', Inquiry::class);

        $creator->create($property, $request->all());

        return app(GuestInquiryStoreResponse::class);
    }
}
