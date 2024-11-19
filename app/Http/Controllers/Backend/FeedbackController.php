<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyFeedbackRequest;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FeedbackController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Feedback::with(['user'])->select(sprintf('%s.*', (new Feedback)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'feedback_show';
                $editGate      = 'feedback_edit';
                $deleteGate    = 'feedback_delete';
                $crudRoutePart = 'feedbacks';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('backend.default.feedbacks.index', compact('users'));
    }

    public function create()
    {
//        abort_if(Gate::denies('feedback_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.feedbacks.create', compact('users'));
    }

    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create($request->all());

        return redirect()->route('admin.feedbacks.index');
    }

    public function edit(Feedback $feedback)
    {
//        abort_if(Gate::denies('feedback_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $feedback->load('user');

        return view('backend.default.feedbacks.edit', compact('feedback', 'users'));
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->all());

        return redirect()->route('admin.feedbacks.index');
    }

    public function show(Feedback $feedback)
    {
//        abort_if(Gate::denies('feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedback->load('user');

        return view('backend.default.feedbacks.show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
//        abort_if(Gate::denies('feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedback->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeedbackRequest $request)
    {
        $feedbacks = Feedback::find(request('ids'));

        foreach ($feedbacks as $feedback) {
            $feedback->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
