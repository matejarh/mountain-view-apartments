<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ApprovesReviews;
use App\Contracts\CreatesNewReviews;
use App\Contracts\DeletesReviews;
use App\Contracts\RejectsReviews;
use App\Contracts\ReviewApproveResponse;
use App\Contracts\ReviewCreateResponse;
use App\Contracts\ReviewDeleteResponse;
use App\Contracts\ReviewRejectResponse;
use App\Contracts\ReviewUpdateResponse;
use App\Contracts\UpdatesReviews;
use App\Filters\ReviewFilters;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ReviewsController extends Controller
{
    /**
     * Get filtered ordered paginated reviews collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\ReviewFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, ReviewFilters $filters): Response
    {
        Gate::authorize('viewAny', Review::class);

        return Inertia::render('Admin/Reviews/Index', [
            'reviews' => Review::filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search', 'approved', 'not-approved']),
            'can' => [
                'view_reviews' => auth()->user()->can('viewAny', Review::class),
            ],

        ]);
    }

    /**
     * Renders and returns given review page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Inertia\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Review $review): Response
    {
        Gate::authorize('view', $review);

        return Inertia::render('Admin/Reviews/Show', [
            'review' => Review::with('property')->find($review->id),
            'can' => [
                'view_review' => auth()->user()->can('view', $review),
                'delete_review' => auth()->user()->can('delete', $review),
            ],
        ]);
    }

    /**
     * Creates new review with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewReviews  $creator
     * @return \App\Contracts\ReviewCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request,Property $property, CreatesNewReviews $creator): ReviewCreateResponse
    {
        Gate::authorize('create', Review::class);

        $creator->create($property, $request->all());

        return app(ReviewCreateResponse::class);
    }

    /**
     * Updates given review with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @param  \App\Contracts\UpdatesReviews  $updater
     * @return \App\Contracts\ReviewUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Review $review, UpdatesReviews $updater): ReviewUpdateResponse
    {
        Gate::authorize('update', $review);

        $updater->update($review, $request->all());

        return app(ReviewUpdateResponse::class);
    }

    /**
     * Destroyes given review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @param  \App\Contracts\DeletesReviews  $updater
     * @return \App\Contracts\ReviewDeleteResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Review $review, DeletesReviews $destroyer): ReviewDeleteResponse
    {
        Gate::authorize('delete', $review);

        $destroyer->destroy($review);

        return app(ReviewDeleteResponse::class);
    }

    /**
     * Approves given review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @param  \App\Contracts\ApprovesReviews  $updater
     * @return \App\Contracts\ReviewApproveResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function approve(Request $request, Review $review, ApprovesReviews $approver): ReviewApproveResponse
    {
        Gate::authorize('update', $review);

        $approver->approve($review);

        return app(ReviewApproveResponse::class);
    }

    /**
     * Rejects given review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @param  \App\Contracts\RejectsReviews  $updater
     * @return \App\Contracts\ReviewRejectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function reject(Request $request, Review $review, RejectsReviews $approver): ReviewRejectResponse
    {
        Gate::authorize('update', $review);

        $approver->reject($review);

        return app(ReviewRejectResponse::class);
    }
}
