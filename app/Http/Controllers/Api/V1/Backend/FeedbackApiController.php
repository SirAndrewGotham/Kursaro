<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\Backend\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackResource(Feedback::with(['user'])->get());
    }

    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create($request->all());

        return (new FeedbackResource($feedback))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackResource($feedback->load(['user']));
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->all());

        return (new FeedbackResource($feedback))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedback->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
