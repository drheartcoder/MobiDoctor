<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e(config('app.project.name')); ?></title>
</head>

<body style="background:#f5f6f8; margin:0px; padding:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#666; text-align:justify;">
    <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="padding:42px 0 8px 0; color: #858585; font-size:13px; letter-spacing: 1px;"><span style="font-size:11px;color#858585;margin-top:2px;vertical-align:top;">@</span><?php echo e(config('app.project.name')); ?></td>
                                <td style="padding:42px 0 8px 0;">
                                    <div style="float:right; padding-right:15px;">
                                        <img src="<?php echo e(url('/')); ?>/public/front/images/emailer-link.jpg" alt="link" style="vertical-align:middle;margin:-1px 2px 0 0;" /><a href="<?php echo e(url('/')); ?>" style="text-decoration:none; color: #88ba7b; font-size:13px;"> Visit website </a> </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="padding:0px;box-shadow:0 0 12px #e8e8e8;-webkit-box-shadow:0 0 12px #e8e8e8;-moz-box-shadow:0 0 12px #e8e8e8;border-radius:4px 4px 0 0;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="background: #88ba7b; /* Old browsers */
                                            background: -moz-linear-gradient(left,  #88ba7b 0%, #37a46e 100%); /* FF3.6-15 */
                                            background: -webkit-linear-gradient(left,  #88ba7b 0%,#37a46e 100%); /* Chrome10-25,Safari5.1-6 */
                                            background: linear-gradient(to right,  #88ba7b 0%,#37a46e 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                                            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#88ba7b', endColorstr='#37a46e',GradientType=1 ); /* IE6-9 */
                                             height: 115px; text-align:center;border-radius:4px 4px 0 0;"><a href="#" style=" line-height:101px; text-decoration:none; letter-spacing: 3px; color:#fff; 
                                                font-size:30px; font-weight:200;"><?php echo e(config('app.project.name')); ?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="40"></td>
                            </tr>



                            <tr>
                                <td style="text-align:center; padding:30px;color: #505050; line-height: 27px; font-size: 16px;"><?php echo $content; ?></td>
                            </tr>

                            <tr>
                                <td style="text-align:center; color:#808080; font-size:17px;">01/454-3687</td>
                            </tr>
                            <tr>
                                <td style="text-align:center; color:#8aba7d; font-size:13px;">info@mobiDoctor.com</td>
                            </tr>
                            <tr>
                                <td style="text-align:center; color:#7a7a7a; font-size:14px; padding:30px 0;">Get in touch if you have any question regarding our new project. Feel free<br /> to contect us 24/7. We are here to help.</td>
                            </tr>
                            <tr>
                                <td style="text-align:center; color:#7a7a7a; font-size:14px; padding-bottom:20px;"> All the best, <br /> @ <?php echo e(config('app.project.name')); ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>