@extends('layouts.app')

@section('title', 'Purchase Data Details | POS App')
@section('page_label', 'Purchase Data Details')

@section('content')

<div class="container-fluid">

    <div class="information-entry">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-1">Purchase Data Details</h5>
                <small class="text-muted">
                    View complete purchase information
                </small>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('purchase-data.index') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>

                <a href="{{ route('purchase-data.edit', $purchaseData->id) }}"
                   class="btn btn-warning">
                    <i class="bi bi-pencil"></i>
                    Edit
                </a>
            </div>
        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- Personal Information --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-primary text-white">
                <i class="bi bi-person"></i>
                Personal Information
            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- Name --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Name
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->name }}
                        </div>
                    </div>


                    {{-- Gender --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Gender
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->gender }}
                        </div>
                    </div>


                    {{-- Telephone --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Telephone
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->telephone }}
                        </div>
                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Email
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->email ?? '-' }}
                        </div>
                    </div>


                    {{-- Occupation --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Occupation
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->occupation ?? '-' }}
                        </div>
                    </div>


                    {{-- Date --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            Date
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->date?->format('d/m/Y') ?? '-' }}
                        </div>
                    </div>


                    {{-- Date of Birth --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            Date of Birth
                        </label>

                        <div class="form-control bg-light">
                            {{ $purchaseData->date_of_birth?->format('d/m/Y') ?? '-' }}
                        </div>
                    </div>


                    {{-- Address --}}
                    <div class="col-12">
                        <label class="form-label fw-bold">
                            Address
                        </label>

                        <div class="form-control bg-light"
                             style="min-height: 80px;">
                            {{ $purchaseData->address }}
                        </div>
                    </div>

                </div>

            </div>
        </div>


        {{-- NID Documents --}}
        <div class="card shadow-sm">

            <div class="card-header bg-dark text-white">
                <i class="bi bi-card-text"></i>
                NID Documents
            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- NID Front --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <h6 class="fw-bold mb-3">
                                NID Front
                            </h6>

                            @if($purchaseData->nid_front)

                                @php
                                    $frontExtension = strtolower(
                                        pathinfo(
                                            $purchaseData->nid_front,
                                            PATHINFO_EXTENSION
                                        )
                                    );
                                @endphp


                                @if(in_array($frontExtension, ['jpg', 'jpeg', 'png']))

                                    <div class="mb-3">
                                        <img
                                            src="{{ asset('storage/' . $purchaseData->nid_front) }}"
                                            alt="NID Front"
                                            class="img-fluid rounded border"
                                            style="max-height: 300px;">
                                    </div>

                                @endif


                                <a href="{{ asset('storage/' . $purchaseData->nid_front) }}"
                                   target="_blank"
                                   class="btn btn-primary">

                                    <i class="bi bi-eye"></i>
                                    View NID Front

                                </a>

                            @else

                                <span class="text-muted">
                                    NID Front not uploaded
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- NID Back --}}
                    <div class="col-md-6">

                        <div class="border rounded p-3">

                            <h6 class="fw-bold mb-3">
                                NID Back
                            </h6>

                            @if($purchaseData->nid_back)

                                @php
                                    $backExtension = strtolower(
                                        pathinfo(
                                            $purchaseData->nid_back,
                                            PATHINFO_EXTENSION
                                        )
                                    );
                                @endphp


                                @if(in_array($backExtension, ['jpg', 'jpeg', 'png']))

                                    <div class="mb-3">
                                        <img
                                            src="{{ asset('storage/' . $purchaseData->nid_back) }}"
                                            alt="NID Back"
                                            class="img-fluid rounded border"
                                            style="max-height: 300px;">
                                    </div>

                                @endif


                                <a href="{{ asset('storage/' . $purchaseData->nid_back) }}"
                                   target="_blank"
                                   class="btn btn-primary">

                                    <i class="bi bi-eye"></i>
                                    View NID Back

                                </a>

                            @else

                                <span class="text-muted">
                                    NID Back not uploaded
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

@endsection