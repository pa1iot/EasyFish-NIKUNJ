<style type="text/css">
    .coupon {
        color: #80cc93;
        font-size: 12px;
        font-weight: bold;
        margin: 0;
        padding: 0;
    }

    .body {
        font-family: "Raleway", sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 18px;
        color: #000;
    }

    .button {
        background-color: rgb(79, 168, 220);
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

    <title>Payment Notification Alert</title>
</head>

<body class="body">
<center><h3>Payment Success Notification</h3></center>
<table width="622" border="0" align="center" cellpadding="0" cellspacing="0"
       style="background:#f3f4f8; border:#d8d8d8 1px solid;">
    <tr>
        <td>
            <table width="622" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr></tr>
            </table>
        </td>
    </tr>
    <tr align="center" style="font-size:18px; font-family:Tahoma, Geneva, sans-serif;"></tr>
    <tr>
        <td>
            <center style="background-color: black;">
                <img
                    src="http://easyfish.in/public/storage/settings/161487555711.png"
                    style='padding: 15px;'/>
            </center>
        </td>
    </tr>
    <tr>
        <td height="1" style="padding: 10px;">
            <h3><b>Details : </b></h3>
            <?php
            echo '<br>';
            foreach ($record as $key => $value)
            {
                echo '<h3 style="margin: 10px;">'.$key.' : '.$value.'</h3>';

            }
            echo '<br>';
            ?>

        </td>
    </tr>
    <br><br>
    <tr>
        <td bgcolor="#f5f9f6" style="font-family:Arial, Helvetica, sans-serif;">
            <table width="622" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;">
                        Thanks & Regards <br />
                        Team EasyFish<br />
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>

<br/>
{{--{{$record['name']}}--}}
{{--{{date("M, d Y", strtotime($record['date']))}}--}}
