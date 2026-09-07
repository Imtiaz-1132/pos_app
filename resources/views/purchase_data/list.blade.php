@extends('layouts.app')

@section('title', 'Saved Purchase Data | POS App')

@section('page_label', 'Saved Purchase Data')

@section('content')

<div class="container-fluid">

    <div class="information-entry">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="mb-1">Saved Purchase Data</h5>
                <small class="text-muted">
                    Purchase Data Manage থেকে saved information
                </small>
            </div>

            <a href="{{ route('purchase-data.create') }}"
               class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>
                Add New

            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Date</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Occupation</th>
                        <th>NID Front</th>
                        <th>NID Back</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($purchaseData as $data)

                        <tr>

                            <td>
                                {{ $data->id }}
                            </td>

                            <td>
                                {{ $data->name }}
                            </td>

                            <td>
                                {{ $data->gender }}
                            </td>

                            <td>
                                {{ $data->address }}
                            </td>

                            <td>
                                {{ $data->telephone }}
                            </td>

                            <td>
                                {{ $data->date?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $data->date_of_birth?->format('d/m/Y') ?? '-' }}
                            </td>

                            <td>
                                {{ $data->email ?? '-' }}
                            </td>

                            <td>
                                {{ $data->occupation ?? '-' }}
                            </td>


                            {{-- NID Front --}}
                            <td>

                                @if($data->nid_front)

                                    <a href="{{ asset('storage/' . $data->nid_front) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-eye"></i>
                                        View

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Not Uploaded
                                    </span>

                                @endif

                            </td>


                            {{-- NID Back --}}
                            <td>

                                @if($data->nid_back)

                                    <a href="{{ asset('storage/' . $data->nid_back) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">

                                        <i class="bi bi-eye"></i>
                                        View

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Not Uploaded
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex gap-1">

                                    {{-- View --}}
                                    <a href="{{ route('purchase-data.show', $data->id) }}"
                                       class="btn btn-sm btn-info text-white"
                                       title="View">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('purchase-data.edit', $data->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('purchase-data.destroy', $data->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="12"
                                class="text-center py-5">

                                <i class="bi bi-inbox fs-1 text-muted"></i>

                                <div class="mt-2">
                                    No Purchase Data Found
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="mt-3">

            {{ $purchaseData->links() }}

        </div>

    </div>

</div>

@endsection