@extends('layouts.app')

@section('title', 'Purchase Data Manage | POS App')
@section('page_label', 'Purchase Data Manage')

@section('content')

<div class="container-fluid">

    <div class="information-entry">

        <h5 class="mb-3">
            Information Entry
        </h5>

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

        <form action="{{ route('purchase-data.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- LEFT COLUMN --}}
                <div class="col-md-6">

                    {{-- Name --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Name / 名前
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               required>
                    </div>


                    {{-- Gender --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Gender / 性別
                        </label>

                        <select name="gender"
                                class="form-select"
                                required>

                            <option value="Male"
                                {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                Male / 男
                            </option>

                            <option value="Female"
                                {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                Female / 女
                            </option>

                        </select>
                    </div>


                    {{-- Address --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Address / 住所
                        </label>

                        <input type="text"
                               name="address"
                               class="form-control"
                               value="{{ old('address') }}"
                               required>
                    </div>


                    {{-- Telephone --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Telephone / 電話番号
                        </label>

                        <input type="text"
                               name="telephone"
                               class="form-control"
                               value="{{ old('telephone') }}"
                               required>
                    </div>


                    {{-- NID Front --}}
                    <div class="mb-3">
                        <label class="form-label">
                            NID Front Photo / 身分証明書（表）
                        </label>

                        <input type="file"
                               name="nid_front"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                </div>


                {{-- RIGHT COLUMN --}}
                <div class="col-md-6">

                    {{-- Date --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Date / 日付
                        </label>

                        <input type="date"
                               name="date"
                               class="form-control"
                               value="{{ old('date') }}"
                               required>
                    </div>


                    {{-- Date of Birth --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Date of Birth / 生年月日
                        </label>

                        <input type="date"
                               name="date_of_birth"
                               class="form-control"
                               value="{{ old('date_of_birth') }}"
                               required>
                    </div>


                    {{-- Email --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Email Address / メールアドレス
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}">
                    </div>


                    {{-- Occupation --}}
                    <div class="mb-1">
                        <label class="form-label">
                            Occupation / 職業
                        </label>

                        <input type="text"
                               name="occupation"
                               class="form-control"
                               value="{{ old('occupation') }}">
                    </div>


                    {{-- NID Back --}}
                    <div class="mb-3">
                        <label class="form-label">
                            NID Back Photo / 身分証明書（裏）
                        </label>

                        <input type="file"
                               name="nid_back"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.pdf">
                    </div>

                </div>

            </div>


            {{-- Submit --}}
            <button type="submit"
                    class="btn btn-primary">

                Submit / 送信

            </button>

        </form>

    </div>

</div>

@endsection