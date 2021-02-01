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
                                            bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
                                            <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">ORDER #{{$order_number}}</p>
                                            <p style="font-weight: 400; font-size: 14px; margin-bottom: 20px;">{{$billing_date}}</p>

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