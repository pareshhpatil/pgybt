

function calculatefdmaturity()
{
    var amount = document.getElementById('fd_amount').value;
    var intrest = document.getElementById('intrest').value;
    var terms = document.getElementById('terms').value;
    if (amount > 0)
    {
        amount = Number(amount);
    } else {
        amount = 0;
    }
    if (intrest > 0)
    {
        intrest = Number(intrest);
    } else {
        intrest = 0;
    }
    if (terms > 0)
    {
        terms = Number(terms);
    } else {
        terms = 0;
    }

    var year = Number(terms / 12);
    var maturity = (amount * intrest / 100) * year + amount;
    document.getElementById('maturity_amount').value = maturity.toFixed(2);

}


function calculateRdmaturityghgh() {
    var p = document.getElementById('rd_amount').value;
    var r = document.getElementById('intrest').value;
    var t = document.getElementById('terms').value;
    var n = 12;


    var amount_array = [];
    var x = calculate_x(r, n);

    for (var i = t; i >= 1; i--) {
        a = p * Math.pow(x, n * calculate_months_in_year(i));
        console.log(a);
        amount_array.push(a);
    }
    var maturity_amount = amount_array.reduce(function(previousValue, currentValue, index, array) {
        return previousValue + currentValue;
    });
    console.log(maturity_amount);
    document.getElementById("maturity_amount").value = Math.round(maturity_amount);
}

// var x = (1+r/n)
function calculate_x(r, n) {
    var x = 1 + (r / 100) / n;
    console.log(x);
    return x;
}
// var y = (1+r/n)^nt
// function calculate_y(x,n,t){
//  return Math.pow(x,n*calculate_months_in_year(t));
// }

// var t_in_y = t/12; time expressed in year
function calculate_months_in_year(t) {
    return t / 12;
}




function calculateRdmaturity()
{
    var amount = document.getElementById('rd_amount').value;
    var intrest = document.getElementById('intrest').value;
    var terms = document.getElementById('terms').value;
    try {
        var date = document.getElementById('date').value;
    } catch (o)
    {
    }
    if (amount > 0)
    {
        amount = Number(amount);
    } else {
        amount = 0;
    }
    if (intrest > 0)
    {
        intrest = Number(intrest);
    } else {
        intrest = 0;
    }
    if (terms > 0)
    {
        terms = Number(terms);
    } else {
        terms = 0;
    }
    var data = '';
    var jsonas = '{"terms":"' + terms + '","intrest":"' + intrest + '","rd_amount":"' + amount + '","date":"' + date + '"}';
    $.ajax({
        type: 'GET',
        url: '/admin/rd/getcalculation/' + jsonas,
        data: data,
        success: function(data)
        {
            obj = JSON.parse(data);
            document.getElementById("maturity_amount").value = obj.maturity;
            try {
                document.getElementById("total_amount").value = obj.total;
                document.getElementById('schedule').innerHTML = obj.table;
            } catch (o) {
            }

        }
    });
}


function rd_calculate()
{
    calculateRdmaturity();
    var amount = document.getElementById('rd_amount').value;
    var terms = document.getElementById('terms').value;

    document.getElementById('total_amount').value = amount * terms;
}

function getplandetails(type, value)
{

    var data = $("#add").serialize();
    $.ajax({
        type: 'POST',
        url: '/admin/' + type + '/getrdamount/' + value,
        data: data,
        success: function(data)
        {
            obj = JSON.parse(data);
            document.getElementById("cheque_list").innerHTML = obj.cheque_list;
            document.getElementById("installment").value = obj.installment;
        }
    });
    return false;
}

function getmaturitydetails(type, value)
{
    var data = $("#add").serialize();
    $.ajax({
        type: 'POST',
        url: '/admin/' + type + '/getmaturity/' + value,
        data: data,
        success: function(data)
        {
            obj = JSON.parse(data);
            document.getElementById("maturity_date").value = obj.maturity_date;
            document.getElementById("maturity_amount").value = obj.maturity_amount;
            document.getElementById("policy_number").value = obj.policy_number;
        }
    });
    return false;
}

function getchequeDetails(value)
{

    var data = $("#add").serialize();
    $.ajax({
        type: 'POST',
        url: '/admin/cheque/getchequedetails/' + value,
        data: data,
        success: function(data)
        {
            obj = JSON.parse(data);
            document.getElementById("cheque_date").value = obj.cheque_date;
            document.getElementById("installment").value = obj.amount;
            document.getElementById("cheque_number").value = obj.cheque_number;
            $('#bank_id').val("" + obj.bank_id + "").attr('selected', 'selected');
            $('#payment_mode').val("1").attr('selected', 'selected');
        }
    });
    return false;
}

function responseType(type)
{

    if (type == 1)
    {
        document.getElementById('cheque_no').style.display = 'block';
        document.getElementById('bank_name').style.display = 'block';
        document.getElementById('cheque_dat').style.display = 'block';
        $('#cheque_number').prop('required', true);
        $('#cheque_date').prop('required', true);

    }
    else if (type == 2)
    {
        document.getElementById('cheque_no').style.display = 'none';
        document.getElementById('bank_name').style.display = 'none';
        document.getElementById('cheque_dat').style.display = 'none';
        $('#cheque_number').prop('required', false);
        $('#cheque_date').prop('required', false);

    }

}


function AddCheque() {
    var mainDiv = document.getElementById('new_cheque');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="cheque_number[]" required class="form-control input-sm" placeholder="Cheque Number"></div></td><td><div class="input-icon right"><input type="text" name="amount[]" required class="form-control input-sm" placeholder="Cheque Amount"></div></td><td><div class="input-icon right"><input type="text" name="cheque_date[]" required class="form-control input-sm date-picker" data-date-format="dd M yyyy"  placeholder="Cheque date dd-mm-yyyy"></div></td><td><a href="javascript:;" onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i></a></td>';
    mainDiv.appendChild(newDiv);
}
