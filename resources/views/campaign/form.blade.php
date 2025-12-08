@extends('layouts.app')

@section('title', 'حملاتنا الجديدة')

@section('content')
    <div class="inner-page">
        <div class="container">
            <div class="inner-body">
                <div class="inner-body-content">
                    <h1 class="inner-body-title">
                        لقيت المفاجأة؟
                    </h1>
                    <div class="inner-body-subtitle">
                        يلا، عبي معلوماتك وادخل
                        الســـحب عـلى آيفون 17 برو
                    </div>
                    <div class="inner-body-form">
                        <div id="alert-message"></div>
                        <form data-action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data"
                            novalidate="novalidate" id="validate-form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">رقم موبايلك</label>
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="campaign_number" class="form-label">الكود السرّي</label>
                                        <input type="text" id="campaign_number" name="campaign_number"
                                            value="{{ old('campaign_number') }}" class="form-control">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group d-flex justify-content-end">
                                        <button class="g-recaptcha btn btn-primary"
                                            data-sitekey="{{ config('services.captcha.site_key') }}"
                                            data-callback='onSubmit' data-action='submit' type="submit"
                                            id="register-submit">أدخل السحب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="inner-body-image">
                        <img src="{{ asset('assets/images/iphone.png') }}" alt="Iphone">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
