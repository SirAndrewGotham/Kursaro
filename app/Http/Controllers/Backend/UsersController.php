<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles', 'language'])->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

                return view('backend.default.layouts.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

//            $table->editColumn('id', function ($row) {
//                return $row->id ? $row->id : '';
//            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

//            $table->editColumn('two_factor', function ($row) {
//                return '<input type="checkbox" disabled ' . ($row->two_factor ? 'checked' : null) . '>';
//            });
//            $table->editColumn('roles', function ($row) {
//                $labels = [];
//                foreach ($row->roles as $role) {
//                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
//                }
//
//                return implode(' ', $labels);
//            });
//            $table->addColumn('language_english', function ($row) {
//                return $row->language ? $row->language->english : '';
//            });
//
//            $table->editColumn('language.name', function ($row) {
//                return $row->language ? (is_string($row->language) ? $row->language : $row->language->name) : '';
//            });

            $table->rawColumns(['actions', 'placeholder', 'two_factor', 'roles', 'language']);

            return $table->make(true);
        }

        $roles     = Role::get();
        $languages = Language::get();

        return view('backend.default.users.index', compact('roles', 'languages'));
    }

    public function create()
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.default.users.create', compact('languages', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
//        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $languages = Language::pluck('english', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'language');

        return view('backend.default.users.edit', compact('languages', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
//        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

//        $user->load('roles', 'language', 'userCourses', 'userFeedbacks', 'userProspects');

        return view('backend.default.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
//        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($user->id == 1)
        {
            return redirect()->route('admin.users.index')->with('message', 'You can not delete this user');
        }

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
