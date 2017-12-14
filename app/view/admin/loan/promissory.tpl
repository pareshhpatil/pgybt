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
        <table  style="margin:0 auto; font-family:Verdana, Arial;max-width: 800px; border: solid 1px;" align="center" width="600" border="0" cellspacing="0" cellpadding="10" >
            <tr>
                <td style="font-size:15px; line-height:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="5" style="border-bottom:1px dashed #e2e2e2;">
                        <tr>
                            <td style="text-align: center;color:black;">
                                <img style="max-width: 799px;" src="/assets/admin/layout/img/pgybtbanner.jpg">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;color:black;">
                                <br>
                                <span onclick="javascript:window.print();" style="font-size:20px;font-weight:bold; "><u>PROMISSORY NOTE - CUM - RECEIPT</u> </span>  
                                <br>
                                <div style="float: right;height: 130px;width: 130px;border: solid 1px;">Photo</div>


                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;color:black;">

                                <div style="font-size:15px;float: right; ">Date : {{$det.date}|date_format:"%d-%b-%Y"}</div>


                            </td>
                        </tr>
                    </table>  </td>
            </tr>
            <tr>
                <td style="font-size:12px; line-height:20px;  border-bottom:1px #e2e2e2;">
                    <div style="float:left;  margin-right:5px;">
                        <table  border="0" cellspacing="0" cellpadding="5" style="font-size: 15px;font-weight: inherit;line-height: 20px;">
                            <tr>
                                <td> I, Mr. /Mrs. <b><u class="uppercase">{$cust.name} </u></b> An adult, Indian Inhabitant of Mumbai Residing at <u class="uppercase">  {$cust.address} </u> , do hereby state and declare as under</td>
                            </tr>
                            <tr>
                                <td> I hereby declare that of my bona-fide and urgent financial needs I have approached  M/s. PGYBT FINANCE ("LENDER"), Shop No. 6, behind Ayyappa Temple, Technical Area, Marol Pipeline, Andheri (E), Mumbai - 400 059 for finance, 
                                    and the lender agreed to advance Misc ("LOAN") Account No: <b>{$det.loan_number}</b> Rs.<b>{$det.loan_amount}/-</b> (Rupees In words:- {$money_word}) withe repayment duration 
                                    of <b>{$det.terms}</b> months interest rate of <b>{$det.intrest}%</b> per annum to be discharged by repayment of over monthly EMI's / interest on monthly basis and capital 
                                    outstanding on expiry of {$det.terms} months or at the earlier date as may be mutually agreed. On the event of my failure to repay the above Loan amount to Lender, the Lender 
                                    shall be at liberty to institute any suitable legal action/steps against me for the recovery of their loan including legal costs that may be incurred for the recovery thereof 
                                    and I will be solely responsible for the same.
                                </td>
                            </tr>
                            <tr>
                                <td> I do hereby PROMISE, SWEAR AND UNDERTAKE to repay the said loan along with interest and other legal costs to the Lender from my own Pocket, Income & gains with due responsibility and without delay, default or any hindrance, consequences, and I am personally responsible and bind myself under the terms of this promissory note. </td>
                            </tr>
                            <tr>
                                <td> I Mr. /Mrs <u class="uppercase">{$cust.name}</u> solemnly declare on this day of that whatsoever started and written hereinabove are true and correct to best of my knowledge and understanding and are binding upon me.</td>
                            </tr>

                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="font-size:15px; line-height:30px;"><table width="100%" border="0" cellspacing="0" cellpadding="5" style="">
                        <tr>
                            <td style="text-align: center;color:black;">
                                <span style="font-size:20px; margin-left: 120px; ">(Declarant) </span> 
                                <span style="font-size:20px;float: right;margin-right: 70px; ">Deponent </span>  
                                <br>


                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;color:black;border-bottom:1px solid;">

                                <div style="font-size:15px;float: left; ">Identified by me,</div>


                            </td>
                        </tr>

                        <tr>
                            <td style="text-align: center;color:black;">

                                <div style="font-size:15px;float: left; ">Advocate,</div>

                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>  </td>
            </tr>

        </table>

    </body>
</html>