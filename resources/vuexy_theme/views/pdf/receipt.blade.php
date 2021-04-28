<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased;">
    <div role="article" aria-roledescription="email" aria-label="" lang="en">
        <table style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center" style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
                    <table class="sm-w-full" style="font-family: 'Montserrat',Arial,sans-serif; width: 700px;" width="700" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td align="center" class="sm-px-24" style="font-family: 'Montserrat',Arial,sans-serif;">
                                <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));"
                                            bgcolor="rgba(255, 255, 255, var(--bg-opacity))">
                                            <table style="width: 100%">
                                                <tr>
                                                    <td align="left">
                                                        <img src="{{asset(env('APP_THEME').'/images/logo-new-full.svg')}}" align="center" width="200" style="position: relative; left: -10px; top: -20px">
                                                    </td>
                                                    <td align="right" style="width: 100%">
                                                        <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Invoice #{{$order_number}}</p>
                                                        <p style="font-weight: 400; font-size: 14px; margin-bottom: 20px;">{{$billing_date}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            <p class="mb-0">Company #13145058</p>
                                            <p class="mb-0">Suite 9, 2 Bicycle Mews, London</p>
                                            <p class="mb-0">SW4 6FE, United Kingdom</p>
                                            <p class="mb-0">+44 20 7097 8642</p>
                                            <hr>
                                            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding: 16px; padding-left: 0; vertical-align:top">
                                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width:100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; width:70%">
                                                                    <h6>Invoice to:</h6>
                                                                    <p class="mb-0"><strong>{{$to['name']}} </strong></p>
                                                                    @if($to['company'] != null)<p class="card-text mb-0">{{$to['company']}}</p>@endif
                                                                    @if($to['address'] != null)<p class="card-text mb-0">{{$to['address']}}</p>@endif
                                                                    @if($to['website'] != null)<p class="card-text mb-0">{{$to['website']}}</p>@endif
                                                                    @if($to['email'] != null)<p class="card-text mb-0">{{$to['email']}}</p>@endif
                                                                </td>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; width:30%; text-align:left">
                                                                    <h6>Payment Details:</h6>
                                                                    <p class="card-text mb-0"><strong>Total Due</strong>: {{App\Setting::GetValue('currency_symbol')}}{{$total}}</p>
                                                                    <p class="card-text mb-0"><strong>Payment Gateway</strong>: {{$method}}</p>
                                                                    <p class="card-text mb-0"><strong>Status</strong>: {{$status}}</p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding: 16px; padding-right: 0">
                                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px;">
                                                                    
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td colspan="2" style="font-family: 'Montserrat',Arial,sans-serif;">
                                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <th style="padding-bottom: 8px;" width="40%">
                                                                    <p>Product</p>
                                                                </th>
                                                                <th  style="padding-bottom: 8px;" width="30%">
                                                                    <p>Billing Period</p>
                                                                </th>
                                                                <th  style="padding-bottom: 8px;" width="10%">
                                                                    <p>VAT</p>
                                                                </th>
                                                                <th style="padding-bottom: 8px;" width="20%">
                                                                    <p style="text-align: right;">Amount</p>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding-top: 10px; padding-bottom: 10px;">
                                                                    {{$items['name']}}
                                                                </td>
                                                                <td>{{$items['period']}}</td>
                                                                <td>${{$items['vat']}}</td>
                                                                <td align="right" style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; text-align: right;">${{$items['price']}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif;">
                                                                    <p align="right" style="font-weight: 700; font-size: 14px; line-height: 24px; margin: 0; padding-right: 16px; text-align: right;">
                                                                        Total
                                                                    </p>
                                                                </td>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif;">
                                                                    <p align="right" style="font-weight: 700; font-size: 14px; line-height: 24px; margin: 0; text-align: right;">
                                                                        ${{$total}}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>