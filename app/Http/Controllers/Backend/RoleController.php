<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Concerns\CsvImportTrait;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
//        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Role::with(['permissions'])->select(sprintf('%s.*', (new Role)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'role_show';
                $editGate      = 'role_edit';
                $deleteGate    = 'role_delete';
                $crudRoutePart = 'roles';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('permissions', function ($row) {
                $labels = [];
                foreach ($row->permissions as $permission) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $permission->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'permissions']);

            return $table->make(true);
        }

        $permissions = Permission::get();

        return view('backend.default.roles.index', compact('permissions'));
    }

    public function create()
    {
//        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        return view('backend.default.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role)
    {
//        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        $role->load('permissions');

        return view('backend.default.roles.edit', compact('permissions', 'role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
//        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('backend.default.roles.show', compact('role'));
    }

    public function destroy(Role $role)
    {
//        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return back();
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        $roles = Role::find(request('ids'));

        foreach ($roles as $role) {
            $role->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
