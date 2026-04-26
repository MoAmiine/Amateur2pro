<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0;padding:0;background:#020617;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#020617;padding:40px 0;">
        <tr>
            <td align="center">

                <table width="480" cellpadding="0" cellspacing="0" style="background:#0f172a;border:1px solid rgba(255,255,255,0.1);">

                    <tr>
                        <td align="center" style="padding:40px 40px 0;">
                            <p style="margin:0;font-size:32px;font-weight:700;font-style:italic;color:#ffffff;letter-spacing:4px;">
                                A2<span style="color:#a855f7;">P</span>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:24px 40px 0;">
                            <p style="margin:0 0 8px;font-size:11px;text-transform:uppercase;letter-spacing:3px;color:#64748b;">
                                Tu as été invité à rejoindre
                            </p>
                            <p style="margin:0;font-size:36px;font-weight:700;text-transform:uppercase;letter-spacing:4px;color:#ffffff;">
                                {{ $invitation->team->name }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px 40px 0;">
                            <div style="border-top:1px solid rgba(255,255,255,0.1);"></div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding:32px 40px 40px;">
                            <a href="{{ route('teams.invite.show', $invitation->token) }}"
                               style="display:inline-block;padding:16px 48px;background:#9333ea;color:#ffffff;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:3px;text-decoration:none;">
                                Voir l'invitation
                            </a>
                        </td>
                    </tr>

                </table>

                <table width="480" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" style="padding:24px 0;">
                            <p style="margin:0;font-size:11px;color:#1e293b;text-transform:uppercase;letter-spacing:2px;">
                                Amateur2Pro — {{ date('Y') }}
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>