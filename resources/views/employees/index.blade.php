@extends('layouts.main')
@section('content')
    @include('flash_messages')
    <main>
        <h2 class="text-center">Employee List</h2>
        {{-- search --}}
        <div class="row py-3">
            <div class="col-4">
                <h6> Search Key : <span class="text-danger"> {{ request('key') }}</span> </h6>
            </div>
            <div class="col-4 offset-4">
                <form action="{{ route('employees.index') }}" method="GET">
                    @csrf
                    <div class="d-flex">
                        <input type="text" class="form-control" name="key" placeholder="Search..."
                            value="{{ request('key') }}"></input>
                        <button class="btn bg-dark text-white" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (Auth::user()->role == 'admin')
            <a href="{{ route('employees.create') }}">
                <button class="btn btn-danger mb-2">Add Employee</button>
            </a>
        @elseif (Auth::user()->role == 'user')
        @endif

        @isset($employees)
            @if (count($employees) > 0)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th></th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $e)
                            <tr>
                                <td>{{ $e->id }}</td>

                                <td class="col-2">
                                    <img src="{{ asset('postImage/' . $e->profile) }}" class="shadow-sm img-thumbnail"
                                        style="width: 100px; height:100px">
                                </td>

                                <td>{{ $e->name }}</td>

                                <td>{{ $e->email }}</td>

                                <td>{{ $e->phone }}</td>

                                <?php $companyName = App\Models\Company::find($e->company_id); ?>
                                <td>{{ $companyName->name }}</td>

                                @if (Auth::user()->role == 'admin')
                                    <td>
                                        <form action="{{ route('employees.destroy', $e->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('employees.edit', $e->id) }}"
                                                class="btn btn-outline-success">Edit</a> |
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                @elseif (Auth::user()->role == 'user')
                                    <td>

                                    </td>
                                @endif

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $employees->links() }}
            @else
                <h4>There are no data to display</h4>
            @endif
        @endisset
    </main>
@endsection
