@extends('layouts.main')
@section('content')
    @include('flash_messages')
    <main>
        <h2 class="center mb-2 text-center">Company</h2>
        {{-- search --}}
        <div class="row py-3">
            <div class="col-4">
                <h6> Search Key : <span class="text-danger"> {{ request('key') }}</span> </h6>
            </div>
            <div class="col-4 offset-4">
                <form action="{{ route('companies.index') }}" method="GET">
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
            <a href="{{ route('companies.create') }}">
                <button class="mb-2 btn btn-danger mb-2">Add Company</button>
            </a>
        @elseif (Auth::user()->role == 'user')
        @endif

        @if (count($companies) > 0)
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Website</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($companies as $company)
                        <tr>

                            <td>{{ $company['id'] }}</td>

                            <td class="col-2">
                                <img src="{{ asset('postImage/' . $company->logo) }}" class="shadow-sm img-thumbnail"
                                    style="width: 100px; height:100px">
                            </td>

                            <td> {{ $company['name'] }}</td>

                            <td> {{ $company['email'] }}</td>

                            <td> {{ $company['website'] }}</td>

                            @if (Auth::user()->role == 'admin')
                                <td>
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('companies.edit', $company->id) }}"
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
            {{ $companies->links() }}
        @else
            <h2>There are no data to display</h2>
        @endif
    </main>
@endsection
