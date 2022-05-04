<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  
  <style>
    table, td, div, h1, p {
      font-family: Arial, sans-serif;
    }
    a{color:#c9970f !important; text-decoration: none!important}
    
    @media screen and (max-width: 530px) {
      .unsub {
        display: block;
        padding: 8px;
        margin-top: 14px;
        border-radius: 6px;
        background-color: #555555;
        text-decoration: none !important;
        font-weight: bold;
      }
      .col-lge {
        max-width: 100% !important;
      }
    }
    @media screen and (min-width: 531px) {
      .col-sml {
        max-width: 27% !important;
      }
      .col-lge {
        max-width: 73% !important;
      }
    }
  </style>
</head>
<body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">

    @php
    //$subjs = "this is the subject";
    //$htmlContent = "this is the content";
    @endphp

  <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ccc;">
    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
      <tr>
        <td align="center" style="padding:0;">
          
          <table role="presentation" style="width:94%;max-width:800px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
            <tr>
              <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                <a href="https://microfinancetrades.com/" style="text-decoration:none;"><img src="https://microfinancetrades.com/public/images/logo.png" width="165" alt="Logo" style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
              </td>
            </tr>
            <tr>
              <td style="padding:30px;background-color:#ffffff;">
                <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Welcome to Microfinance Trade</h1>

                <h4 style="font-weight:normal"><b>{{$subjs}}</b></h4>
                @if($pages == "register")
                    <p style='margin:0;'>Congratulations! You have successfully created an account with us.</p> 
                    <p style='margin:5px 0 5px 0;'>Here's your verification code <label style='font-size:18px'><b>{{$randStr}}</b></label></p> 
                    
                    <p style='margin:0;'>Copy the code above and paste it on the verification box on the platform and get activated.</p>
                @endif

                <p style="margin:30px 0 0 0;font-size:15px;">Trade with <a target="_blank" href="https://microfinancetrades.com/" style="color:#e50d70;">Microfinance Trade</a> and experience maximum security. Create an account with us and start trading</p>

                <div class="col-lge" style="display:inline-block;width:100%;max-width:395px;vertical-align:top;margin:15px 0 50px 0;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                  <p style="margin:0;"><a href="https://microfinancetrades.com/auth/signin" style="background: #c9970f; text-decoration: none; padding: 10px 25px; border-radius: 4px; display:inline-block; mso-padding-alt:0;color:#ffffff!important">
                  <span style="mso-text-raise:10pt;font-weight:bold;">Get Started Now</span></a></p>
                </div>
              </td>
            </tr>

            <tr>
              <td style="padding:15px 30px 10px 30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                <p style="margin:0 0 3px 0;"><a href="http://www.facebook.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/facebook_1.png" width="30" height="30" alt="facebook" style="display:inline-block;color:#cccccc;"></a> <a href="http://www.twitter.com/" style="text-decoration:none;"><img src="https://assets.codepen.io/210284/twitter_1.png" width="30" height="30" alt="twitter" style="display:inline-block;color:#cccccc;"></a></p>

                <p style="margin:-5px 0 0 0;font-size:14px;line-height:20px;">&reg; Microfinance Trade, 2022<br><a class="unsub" href="javascript:;" style="color:#cccccc;text-decoration:underline;">Unsubscribe instantly</a></p>
              </td>
            </tr>
          </table>
          
        </td>
      </tr>
    </table>
  </div>
</body>
</html>