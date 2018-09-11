<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet" type="text/css">
    <style>
        body {
            font-family: montserrat, sans-serif;
        }
        .container-body{
            padding: 30px;
        }

        .title span {
            font-size: 16px;
            color: #242424;
            letter-spacing: -0.48px;
            font-weight:bold;
        }
        .header{
            text-align: center;
        }
        .addresses{
            display: flex;
            flex-direction: row;
            margin-top: 20px;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        .shipped-payment{
            display: flex;
            flex-direction: row;
            margin-top: 15px;
        }
        .shipped-payment .field-value{
            font-weight: bold;
        }
        .shipping-addrerss {

            line-height: 25px;
        }
        .shipping-addrerss .title{
            font-weight: bold;
        }
        .billing-address {
            line-height: 25px;
        }
        .billing-address .title{
            font-weight: bold;
        }
        .shipped-detail{
            width:50%;
            height:auto;
            line-height: 25px;
        }
        .contact{
            margin-bottom: 40px;
        }
        .field-value{
            font-weight: bold;
        }
        .payment-detail{
            width:50%;
            height:auto;
            line-height: 25px;
        }
        .container-body p{
            font-size: 16px;
            color: #5E5E5E;
            letter-spacing: 0;
            line-height: 24px;
        }
        .heading{
            font-size: 20px;
            color: #242424;
            letter-spacing: 0;
            line-height: 30px;
            margin-bottom: 34px;
        }
        .heading-sub{
            margin-bottom: 20px !important;
        }
        .heading span{
            font-weight: bold;
        }
        .heading p{
            font-size: 16px;
            letter-spacing: 0;
            line-height: 24px;
            color: #5E5E5E;
        }
        .section{
            width:50%;
            font-size: 16px;
            color: #242424;
            letter-spacing: -0.26px
        }
        .section p{
            font-size: 16px;
            color: #242424;
            letter-spacing: -0.26px;
        }
        .firstsection{
            position: absolute;
        }
        .secondsection{
            float: right;
        }
        .section span{
            style=font-size: 16px;
            color: #121212;
            letter-spacing: 0;
            line-height: 25px;
        }


        .subitem{
            margin-top: 3px;
            margin-bottom: 30px;
        }
        .productbox{
            background: #FFFFFF;
            border: 1px solid #E8E8E8;
            border-radius: 3px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
        }

        .productdetail{
            float:right;
            width:70%;
            line-height: 25px;
        }
        .details-info{
            font-size: 16px;
            color: #242424;
            letter-spacing: -0.26px;
        }
        .productdetail p{
            font-size: 18px;
            color: #242424;
            letter-spacing: -0.43px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .productdetail label{
            font-size: 16px;
            color: #5E5E5E;
            letter-spacing: -0.26px;
        }
        .productdetail span{
            font-size: 18px;
            color: #242424;
            letter-spacing: -0.43px;
            margin-left: 40px;
            font-weight: bold;
        }
        .productimg img{
            padding: 25px;
            height: 150px;
            width: 150px;
        }
        .coupon-discount{
            margin-bottom: 24px;
        }
        .other-content{
            margin-top: 65px;
            font-size: 16px;
            color: #5E5E5E;
            letter-spacing: 0;
            line-height: 24px;
        }
        .details span{
            font-size: 16px;
            color: #5E5E5E;
            letter-spacing: 0;
            line-height: 24px;
        }
        .hr{
            width: 100%;
            height: 1px;
            vertical-align: middle;
            background: #E8E8E8;
            margin-top: 132px;
        }

        .product-total{
            font-size: 16px;
            color: #242424;
            letter-spacing: -0.38px;
            line-height: 30px;
            float: right;
            width: 40%;
        }
        .product-total .vlaue{
            float: right;
        }
        .bnt-default{
            background-color: blue;
            height: 35px;
            color: white;
            font-size: 15px;
            opacity: 92%;
            border: 0;
        }
    </style>
</head>
<body>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
    <div class="wrapper" style="width: 56%;margin-left: auto;margin-right: auto;">
        <div class="header">
                {{ $header ?? '' }}
        </div>
        <div class="body">
                {{ Illuminate\Mail\Markdown::parse($slot) }}

                {{ $subcopy ?? '' }}
        </div>
    </div>

</body>
</html>
