<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
    <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>

<body>
<div class="es-wrapper-color">
    <!--[if gte mso 9]>
        <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
            <v:fill type="tile" color="#555555"></v:fill>
        </v:background>
    <![endif]-->
    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td class="esd-email-paddings" valign="top">
                    <table class="es-content esd-header-popover" cellspacing="0" cellpadding="0" align="center">
                        <tbody>
                            <tr>
                                <td class="esd-stripe" align="center">
                                    <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td class="esd-structure es-p20t es-p20b es-p10r es-p10l" style="background-color: #FFB300;" esd-general-paddings-checked="false" bgcolor="#FFB300" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-image" align="center" style="font-size:0">
                                                                                    <a target="_blank" href="{{ url('') }}">
                                                                                        <img class="adapt-img" src="{{ url('assets/images/logo-dark.png') }}" alt width="105">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #ffcc99;" bgcolor="#ffcc99" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p15t es-p15b" align="center">
                                                                                    <div class="esd-text">
                                                                                        <h2 style="color: #242424;">
                                                                                            <span style="font-size:30px;">
                                                                                                <strong>
                                                                                                    ร้าน {{ $shop->name }}
                                                                                                    
                                                                                                    {{-- <br>ขอขอบคุณที่ได้สั่งซื้อร้านของเรา --}}
                                                                                                </strong>
                                                                                            </span>
                                                                                            <br>
                                                                                        </h2>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10l" align="center">
                                                                                    <p style="color: #242424;">สวัสดี {{ $owner->name }}, คุณมีออเดอร์ใหม่เลขที่ № {{ $order->id }}.<br></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-button es-p15t es-p15b es-p10r es-p10l" align="center">
                                                                                    <span class="es-button-border" style="border-radius: 20px; background: #191919 none repeat scroll 0% 0%; border-style: solid; border-color: #2cb543; border-width: 0px;">
                                                                                        <a href="{{ \LKS::url_subdomain2('manage',$shop->url) }}" class="es-button" target="_blank" style="border-radius: 2px; font-family: lucida sans unicode,lucida grande,sans-serif; font-weight: normal; font-size: 18px; border-width: 10px 35px; background: #191919 none repeat scroll 0% 0%; border-color: #191919; color: #ffffff;">
                                                                                            คลิกเพื่อดูออเดอร์
                                                                                        </a>
                                                                                    </span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-structure es-p15t es-p10b es-p10r es-p10l" style="background-color: #f8f8f8;" esd-general-paddings-checked="false" bgcolor="#f8f8f8" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <h2 style="color: #191919;">รายการออเดอร์<br></h2>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            @foreach($items as $item)
                                            <tr style="margin-bottom: 100px">
                                                <td class="esd-structure es-p25t es-p5b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #f8f8f8;" bgcolor="#f8f8f8" align="left">
                                                    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                    <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-image" align="center" style="font-size:0">
                                                                                    <a target="_blank" 
                                                                                    href="{{ $item->product->get_direct_product() }}">
                                                                                        <img class="adapt-img" src="{{ $item->product->get_photo() }}" alt width="175">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <hr>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                    <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="left">
                                                                                    <p>
                                                                                        <span style="font-size:16px;">
                                                                                            <strong style="line-height: 150%;">
                                                                                                {{ $item->product_name }}
                                                                                            </strong>
                                                                                        </span>
                                                                                    </p>
                                                                                    @if ($item->product->info_full)
                                                                                        <p style="font-size:14px;color:#BBBBBB">&emsp;{{ $item->product->info_full }}</p>
                                                                                    @endif
                                                                                    @if ($item->product->info_short)
                                                                                        <p style="font-size:12px">&emsp;{{ $item->product->info_short }}</p>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p20t" align="left">
                                                                                    <p><span style="font-size:15px;"><strong style="line-height: 150%;">ราคาต่อหน่วย:</strong> {{ $item->price }}</span></p>
                                                                                    <p><span style="font-size:15px;"><strong>จำนวน: </strong>{{ $item->qty }}</span></p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td class="esd-structure es-p10t es-p10b es-p10r es-p10l" style="background-color: #f8f8f8;" esd-general-paddings-checked="false" bgcolor="#f8f8f8" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-spacer es-p20t es-p20b es-p10r es-p10l" bgcolor="#f8f8f8" align="center" style="font-size:0">
                                                                                    <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td style="border-bottom: 1px solid #191919; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p15b" align="center">
                                                                                    <table class="cke_show_border" width="240" height="101" cellspacing="1" cellpadding="1" border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <strong>ยอดรวม:</strong>
                                                                                                </td>
                                                                                                <td style="text-align: right;">
                                                                                                    {{ number_format($order->total,2) }}
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <strong>ค่าขนส่ง:</strong>
                                                                                                </td>
                                                                                                <td style="text-align: right;">{{ number_format($order->total_delivery,2) }}</td>
                                                                                            </tr>
                                                                                            {{-- <tr>
                                                                                                <td><strong>Sales Tax:</strong></td>
                                                                                                <td style="text-align: right;">$1.00</td>
                                                                                            </tr> --}}
                                                                                            <tr>
                                                                                                <td style="font-size: 18px; line-height: 200%;"><strong>ยอดสุทธิ:</strong></td>
                                                                                                <td style="text-align: right; font-size: 18px; line-height: 200%;"><strong>{{ number_format($order->total + $order->total_delivery ,2) }}</strong></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-structure es-p15t es-p10b es-p10r es-p10l" style="background-color: #eeeeee;" esd-general-paddings-checked="false" bgcolor="#eeeeee" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <h2 style="color: #191919;">ออเดอร์ & ที่จัดส่ง</h2>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="esd-structure es-p10t es-p30b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #eeeeee;" bgcolor="#eeeeee" align="left">
                                                    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                    <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" style="padding: 0px 10px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10t es-p10b" align="left">
                                                                                    <h3 style="color: #242424;">รายละเอียดออเดอร์</h3>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="left">
                                                                                    <p><strong>เลขที่ออเดอร์ №:</strong> {{ $order->id }}</p>
                                                                                    <p><strong>สั่งผ่าน:</strong> {{ $order->channel_id == 1 ? 'เว็บ' : 'หน้าเค้าเตอร์' }}</p>
                                                                                    <p><strong>จัดส่งโดย:</strong> {{ $order->get_delivery()->name }}</p>
                                                                                    <p><strong>จ่ายโดย:</strong> {{ $order->payment->name }}</p>
                                                                                    <p><strong>วันที่สั่ง:</strong> {{ \LKS::to_full_thai_date(date("Y-m-d")) }}</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                    <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" style="padding: 0px 10px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10t es-p10b" align="left">
                                                                                    <h3 style="color: #242424;">รายละเอียดผู้สั่งซื้อ</h3>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="left">
                                                                                    <p><strong>ชื่อผู้สั่งซื้อ: </strong>{{ $deli->name }}</p>
                                                                                    <p><strong>เบอร์ติดต่อ: </strong>{{ $deli->phone }}</p>
                                                                                    <p><strong>สถานที่จัดส่ง: </strong>
                                                                                    <br>{{ $deli->address.' '.$deli->province->name.' '.$deli->zipcode }}</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                            @if ($order->payment->id == 2)
                                            <tr>
                                                <td class="esd-structure es-p15t es-p10b es-p10r es-p10l" style="background-color: #f8f8f8;" esd-general-paddings-checked="false" bgcolor="#eeeeee" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="580" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <h2 style="color: #191919;">
                                                                                        วิธีชำระเงินโดยการโอน
                                                                                    </h2>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            <tr>
                                                <td class="esd-structure es-p25t es-p30b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #f8f8f8;" bgcolor="#f8f8f8" align="left">
                                                    
                                                    <table class="es-center" cellspacing="0" cellpadding="0" align="center">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="100%" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0" style="padding: 0px 10px;text-align:center">
                                                                        <tbody>
                                                                            @if ($payment_data)
                                                                                @foreach ($payment_data as $p)
                                                                            <tr>
                                                                                <td class="esd-block-text" align="left">
                                                                                    <p><strong>ธนาคาร: </strong>{{ $p->bank_name }}</p>
                                                                                    <p><strong>ชื่อบัญชี: </strong>{{ $p->account_name }}</p>
                                                                                    <p><strong>หมายเลขบัญชี: </strong>{{ $p->account_no }}</p>
                                                                                </td>
                                                                            </tr>
                                                                                @endforeach
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td class="esd-structure es-p25t es-p30b es-p20r es-p20l" esd-general-paddings-checked="false" style="background-color: #eeeeee;" bgcolor="#f8f8f8" align="left">
                                                    <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                    <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                        <tbody>
                                                            <tr>
                                                                <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10b" align="center">
                                                                                    <h3 style="color: #242424;">We're here to help</h3>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <p style="line-height: 150%; color: #242424;">Call <a target="_blank" style="line-height: 150%; " href="tel:123456789">123456789</a> or <a target="_blank" href="{{ url('') }}">visit us online</a></p>
                                                                                    <p style="line-height: 150%; color: #242424;">for expert assistance.</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                    <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="270" align="left">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10b" align="center">
                                                                                    <h3 style="color: #242424;">Our guarantee</h3>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <p style="line-height: 150%; color: #242424;">Your satisfaction is 100% guaranteed.</p>
                                                                                    <p style="line-height: 150%; color: #242424;">See our <a target="_blank" href="{{ url('') }}">Returns and Exchanges policy.</a></p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--[if mso]></td></tr></table><![endif]-->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="es-footer esd-footer-popover" align="center">
                        <tbody>
                            <tr>
                                <td class="esd-stripe" align="center" esd-custom-block-id="88703">
                                    <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" align="center">
                                        <tbody>
                                            <tr>
                                                <td class="esd-structure es-p20" esd-general-paddings-checked="false" align="left">
                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                    <table width="100%" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="esd-block-social es-p10t es-p20b" align="center" style="font-size:0">
                                                                                    <table class="es-table-not-adapt es-social" cellspacing="0" cellpadding="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                {{-- <td class="es-p15r" valign="top" align="center"><a href><img title="Twitter" src="https://stripo.email/cabinet/assets/editor/assets/img/social-icons/circle-gray/twitter-circle-gray.png" alt="Tw" width="32" height="32"></a></td>
                                                                                                <td class="es-p15r" valign="top" align="center"><a href><img title="Facebook" src="https://stripo.email/cabinet/assets/editor/assets/img/social-icons/circle-gray/facebook-circle-gray.png" alt="Fb" width="32" height="32"></a></td>
                                                                                                <td class="es-p15r" valign="top" align="center"><a href><img title="Youtube" src="https://stripo.email/cabinet/assets/editor/assets/img/social-icons/circle-gray/youtube-circle-gray.png" alt="Yt" width="32" height="32"></a></td>
                                                                                                <td valign="top" align="center"><a href><img title="Linkedin" src="https://stripo.email/cabinet/assets/editor/assets/img/social-icons/circle-gray/linkedin-circle-gray.png" alt="In" width="32" height="32"></a></td> --}}
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text" align="center">
                                                                                    <p><strong><a target="_blank" style="line-height: 150%;" href="{{ url('') }}">Browse all products</a>&nbsp;</strong>•<strong><a target="_blank" style="line-height: 150%;" href="{{ url('') }}">Locate store</a></strong></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" class="esd-block-text es-p20t es-p20b">
                                                                                    <p style="line-height: 120%;">Gohala, Inc.</p>
                                                                                    {{-- <p style="line-height: 120%;">62 N. Gilbert, CA 99999</p> --}}
                                                                                    <p style="line-height: 120%;"><a target="_blank" style="line-height: 120%;" href="tel:123456789">123456789</a></p>
                                                                                    <p style="line-height: 120%;"><a target="_blank" href="mailto:your@mail.com" style="line-height: 120%;">your@mail.com</a></p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="esd-block-text es-p10t es-p10b" align="center">
                                                                                    <p><em><span style="font-size: 11px; line-height: 150%;">You are receiving this email because you have visited our site or asked us about regular newsletter</span></em></p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>

</html>