<?php

namespace App\Http\Controllers;

use App\Contracts\GuestInquiryStoreResponse;
use App\Contracts\StoresGuestInquiry;
use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InquiriesController extends Controller
{
    public function create(Request $request, Property $property, StoresGuestInquiry $storer ) :GuestInquiryStoreResponse
    {

        // Gate::authorize('create', Inquiry::class);

        $storer->create($property, $request->all());

        return app(GuestInquiryStoreResponse::class);
    }
}
