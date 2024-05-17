<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewInquiries;
use App\Contracts\DeletesInquiries;
use App\Contracts\InquiryCreateResponse;
use App\Contracts\InquiryDeleteResponse;
use App\Contracts\InquiryUpdateResponse;
use App\Contracts\UpdatesInquiries;
use App\Filters\InquiryFilters;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class InquiriesController extends Controller
{
    /**
     * Get filtered ordered paginated inquiries collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\InquiryFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, InquiryFilters $filters): Response
    {
        Gate::authorize('viewAny', Inquiry::class);

        return Inertia::render('Admin/Inquiries/Index', [
            'inquiries' => Inquiry::filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_inquiries' => auth()->user()->can('viewAny', Inquiry::class),
            ],

        ]);
    }

    /**
     * Renders and returns given inquiry page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Inertia\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Inquiry $inquiry): Response
    {
        Gate::authorize('view', $inquiry);

        return Inertia::render('Admin/Inquiries/Show', [
            'inquiry' => Inquiry::with('property')->find($inquiry->id),
            'can' => [
                'view_inquiry' => auth()->user()->can('view', $inquiry),
                'delete_inquiry' => auth()->user()->can('delete', $inquiry),
            ],
        ]);
    }

    /**
     * Creates new inquiry with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewInquiries  $creator
     * @return \App\Contracts\InquiryCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request,Property $property, CreatesNewInquiries $creator): InquiryCreateResponse
    {
        Gate::authorize('create', Inquiry::class);

        $creator->create($property, $request->all());

        return app(InquiryCreateResponse::class);
    }

    /**
     * Updates given inquiry with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @param  \App\Contracts\UpdatesInquiries  $updater
     * @return \App\Contracts\InquiryUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Inquiry $inquiry, UpdatesInquiries $updater): InquiryUpdateResponse
    {
        Gate::authorize('update', $inquiry);

        $updater->update($inquiry, $request->all());

        return app(InquiryUpdateResponse::class);
    }

    /**
     * Destroyes given inquiry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @param  \App\Contracts\DeletesInquiries  $updater
     * @return \App\Contracts\InquiryDeleteResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Inquiry $inquiry, DeletesInquiries $destroyer): InquiryDeleteResponse
    {
        Gate::authorize('delete', $inquiry);

        $destroyer->destroy($inquiry);

        return app(InquiryDeleteResponse::class);
    }
}
