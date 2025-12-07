@extends('layouts.app')

@section('title', 'Campaign Form')

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h1 class="form-title">Campaign Form</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data" novalidate="novalidate"
                id="campaignForm" class="campaign-form">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                placeholder="Enter phone number">
                            @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="campaign_number" class="form-label">Campaign Number</label>
                            <input type="text" id="campaign_number" name="campaign_number" class="form-control"
                                placeholder="Enter campaign number">
                            @error('campaign_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label class="checkbox-label">
                                <input type="checkbox" id="active" name="active" class="form-checkbox" value="1">
                                <span class="checkbox-text">Active</span>
                            </label>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="submit-button">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
