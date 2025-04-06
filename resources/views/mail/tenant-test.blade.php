<!DOCTYPE html>
<html lang="es" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
  <meta charset="utf-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no, url=no">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <style>
    .hover-bg-slate-800:hover {
      background-color: #1e293b !important;
    }
    @media (max-width: 600px) {
      .sm-p-6 {
        padding: 24px !important;
      }
      .sm-px-4 {
        padding-left: 16px !important;
        padding-right: 16px !important;
      }
      .sm-px-6 {
        padding-left: 24px !important;
        padding-right: 24px !important;
      }
    }
  </style>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', Arial, sans-serif !important;
    }
</style>
@php
    tenancy()->initialize($tenant);
@endphp
</head>
<body style="font-family: 'Poppins', Arial, sans-serif; margin: 0; width: 100%; background-color: #f8fafc; padding: 0; -webkit-font-smoothing: antialiased; word-break: break-word">
  <div role="article" aria-roledescription="email" aria-label lang="en">
    <div class="sm-px-4" style="background-color: #f8fafc">
      <table align="center" style="margin: 0 auto; font-family: Poppins, sans-serif" cellpadding="0" cellspacing="0" role="none">
        <tr>
          <td style="width: 552px; max-width: 100%">
            <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;</div>
            <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
              <tr>
                <td class="sm-p-6" style="border-radius: 8px; background-color: #fffffe; padding: 24px 36px; border: 1px solid #e2e8f0">
                  <a href="https://maizzle.com">
                    <img src="{{ tenant()->logo() }}" width="180" alt="Maizzle" style="max-width: 100%; vertical-align: middle">
                  </a>
                  <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;</div>
                  <h1 style="margin: 0 0 24px; font-size: 24px; line-height: 32px; font-weight: 600; color: #0f172a">
                    {{ tenant('ecommerce_name') }}
                  </h1>
                  <p style="margin: 0 0 24px; font-size: 16px; line-height: 24px; color: #475569">
                    We're happy to have you on board! Please verify your email address in order to activate your account:
                  </p>
                  <div>
                    <a href="https://maizzle.com" style="display: inline-block; text-decoration: none; padding: 16px 24px; font-size: 16px; line-height: 1; border-radius: 4px; color: #fffffe; background-color: #020617" class="hover-bg-slate-800">
                      <span style="mso-text-raise: 16px">Verify email</span>
                    </a>
                  </div>
                  <div role="separator" style="line-height: 24px; `mso-line-height-alt: ${msoHeight}` }}">&zwj;</div>
                  <p style="margin: 0; font-size: 16px; line-height: 24px; color: #475569">
                    Thanks,
                    <br>
                    <span style="font-weight: 600">Maizzle</span>
                  </p>
                  <div role="separator" style="height: 1px; line-height: 1px; `background-color: ${color}; `margin-top: ${spaceY}; margin-bottom: ${spaceY}; `margin-left: ${spaceX}; margin-right: ${spaceX}; `margin-bottom: ${bottom}; `margin-right: ${right}` }}` }}` }}` }}` }}` }}` }}">&zwj;</div>
                  <p class="mso-break-all" style="margin: 0; font-size: 12px; line-height: 20px; color: #475569">
                    If you're having trouble clicking the "Verify email" button, copy and paste the following URL into your web browser:
                    <a href="https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0" style="color: #1e293b; text-decoration: underline">https://maizzle.com/?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0</a>
                  </p>
                </td>
              </tr>
            </table>
            <table style="width: 100%" cellpadding="0" cellspacing="0" role="none">
              <tr>
                <td class="sm-px-6" style="padding: 24px 36px">
                  <p style="margin: 0; text-align: center; font-size: 12px; color: #64748b">
                    &copy; 2025 Maizzle. All rights reserved.
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>