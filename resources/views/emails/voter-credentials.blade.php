<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Credenciales de votación</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td { font-family: Arial, Helvetica, sans-serif !important; }
    </style>
    <![endif]-->
    <style type="text/css">
        /* Reset styles */
        body, p, h1, h2, h3, ul, li { margin: 0; padding: 0; }
        body { width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
        table { border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        
        /* Mobile styles */
        @media only screen and (max-width: 620px) {
            .email-container { width: 100% !important; }
            .card-content { padding: 24px 18px !important; }
            .header-title { font-size: 15px !important; }
            .election-name { font-size: 20px !important; }
            .cred-value { font-size: 16px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; -webkit-font-smoothing: antialiased;">
@php
    $logoSrc = asset('logo-anacam.svg');
    if (isset($message) && method_exists($message, 'embed') && file_exists(public_path('logo-anacam.svg'))) {
        try {
            $logoSrc = $message->embed(public_path('logo-anacam.svg'));
        } catch (\Throwable $e) {
            $logoSrc = asset('logo-anacam.svg');
        }
    }
    $loginUrl = $loginUrl ?? url('/login');
    $supportEmail = $supportEmail ?? 'notificaciones@votacionancam.com';
    $host = parse_url($loginUrl, PHP_URL_HOST);
    $domainName = ($host && $host !== 'localhost' && $host !== '127.0.0.1') ? $host : 'votacionancam.com';
    $fullName = trim(($name ?? '') . ' ' . ($lastName ?? ''));
@endphp

<!-- Wrapper Table -->
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f6f8; width: 100%; margin: 0; padding: 0;">
    <tr>
        <td align="center" style="padding: 30px 12px;">
            <!-- Main Email Container Card -->
            <table role="presentation" class="email-container" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 16px; border: 1px solid #e5e7eb; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04); overflow: hidden;">
                <tr>
                    <td class="card-content" style="padding: 36px 36px 32px 36px;">
                        
                        <!-- Header / Logo -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="center" style="padding-bottom: 12px;">
                                    <img src="{{ $logoSrc }}" alt="Logo ANCAM" width="90" style="display: block; width: 90px; max-width: 90px; height: auto; margin: 0 auto;" />
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <h1 class="header-title" style="margin: 0; font-size: 16px; font-weight: 800; color: #111827; letter-spacing: 0.5px; text-transform: uppercase; line-height: 1.35; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        ASOCIACIÓN NACIONAL DE CARDIÓLOGOS DE MÉXICO
                                    </h1>
                                    <p style="margin: 4px 0 0 0; font-size: 14px; color: #4b5563; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Sistema de Votación
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 22px 0 20px 0;">
                                    <div style="height: 1px; background-color: #e5e7eb; line-height: 1px; font-size: 1px;">&nbsp;</div>
                                </td>
                            </tr>
                        </table>

                        <!-- Title & Greeting -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="center" style="padding-bottom: 16px;">
                                    <h2 style="margin: 0; font-size: 24px; font-weight: 700; color: #0f172a; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Credenciales de votación
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-bottom: 6px;">
                                    <p style="margin: 0; font-size: 15px; color: #374151; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Hola {{ $fullName }},
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-bottom: 10px;">
                                    <p style="margin: 0; font-size: 15px; color: #4b5563; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Has sido habilitado para participar en la elección:
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-bottom: 28px;">
                                    <h3 class="election-name" style="margin: 0; font-size: 22px; font-weight: 800; color: #bd1622; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.3; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        {{ $electionName }}
                                    </h3>
                                </td>
                            </tr>
                        </table>

                        <!-- Credentials List -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 28px;">
                            <!-- Email -->
                            <tr>
                                <td style="padding: 10px 0;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td valign="middle">
                                                <div style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 2px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    Correo electrónico
                                                </div>
                                                <div style="font-size: 15px; color: #2563eb; font-weight: 500; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; word-break: break-all;">
                                                    {{ $email }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Password -->
                            <tr>
                                <td style="padding: 10px 0;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td valign="middle">
                                                <div style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 2px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    Contraseña temporal
                                                </div>
                                                <div class="cred-value" style="font-size: 18px; font-weight: 700; color: #111827; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; letter-spacing: 1.5px;">
                                                    {{ $password }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- Voter Code -->
                            <tr>
                                <td style="padding: 10px 0;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td valign="middle">
                                                <div style="font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 2px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    Código de votante
                                                </div>
                                                <div class="cred-value" style="font-size: 18px; font-weight: 700; color: #111827; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace; letter-spacing: 1.5px;">
                                                    {{ $voterCode }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- CTA Button -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px;">
                            <tr>
                                <td align="center">
                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;">
                                        <tr>
                                            <td align="center" style="background-color: #bd1622; border-radius: 8px;">
                                                <a href="{{ $loginUrl }}" target="_blank" style="display: inline-block; padding: 14px 38px; font-size: 16px; font-weight: 700; color: #ffffff; text-decoration: none; border-radius: 8px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    <span style="display: inline-block; vertical-align: middle; margin-right: 6px; font-size: 18px;">&rarr;</span> Iniciar sesión
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-top: 18px;">
                                    <p style="margin: 0 0 6px 0; font-size: 13px; color: #4b5563; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Si el botón no funciona, copia y pega la siguiente URL en tu navegador:
                                    </p>
                                    <a href="{{ $loginUrl }}" target="_blank" style="font-size: 14px; color: #2563eb; text-decoration: underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; word-break: break-all;">
                                        {{ $loginUrl }}
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <!-- Important Alert Box -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 28px 0 16px 0; background-color: #fefce8; border: 1px solid #fef08a; border-radius: 12px;">
                            <tr>
                                <td style="padding: 16px 18px;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td width="36" valign="top" style="padding-right: 14px; padding-top: 2px;">
                                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block;">
                                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                </svg>
                                            </td>
                                            <td valign="top">
                                                <div style="font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 6px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    Importante
                                                </div>
                                                <ul style="margin: 0; padding: 0 0 0 16px; font-size: 13px; color: #374151; line-height: 1.55; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    <li style="margin-bottom: 4px;">Debes cambiar tu contraseña después de iniciar sesión por primera vez.</li>
                                                    <li style="margin-bottom: 4px;">No compartas tus credenciales con nadie.</li>
                                                    <li>El código de votante es único e intransferible.</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Support Contact Box -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 24px; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                            <tr>
                                <td style="padding: 12px 16px;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td width="36" valign="middle" style="padding-right: 12px;">
                                                <div style="width: 32px; height: 32px; background-color: #eff6ff; border-radius: 50%; text-align: center; line-height: 32px;">
                                                    <table role="presentation" width="32" height="32" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td align="center" valign="middle">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: block;">
                                                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                            <td valign="middle">
                                                <p style="margin: 0; font-size: 13px; color: #374151; line-height: 1.45; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                                    Si tiene algún problema para ingresar,<br>contacte al administrador de la elección al correo <a href="mailto:{{ $supportEmail }}" style="color: #2563eb; text-decoration: none; font-weight: 500;">{{ $supportEmail }}</a>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Footer -->
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td align="center" style="padding-top: 8px;">
                                    <p style="margin: 0 0 4px 0; font-size: 12px; color: #6b7280; text-align: center; line-height: 1.5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                        Este es un correo automático del Sistema de Votación.<br>No respondas a este mensaje.
                                    </p>
                                    <p style="margin: 6px 0 0 0; text-align: center;">
                                        <a href="{{ $loginUrl }}" target="_blank" style="font-size: 13px; color: #6b7280; text-decoration: none; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
                                            🌐 {{ $domainName }}
                                        </a>
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
</body>
</html>
