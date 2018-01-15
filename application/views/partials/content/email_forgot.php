<table class="" style="width:100%;font-size:0px;background:#d8e2e7;">
    <tbody>
    <tr>
        <td style="text-align:center;vertical-align:top;font-size:0;padding:1px;">
            <div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;">
                <table style="background:white;width:100%">
                    <tbody>
                    <tr>
                        <td style="font-size:0;padding:30px 30px 18px;">
                            <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:22px;line-height:22px;">
                                Permintaan Reset Password
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;padding:0 30px 16px;">
                            <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
                                Halo <b><?=$user['nama'];?></b>,<br>
                                Anda melakukan permintaan reset password dengan akun email <b><?=$user['email'];?></b>.
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;padding:0 30px 6px;">
                            <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
                                Silahkan klik tautan di bawah ini untuk melakukan pembaharuan password anda atau abaikan email ini jika anda tidak melakukan permintaan reset password.
                                <p>Email ini merupakan email robot, harap tidak membalas pesan email ke alamat email ini.</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;padding:8px 16px 10px;padding-bottom:16px;padding-right:30px;padding-left:30px;">
                            <table style="border:none;border-radius:25px;">
                                <tbody>
                                <tr>
                                    <td>
                                        <a href="<?=base_url('renew/'.$code);?>" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:25px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;font-weight:400;padding:8px 12px 9px;" target="_blank">Buat Password Baru</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:0;padding:0 30px 30px 30px;">
                            <div style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:14px;line-height:22px;">
                                Terima Kasih<br>
                                - noreply@risbang.bekraf.go.id
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>