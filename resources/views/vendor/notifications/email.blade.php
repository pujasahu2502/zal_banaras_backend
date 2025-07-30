<div style="padding:50px 0;margin:0;background-color:#fbfbfb;font-family: 'Lato',sans-serif;max-width: 680px;margin: 0 auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="font-family: 'Lato',sans-serif;">
        <tbody>
            <tr>
                <td style="border-top:3px solid #f4dd89;background-color:#fff;font-family: 'Lato',sans-serif;padding:30px;font-size:15px">
                    <table width="600" border="0" cellpadding="0" cellspacing="0" style="width:600px;margin:0 auto;background-color:#fff">
                        <tbody>
                            <tr>
                                <td align="center" style="text-align:center;padding-bottom:30px; border-bottom: 1px solid #f1f0f0;">
                                    <a href="#" style="text-decoration:none" target="_blank">
                                        <img alt="custom closet" src="http://dnz.c247.website/assets/img/new-logo.png" width="200" class="CToWUd">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Lato',sans-serif; padding-top: 30px;">
                                    <h1 style="text-align:center; color: #000; margin: 10px 0px 24px 0px; font-size:24px;">Reset Password Notification!</h1>
                                    <strong>Hi, <strong>{{ ucwords($user['first_name']) ?? '-' }} {{ ucwords($user['last_name']) ?? '-' }}</strong>!</strong>
                                    <br><br>
                                    You are receiving this email because we received a password reset request for your account.
                                    <br><br>
                                    @isset($url)
                                        <div>
                                            <a style="background-color:#f4dd89;color:#fff;font-size:18px;padding:10px 0;border:solid 1px #f4dd89!important;border-radius:4px;text-decoration:none;display:block;width:270px;text-align:center;font-weight:bold;margin:0 auto" href="{{ $url ?? '' }}" target="_blank">Reset Password</a>
                                        </div>
                                    @endisset
                                    <br><br>
                                    <p style="font-size: 14px; line-height: 1.5;margin: 0 0 10px;">This password reset link will expire in 60 minutes.</p>
                                    <p style="font-size: 14px; line-height: 1.5;margin: 0 0 10px;">If you did not request a password reset, no further action is required.</p>
                                    <p style="font-size:16px; line-height: 1.5;margin-bottom: 4px;">Thank you,</p>
                                    <p style="font-size:16px; line-height: 1.5;margin: 0 0 10px;">The DNZ Products Team</p>
                                    <p style="font-size:14px; line-height: 1.5;margin: 20px 0 10px;">You are urged to keep this information private, anyone with this information will be able to access your account. Your initial password has been system generated,  we recommend that you change it after you log in the first time.</p>    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center" style="text-align:center;color:#959595;padding-top:20px">
                    <table cellpadding="0" cellspacing="0" style="width:100%" width="100%">
                        <tbody>
                            <tr>
                                <td align="center" style="text-align:center;color:#959595;font-family: 'Lato',sans-serif;font-size: 13px;">
                                    Please do not reply to this email, this is an automatically generated message.
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="text-align:center;padding-top:5px;font-family: 'Lato',sans-serif;font-size: 11px;">
                                    <a href="{{ env('HOME_URL') }}" style="color:#959595" target="_blank">www.dnzproducts.com</a> | <a href="#" style="color:#959595" target="_blank">Terms &amp; Conditions</a> | <a href="#" style="color:#959595" target="_blank">Privacy Policy</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>