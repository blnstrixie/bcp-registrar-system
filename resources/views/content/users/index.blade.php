@extends('app')
@section('title')
    User Management
@endsection
@section('links')
@endsection

@section('page-content')
    <div class="content-title">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                List of Users
            </div>
            <div>
                <a href="{{ route('user-management.create') }}" type="button" class="btn btn-success">Add Account</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form class="mb-3" action="" method="GET" id="sortusers">
                <div class="row">
                    <div class="col-lg-4">
                        {{-- <select select name="delivery_status" id="delivery_status" class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" onchange="sort_users()"> --}}
                        <select select name="role" id="role" class="form-control form-select form-control-sm mb-2 mb-md-0" onchange="sort_users()" >
                            <option value="">Filter by Role</option>
                            <option value="registrar" {{ $sort_role == 'registrar' ? 'selected' : '' }}>Registrar</option>
                            <option value="teacher" {{ $sort_role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" id="search" name="search"@isset($search) value="{{ $search }}" @endisset placeholder="Type name of user & hit Enter">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-success btn-block">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            <th width="300px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($users) && $users->count())
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ($key+1) + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ ucwords($user->firstname).' '.ucwords($user->lastname) }}</td>
                                    <td>{{ ucwords($user->username) }}</td>
                                    <td>{{ ucwords($user->password) }}</td>
                                    <td>{{ ucwords($user->role) }}</td>
                                    <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('user-management.show',encrypt($user->id)) }}" type="button" class="btn btn-info">View</a>
                                        <a href="{{ route('user-management.delete', encrypt($user->id)) }}" type="button" class="btn btn-danger">Delete</a>
                                        {{-- <button class="btn btn-danger">Delete</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">There are no data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function sort_users(){
            $('#sortusers').submit();
        }
    </script>
@endsection
