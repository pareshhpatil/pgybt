function responseType(type)
{

    if (type == 1)
    {
        document.getElementById('bank_transaction_no').style.display = 'block';
        document.getElementById('cheque_no').style.display = 'none';
        document.getElementById('cash_paid_to').style.display = 'none';
        $('#bank_transaction_no').prop('required', true);
        $('#cheque_no').prop('required', false);
        $('#cash_paid_to').prop('required', false);

    }
    else if (type == 2)
    {
        document.getElementById('bank_transaction_no').style.display = 'none';
        document.getElementById('cheque_no').style.display = 'block';
        document.getElementById('cash_paid_to').style.display = 'none';
        $('#bank_transaction_no').prop('required', false);
        $('#cheque_no').prop('required', true);
        $('#cash_paid_to').prop('required', false);

    }
    else if (type == 3)
    {
        document.getElementById('bank_transaction_no').style.display = 'none';
        document.getElementById('cheque_no').style.display = 'none';
        document.getElementById('cash_paid_to').style.display = 'block';
        $('#bank_transaction_no').prop('required', false);
        $('#cheque_no').prop('required', false);
        $('#cash_paid_to').prop('required', true);

    }
}

function flexible() {
    if ($('#is_flexible').is(':checked')) {
        $("#flixible_div").slideDown(500).fadeIn();
        $("#nonflixible_div").slideDown(500).fadeOut();
        $('#unitcost').prop('required', false);
        $('#min_price').prop('required', true);
        $('#max_price').prop('required', true);
    } else {
        $("#nonflixible_div").slideUp(500).fadeIn();
        $("#flixible_div").slideUp(500).fadeOut();
        $('#unitcost').prop('required', true);
        $('#min_price').prop('required', false);
        $('#max_price').prop('required', false);
    }
}

function updateRespond(respondId)
{
    document.getElementById('paymentresponse_id').value = respondId;
    document.getElementById("myForm").submit();
}