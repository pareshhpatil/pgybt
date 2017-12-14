function calculatemaxamount() {
    amount = document.getElementById('gold_mrp').value;
    max_amount = (amount * 80) / 100;
    document.getElementById('max_loan_amt').value = max_amount;
}

function calculateprocAmount() {
    amount = document.getElementById('loan_amount').value;
    proc_amount = (amount * 2) / 100;
    document.getElementById('proc').value = proc_amount;
}

function showemi() {
    var princ = document.getElementById('loan_amount').value;
    var term = document.getElementById('term').value;
    var intrest = document.getElementById('intrest').value;
    if ((princ == null || princ.length == 0) ||
            (term == null || term.length == 0)
            ||
            (intrest == null || intrest.length == 0))
    {
    }
    else
    {
        var intr = intrest / 1200;
        var emi = princ * intr / (1 - (Math.pow(1 / (1 + intr), term)));
        document.getElementById('installment').value = emi.toFixed(2);
        showterms();
    }

// payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))

}


function calculateLoanTerms()
{

    showterms();
    emi = document.getElementById('installment').value;
    if (emi > 0)
    {
    } else
    {
        emi = 0;
    }
    proc = document.getElementById('proc').value;
    if (proc > 0)
    {
    } else
    {
        proc = 0;
    }

}




function calculateLoan()
{
    calculateprocAmount();
    showemi();
    emi = document.getElementById('installment').value;
    if (emi > 0)
    {
    } else
    {
        emi = 0;
    }
    proc = document.getElementById('proc').value;
    if (proc > 0)
    {
    } else
    {
        proc = 0;
    }
}

function showterms()
{
    var princ = 0;
    var amt = document.getElementById('loan_amount').value;
    var installment = document.getElementById('installment').value;
    var emi = document.getElementById('installment').value;
    var intrest = document.getElementById('intrest').value;
    var term = 0;
    var endbalance = 0;
    var cum_intrest = 0;
    if ((amt == null || amt.length == 0) ||
            (installment == null || installment.length == 0)
            ||
            (intrest == null || intrest.length == 0))
    {
    }
    else
    {

        var k = 0;
        while (amt > 0)
        {


            intrestamt = (amt * intrest / 100) / 12;
            princi = installment - intrestamt;
            cum_intrest = cum_intrest + intrestamt;
            endbalance = amt - princi;


            if (installment < emi)
            {
                //  today = today.addMonths(1);
                endbalance = 0;
            }
            amt = endbalance;
            if (amt < installment)
            {

                installment = amt;
            }
            k = k + 1;
        }

        document.getElementById('term').value = k;
        try {
            document.getElementById('total_intrest').value = cum_intrest.toFixed(2);
        } catch (e) {
        }
    }
}