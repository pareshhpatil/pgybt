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
                                <span onclick="javascript:window.print();" style="font-size:20px;font-weight:bold; "><u>RECEIPT</u> </span>  
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
                    <div style="float:left;  margin-right:5px;">
                        <table  border="0" cellspacing="0" cellpadding="5" style="font-size: 15px;font-weight: inherit;line-height: 20px;">
                            <tr>
                                <td> RECEIVED with thanks from LENDER PARTY <b>M/s. PGYBT FINANCE</b>, a sum of Rs. <b>{$det.loan_amount}/-</b> <br>(Rupees In words:- {$money_word}) being the PERSONAL LOAN on terms and conditions mutually agreed hereinbove.</td>
                            </tr>
                            <tr>
                                <td>
                            <tr>
                                <td>
                                    <span>Pay Type: {if !empty($cheque)}Cheque{else}Cash {/if} </span> 
                                    <span style="font-size:18px;float: right; "><b>I SAY RECEIVED RS. {$det.loan_amount}/-</b></span>  
                                </td>

                            </tr>
                            {if !empty($cheque)}
                                <tr>
                                    <td>
                                        BANK Name: {$cheque.bank_name}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Cheque No: {$cheque.cheque_number}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Cheque Date: {$cheque.cheque_date|date_format:"%d-%b-%Y"}
                                    </td>
                                </tr>
                            {/if}
                            <tr>
                                <td>
                                    <span style="font-size:18px;float: right; "><b>Mr/Mrs:- <b class="uppercase">{$cust.name} </b></b></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <b>We confirm the same.</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br>
                                    <span>Sign with seal</span> 
                                    <span style="margin-left: 180px; ">Witness: </span>  
                                    <span style="float: right;margin-right: 70px; ">Signature </span>  
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-left: 280px; ">1) Name : </span>  
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-left: 280px; ">2) Name : </span>  
                                </td>
                            </tr>
                            </td>
                            </tr>
                            <tr>
                                <td><br> <span style=""><b>Name of the Partner PGYBT FINANCE</b></span> </td>
                            </tr>
                            <tr>
                                <td><br> 1) Deepnarayan Pandey</td>
                            </tr>
                            <tr>
                                <td><br> 2) Ramavtar Gupta</td>
                            </tr>
                            <tr>
                                <td><br> 3) Santosh Yadav</td>
                            </tr>
                            <tr>
                                <td><br> 4) Deepak Boath</td>
                            </tr>
                            <tr>
                                <td><br> 5) Laxman Thakulla
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>


        </table>

    </body>
</html>