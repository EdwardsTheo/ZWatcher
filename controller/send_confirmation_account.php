<?php

    session_start();

    $to      = 'thomasparis56@gmail.com';
    $subject = 'test Mail';
    //$message = 'Salut je teste des trucs';

    $message = "<html>
    <head>
      <meta name='viewport' content='width=device-width' />
      <meta http-equiv='content-type' charset='utf-8' content='text/html' />
      <title>ZWatcher</title>
      <style>
        @import url('https://fonts.googleapis.com/css?family=Noto+Sans|Poppins:400,600,700|Thasadith');
        body {
          width: 100%;
          background-color: #fff !important;
          margin: 0;
          padding: 0;
          -ms-text-size-adjust: 100%;
          -webkit-text-size-adjust: 100%;
          -firefox-text-size-adjust: 100%;
          font-family: 'Thasadith', sans-serif;
        }
        
        table {
          width: 100%;
          border-collapse: collapse;
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
        }
        table td {
          vertical-align: top;
        }
        
        /* -------------------------------------
            CONTAINER AND CONTENT
        ------------------------------------- */
        
        .container {
          display: block;
          margin: 0 auto !important;
          width-max: 580px;
          width: 100%;
          padding: 10px;
        }
        .content {
          display: block;
          margin: 0 auto !important;
          box-sizing: border-box;
          padding: 10px;
          max-width: 580px;
          width: 100%;
          background-color: #fff;
        }
        
        /* -------------------------------------
            HEADER MAIN AND FOOTER
        ------------------------------------- */
        .main_logo {
          display: block;
          margin: 0 auto !important;
          max-width: 160px;
          width: 80%;
        }
        
        .main_logo+p {
          text-align: center;
          font-size: .8em;
          margin-top: -10px;
          margin-bottom: 20px;
        }
        
        .hero_image {
          max-width: 580px;
          width: 100%;
          background-color: #fff;
        }
        
        .offer_image {
          max-width: 580px;
          width: 90%;
          background: #fff;
          display: block;
          margin: 10px auto;
        }
        
        .wrapper {
          box-sizing: border-box;
          padding: 20px; 
        }
        
        .message {
          text-align: left;
          padding: 30px;
          background-color: #f2f2f2;
          margin-top: -10px;
        }
        
         .message h1 {
          font-size: 1.5em;
          color: #000;
          font-family: 'Noto Sans', sans-serif;
        }
        
        .message p {
          color: #333;
          line-height: 1.4em;
          word-spacing: 2px;
        }
        
        .offer {
          margin-bottom: 35px;
        }
        
        .body_bottom {
          background-color: #f2f2f2;
          padding: 30px;
        }
        
        .social {
          margin-bottom: 30px;
        }
        
        .social tr {
          text-align: center;
          font-size: 1.333em;
        }
        
        .social_icon a img {
          width: 2em;
        }
        
        .footer, .footer_content {
          padding: 30px;
          background-color: #fff;
        }
        
        .footer_content {
          text-align: center;
          font-size: .7em;
          opacity: .6;
        }
        
         /* -------------------------------------
            BUTTON
        ------------------------------------- */
        .btn {
          box-sizing: border-box;
          width: 100%;
        }
        
        .btn tbody tr td {
          display: block;
          margin: 0 auto !important;
          text-align: center;
        }
        
        .btn tr td table tbody tr td {
          text-align:center;
          display: block;
          margin: 0 auto;
          width: 100%;
        }
        
        .btn a {
          display: inline-block;
          text-decoration: none;
          background-color: #88b5bf;
          padding: 10px 50px;
          margin: 0 auto;
          color: #fff;
          font-size: 1.333em;
          font-weight: bold;
          box-sizing: border-box;
          transition: background-color .3s, padding 1s;
        }
        
        .btn a:hover {
          background-color: #69cce0;
          padding: 10px 70px;
        }
        
        /* -------------------------------------
            OTHER STYLE
        ------------------------------------- */
        .preheader {
          color: transparent;
          visibility: hidden;
          mso-hide: all;
          display: none;
          overflow: hidden;
          opacity: 0;
          width: 0;
          height: 0;       
        }
        
        .hyperlink, .article {
          color: #88b5bf;
          font-weight: bold;
          text-decoration: none;
          transition: color .3s linear;
        }
        
        .underline {
          border-bottom-width: 1px;
          border-bottom-style: solid;
          border-bottom-color: #88b5bf;
          width: 130px;
          transition: color .3s linear;
        }
        
        .hyperlink:hover, .article:hover, .underline:hover {
          color: #69cce0;
          border-bottom-color: #69cce0;
        }
        
        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
          table[class=body] h1 {
            font-size: 28px !important;
            margin-bottom: 10px !important; 
          }
          table[class=body] p,
          table[class=body] ul,
          table[class=body] ol,
          table[class=body] td,
          table[class=body] span,
          table[class=body] a {
            font-size: 16px !important; 
          }
          table[class=body] .wrapper,
          table[class=body] .article {
            padding: 10px !important; 
          }
          table[class=body] .content {
            padding: 0 !important; 
          }
          table[class=body] .container {
            padding: 0 !important;
            width: 100% !important; 
          }
          table[class=body] .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important; 
          }
          table[class=body] .btn table {
            width: 100% !important; 
          }
          table[class=body] .btn a {
            width: 100% !important; 
          }
          table[class=body] .hero_image {
            height: auto !important;
            max-width: 100% !important;
            width: auto !important; 
          }
        }
  
        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
          .ExternalClass {
            width: 100%; 
          }
          .ExternalClass,
          .ExternalClass p,
          .ExternalClass span,
          .ExternalClass font,
          .ExternalClass td,
          .ExternalClass div {
            line-height: 100%; 
          }
          .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important; 
          }
          .btn-primary table td:hover {
            background-color: #34495e !important; 
          }
          .btn-primary a:hover {
            background-color: #34495e !important;
            border-color: #34495e !important; 
          } 
        }
      </style>
      
    </head>
    
    <body role='presentation' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>
            
            <!-- EMAIL CONTAINER -->
            <!-- PREVIEW TEXT FROM CLIENT -->
            <span class='preheader'>Email text preview from client.</span>
            
            <!-- EMAIL BODY -->
            <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='main'>
              <tbody>
                <tr>
                  <td align='wrapper'>
                    <!-- MAIN AREA -->
                    <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                      <td>
                        <tr>
                          <a href='https://anaheart.co.uk/' target='_blank' class='main_logo'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/ana_heart_logo.jpeg' class='main_logo'/></a>
                          <p>Elegance in high performance</p>
                          <img src='/images/graphismes/mail_ban.png' alt='img' class='hero_image'/>
                        </tr>
                        <tr>
                          <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                            <div class='message'>
                              <h1>How Yoga Helps You to Know Yourself</h1>
                              <p>Yoga is renowned for healing the body and mind. However, the holistic therapy has other benefits, too. When used regularly, yoga can help you get to know yourself on a deeper level through a series of simple steps. <br>In this article, we explore how yoga helps you to know yourself in more detail. Before you begin, we recommend picking up some comfortable yoga clothes to practice in. <br>Until the weather gets warmer, it’s best to wrap up in a thick <a href='https://anaheart.co.uk/hoodies' target='_blank' class='hyperlink'>yoga hoodie</a> to prevent your muscles from getting too cold.</p>
                              <table style='background-color:#f2f2f2;margin-top:-45px;'>
                                <th>
                                  <td style='padding-left: 23px;padding-bottom: 20px;'>
                                    <a href='https://anaheart.co.uk/blog/how-yoga-helps-you-to-know-yourself/' target='_blank' class='article'><h3 class='underline'>Read more about</a>
                                  </td>
                                </th>
                              </table>
                            </div>
                          </table>
                          <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='offer'>
                          <tr>
                            <td>
                              <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/offer-JAN20.jpg' class='offer_image'/>
                              <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='btn'>
                                <tr>
                                  <td>
                                    <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                                      <tbody>
                                        <tr>
                                          <td>
                                            <a href='#' target='_blank'>SHOP NOW</a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                      </table>
                          <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='body_bottom'>
                        <tr>
                          <td>
                            <table role='presentation' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                <td>
                                  <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/yoga_ana_heart3.jpg' class='hero_image' />
                                </td>
                              </tr>
                            </table>
                            <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='social'>
                              <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                              <tr><td>&nbsp;</td><td>FIND US ON</td><td>&nbsp;</td></tr>
                              <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                              <tr class='social_icon'>
                                <td>
                                  <a href='#'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/FB.png'/></a>
                                </td>
                                <td>
                                  <a href='#'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/IG-B.png'/></a>
                                </td>
                                <td>
                                  <a href='#'><img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/373860/TW-B.png'/></a>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <table role='presentation' border='0' cellspacing='0' cellpadding='0' class='footer'>
                        <tr>
                          <td>
                            <div class='footer_content'>
                              <p>Ana Heart - 58 Kinnerton Street - London SW1X 8ES, UK<br>
                              Because you subscribed to our newsletter, you will receive this email.<br>If you change your mind, just use <a href='#' style='text-decoration: none; color: initial;'>this link</a> to remove your email from the newsletters. You will be<br>automatically removed from our weekly update.<br>Ana Heart &copy; 2018</p>
                            </div>
                          </td>
                        </tr>
                      </table>
                        </tr>
                      </td>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </body>
  </html>";

    $headers = 'From: "ZWatcher"<noreply@zwatcher.com>' . "\r\n" .
    'Reply-To: noreply@zwatcher.com' . "\r\n" .
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n".
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    echo(error_get_last()['message']);

    
    header('location: ../view/profil.php?action=status');

?>