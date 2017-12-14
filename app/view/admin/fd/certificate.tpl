<html>
    <head>
        <style>
            .uppercase {
                text-transform: uppercase;
            }

            .lowercase {
                text-transform: lowercase;
            }

            .capitalize {
                text-transform: capitalize;
            }
        </style>
    </head>
    <body>
        <table  style="margin:0 auto; font-family:Verdana, Arial;max-width: 800px;border: solid 1px;" align="center" width="600" border="0" cellspacing="0" cellpadding="10" >
            <tr>
                <td style="font-size:15px; ">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="">
                        <tr>
                            <td style="text-align: center;color:black;">
                                <img style="max-width: 799px;" src="/assets/admin/layout/img/pgybtbanner.jpg">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;color:black;">
                                <br>
                                <span onclick="javascript:window.print();" style="font-size:20px;font-weight:bold; "><u>PGYBT Finance FD Certificate</u> </span>  
                                <br>
                            </td>
                        </tr>

                    </table>  
                </td>
            <br>
            <br>
            </tr>

            <tr>
                <td style="font-size:12px; line-height:20px;  border-bottom:1px #e2e2e2;">
                    <div style="float:left;  margin-right:5px;width: 100%;">
                        <table  border="0" cellspacing="0" cellpadding="5" style="font-size: 15px;font-weight: inherit;line-height: 20px;width: 100%;">


                            <tr>
                                <td>
                                    <span>FD NO: <b>{$det.fd_number}</b> </span> 
                                    <span style="float: right; margin-right: 150px;">Group Name: PGYBT-LA</span>  
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Scheme : PGYBT {$det.terms/12} year FD
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <span>Received from : <b class="uppercase">{$cust.name} </b> </span> 
                                    <span style="float: right; margin-right: 150px;">Date : {{$det.date}|date_format:"%d-%b-%Y"}</span>  
                                    <br>
                                    <div style="float: left;margin-left: 53px;">Address:</div>  <div class="uppercase" style="max-width: 250px;margin-left: 123px;">{$cust.address}</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A sum of Rupees {$money_word} as Deposit on Terms & Conditions mentioned overleaf.
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <table border="1" cellpadding="0" cellspacing="0"  style="border-collapse:collapse;font-size:12px;line-height: 50px;text-align: center;">
                                        <tr>
                                            <th style="width: 130px;">
                                                Deposit Amount
                                            </th>
                                            <th style="width: 90px;">
                                                Period (M)
                                            </th>
                                            <th style="width: 120px;">
                                                Intrest P.a.(%)
                                            </th>
                                            <th style="width: 100px;">
                                                Intrest Amt
                                            </th>
                                            <th style="width: 110px;">
                                                Maturity Amt
                                            </th>
                                            <th style="width: 120px;">
                                                Effective Date
                                            </th>
                                            <th style="width: 120px;">
                                                Maturity Date
                                            </th>
                                        </tr>
                                        <tr >
                                            <td style="width: 130px;">
                                                {$det.fd_amount}
                                            </td>
                                            <td style="width: 90px;">
                                                {$det.terms}
                                            </td>
                                            <td style="width: 120px;">
                                                {$det.intrest}
                                            </td>
                                            <td style="width: 100px;">
                                                {$det.maturity_amount-$det.fd_amount}
                                            </td>
                                            <td style="width: 110px;">
                                                {$det.maturity_amount}
                                            </td>
                                            <td style="width: 120px;">
                                                {{$det.date}|date_format:"%d-%b-%Y"}
                                            </td>
                                            <td style="width: 120px;">
                                                {{$det.maturity_date}|date_format:"%d-%b-%Y"}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="">Payable on Maturity to Self </span>  
                                    <span style="float: right;margin-right: 150px;">For <b>PGYBT Finance</b> </span>  
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <br>
                                    <br>
                                    <span style="float: right;margin-right: 150px;">Authorised Signature </span> 
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                            </td>
                            </tr>
                            
                        </table>
                    </div>
                </td>
            </tr>


        </table>

    </body>
</html>