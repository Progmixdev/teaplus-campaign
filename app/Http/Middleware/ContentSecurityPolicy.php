<?php

namespace Juzaweb\Backend\Http\Middleware;

use Google\Service\BigtableAdmin\Frame;
use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;
use Spatie\Csp\Keyword;

class ContentSecurityPolicy extends Basic
{
    public function configure()
    {
        parent::configure();
        $this->addDirective('frame-src', 'https://recaptcha.google.com/recaptcha/');
        $this->addDirective('connect-src', 'https://www.google-analytics.com');
        $this->addDirective(Directive::SCRIPT, 'www.google.com/recaptcha/');
        $this->addDirective(Directive::SCRIPT, 'www.gstatic.com/recaptcha/');
        $this->addDirective('frame-src', 'www.google.com/recaptcha/');
        $this->addDirective('frame-src', 'recaptcha.google.com/recaptcha/');
        $this->addDirective('frame-src', 'self');
        $this->addDirective('img-src', 'self');
        $this->addDirective('img-src', 'data:'); // Allow data URIs for images
        $this->addDirective('font-src', 'self');
        $this->addDirective('font-src', 'data:'); // Allow data URIs for fonts
        $this->addDirective('font-src', 'https://fonts.googleapis.com');
        $this->addDirective('font-src', 'https://fonts.gstatic.com');
        $this->addDirective('frame-src', 'self');
    }
}
