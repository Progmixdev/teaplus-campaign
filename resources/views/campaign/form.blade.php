@extends('layouts.app')

@section('title', 'حملاتنا الجديدة')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="inner-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="box">
                            <div class="inner-body-content">
                                <h1 class="inner-body-page-title">
                                    لا تفوت الفرصة! سجل الآن
                                </h1>
                                <div>
                                    <div id="alert-message"></div>
                                    <form data-action="{{ route('campaign.store') }}" method="POST"
                                        enctype="multipart/form-data" novalidate="novalidate" id="validate-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <input type="number" name="phone" value="{{ old('phone') }}"
                                                                placeholder="رقم الهاتف" class="form-control" required>
                                                        </div>
                                                        <div class="col-5">
                                                            <select name="phone_code" class="form-control">
                                                                <option value="+970" selected>970+</option>
                                                                <option value="+972">972+</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="campaign_number" class="form-label">رقم الحملة</label>
                                                    <input type="text" id="campaign_number" name="campaign_number"
                                                        value="{{ old('campaign_number') }}" class="form-control"
                                                        placeholder="أدخل رقم الحملة">

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button class="g-recaptcha btn btn-full btn-primary"
                                                        data-sitekey="{{ config('services.captcha.site_key') }}"
                                                        data-callback='onSubmit' data-action='submit' type="submit"
                                                        id="register-submit">سجل الان
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
