@php
    use App\Functions\Helper;
@endphp

@extends('layouts.admin')

@section('content')
    <h1>List projects</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered border-success">
        <thead class="table-success">
            <tr>
                <th scope="col"><a class="text-decoration-none text-black"
                        href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'id']) }}"><i
                            class="fa-solid fa-sort order-icon"></i>ID</a>
                </th>
                <th scope="col"><a class="text-decoration-none text-black"
                        href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'name']) }}"><i
                            class="fa-solid fa-sort order-icon"></i>Name project</a>
                </th>
                <th scope="col"><a class="text-decoration-none text-black"
                        href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'start_date']) }}"><i
                            class="fa-solid fa-sort order-icon"></i>Start date</a>
                </th>
                <th scope="col"><a class="text-decoration-none text-black"
                        href="{{ route('admin.order-by', ['direction' => $direction, 'column' => 'end_date']) }}"><i
                            class="fa-solid fa-sort order-icon"></i>End date</a>
                </th>
                <th scope="col">Technology</th>
                <th scope="col">Type</th>
                <th class="text-center" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ Helper::formatDate($project->start_date) }}</td>
                    <td>{{ isset($project->end_date) ? Helper::formatDate($project->end_date) : 'Work in progress' }}</td>
                    <td>
                        @forelse ($project->technologies as $technology)
                            <a class="badge text-bg-info text-decoration-none"
                                href="{{ route('admin.project-technology', $technology) }}">{{ $technology->name }}</a>
                        @empty
                            <a class="badge text-bg-info text-decoration-none" href="{{ route('admin.no-tech') }}">-</a>
                        @endforelse
                    </td>
                    <td>{{ $project->type?->name ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-success"> <i
                                class="fa-solid fa-circle-info"></i></a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pencil"></i></a>

                        @include('admin.partials.formDelete', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => 'Are you sure you want to delete this project?',
                        ])
                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>
    <div class="paginator w-50">
        {{ $projects->links() }}
    </div>
@endsection
