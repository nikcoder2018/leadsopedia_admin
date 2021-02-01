<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700" rel="stylesheet" media="screen">
    <style>
        .hover-underline:hover {
            text-decoration: underline !important;
        }
        
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        @keyframes ping {
            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        @keyframes pulse {
            50% {
                opacity: .5;
            }
        }
        
        @keyframes bounce {
            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: none;
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
        
        @media (max-width: 600px) {
            .sm-px-24 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
            .sm-py-32 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }
            .sm-w-full {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased;">
    <div role="article" aria-roledescription="email" aria-label="" lang="en">
        <table style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center" style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(236, 239, 241, var(--bg-opacity))">
                    <table class="sm-w-full" style="font-family: 'Montserrat',Arial,sans-serif; width: 800px;" width="800" cellpadding="0" cellspacing="0" role="presentation">
                        <tr>
                            <td class="sm-py-32 sm-px-24" style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; padding: 48px; text-align: center;" align="center">
                                <a href="{{env('APP_URL')}}">
                                    <img src="{{asset(env('APP_THEME').'/images/logo-new-full.svg')}}" width="155" alt="Leadsopedia Logo" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;">
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="sm-px-24" style="font-family: 'Montserrat',Arial,sans-serif;">
                                <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                    <tr>
                                        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));"
                                            bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                                            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">ORDER #{{$order_number}}</p>
                                            <p style="font-weight: 400; font-size: 14px; margin-bottom: 20px;">{{$billing_date}}</p>

                                            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey!</p>
                                            <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #ff5850; color: rgba(255, 88, 80, var(--text-opacity));">{{$name}}!</p>
                                            <p style="margin: 0 0 24px;">
                                                Thanks for using Leadsopedia. This is the receipt for your recent order.
                                            </p>
                                            <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                <tr>
                                                    <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding: 16px; padding-left: 0; vertical-align:top">
                                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px;">
                                                                    <strong>Receipt to:</strong>
                                                                    <p>
                                                                        {{$to['name']}} <br>
                                                                        {{$to['email']}}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px; padding: 16px; padding-right: 0">
                                                        <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                                            <tr>
                                                                <td style="font-family: 'Montserrat',Arial,sans-serif; font-size: 14px;">
                                                                    <strong>Receipt from:</strong>
                                                                    <p>Leadsopedia Limited</p>
                                                                    <p>
                                                                        <strong>Office</strong> <br>
                                                                        Suite 9, 2 Bicycle Mews, London, SW46FE <br>
                                                                        United Kingdom <br>
                                                                        <strong>Company Number:</strong> 13145058
                                                                    </p>
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
                                            <p style="font-size: 14px; line-height: 24px; margin-top: 6px; margin-bottom: 20px; text-align:center;">
                                                The US${{$total}} payment will appear on your bank/card statement as:<br><strong>Leadsopedia Limited</strong>

                                            </p>
                                            <p style="font-size: 14px; line-height: 24px; margin-top: 6px; margin-bottom: 30px;">
                                                If you have a problem with your order (e.g. don’t recognise the charge, suspect a fraudulent transaction), please contact us at (insert email, phone number).
                                            </p>
                                            
                                            <p style="font-size: 13px; line-height: 24px; margin-top: 6px; margin-bottom: 20px;">
                                                <i>
                                                    Leadsopedia Limited is a company registered in England and Wales,  <br>
                                                    Suite 9, 2 Bicycle Mews, London, SW46FE, United Kingdom www.leadsopedia.com
                                                </i>
                                            </p>
                                            <p style="font-size: 13px; line-height: 24px; margin-top: 6px; margin-bottom: 20px;">
                                                <i>This is an automated response and is highly confidential. Please disregard if received in error. Distributing all or any part of this email through any means is illegal. The sender of this email shall not be liable for any damage caused by any action of the receiver. Should you need assistance please contact support@leadsopedia.com</i>
                                            </p>
                                            <p style="font-size: 12px; line-height: 24px; margin-top: 6px; margin-bottom: 20px;">Leadsopedia Limited, Suite 9, 2 Bicycle Mews, London, SW4 6FE, United Kingdom © 2021 Leadsopedia. All rights reserved.</p>
                                
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