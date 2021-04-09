@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">If you have a problem with your order (e.g. don’t recognize the charge, suspect a fraudulent transaction), please email us at info@leadsopedia.com or call us at +44 20 7097 8642. </p>
                                            <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">Leadsopedia Limited is a company registered in England and Wales, Suite 9, 2 Bicycle Mews, London, SW46FE, United Kingdom.</p>
                                            <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">This is an automated response and is highly confidential. Please disregard if received in error. Distributing all or any part of this email through any means is illegal. The sender of this email shall not be
                                                liable for any damage caused by any action of the receiver. Should you need assistance please contact support at +44 20 7097 8642 or info@leadsopedia.com. Leadsopedia Limited, Suite 9, 2 Bicycle Mews, London,
@endcomponent
@endslot
@endcomponent
