var numherder = 1;
var removecount = 0;
var removetaxcount = 0;

//particular and tax labels , 
var label = 'required aria-required="true" maxlength="40" title="Does not accepts ` and ~ characters"  pattern="[a-zA-Z0-9]+(([\\\!\\\'\\\,\\\.\\\s\\\-\\\@\\\#\\\$\\\%\\\^\\\&\\\*\\\(\\\)\\\_\\\+\\\|\\\\\\\/\\\=\\\{\\\}\\\[\\\]\\\][a-zA-Z0-9])?[a-zA-Z0-9]*)*" ';
// , narrative  
var label1 = 'maxlength="40" title="Does not accepts ` and ~ characters" pattern="[a-zA-Z0-9]+(([\\\!\\\'\\\,\\\.\\\s\\\-\\\@\\\#\\\$\\\%\\\^\\\&\\\*\\\(\\\)\\\_\\\+\\\|\\\\\\\/\\\=\\\{\\\}\\\[\\\]\\\][a-zA-Z0-9])?[a-zA-Z0-9]*)*"';
//percentage tax
var ptax = 'maxlength="5" pattern="[0-9]+([\.][0-9]+)?" title="Accepts only numeric characters.Value less than 100"  step="0.01"';
//amount , absolute cost
var aamt = 'title="Accepts only numeric characters. Value not exceeding (&#x20B9;) 1,00,000.00" pattern="((?=.*[0-9])\\\d{1,5}(?:\\\.\\\d{1,2})?|100000.00|100000)" maxlength="9"';
//quantity , no of units
var units = 'title="Accepts only numeric characters" pattern="((?=.*[0-9])\\\d{1,5}(?:\\\.\\\d{1,2})?|100000.00|100000)" maxlength="9"';
//header
var header = 'required aria-required="true" maxlength="20" title="Does not accepts ` and ~ characters" pattern="[a-zA-Z0-9]+(([\\\!\\\'\\\,\\\.\\\s\\\-\\\@\\\#\\\$\\\%\\\^\\\&\\\*\\\(\\\)\\\_\\\+\\\|\\\\\\\/\\\=\\\{\\\}\\\[\\\]\\\][a-zA-Z0-9])?[a-zA-Z0-9]*)*"';
//duration
var dur = 'required aria-required="true" maxlength="15" title="Does not accepts ` and ~ characters" pattern="[a-zA-Z0-9]+(([\\\!\\\'\\\,\\\.\\\s\\\-\\\@\\\#\\\$\\\%\\\^\\\&\\\*\\\(\\\)\\\_\\\+\\\|\\\\\\\/\\\=\\\{\\\}\\\[\\\]\\\][a-zA-Z0-9])?[a-zA-Z0-9]*)*"';


function removedivexist(id)
{
    var ab = 'exist' + id;

    var elem = document.getElementById(ab);
    elem.parentNode.removeChild(elem);
}





function addHeader() {

    custom_column_id = document.getElementById("custom_column_id").value;
    if (custom_column_id == 'new')
    {
        newHwader();
    } else
    {
        column_datatype = document.getElementById("datatype").value;
        custom_column_name = document.getElementById("custom_column_name").value;
        document.getElementById("datatype" + custom_column_id + "").value = column_datatype;
        document.getElementById("columnname" + custom_column_id + "").value=custom_column_name;
        
        $("#edit" + custom_column_id + "").attr("onclick","$('#custom_column_id').val('"+custom_column_id+"');$('#datatype').val('"+column_datatype+"').attr('selected', 'selected');");

    }

}

function newHwader()
{
    numherder++;
    while (document.getElementById('exist' + numherder)) {
        numherder = numherder + 1;
    }
    column_datatype = document.getElementById("datatype").value;
    custom_column_name = document.getElementById("custom_column_name").value;

    var node_listleft = document.getElementsByName("leftcount");
    var node_listright = document.getElementsByName("rightcount");
    var leftcount = Number(node_listleft.length);
    var rightcount = Number(node_listright.length);
    if (Number(rightcount) < Number(leftcount)) {
        var mainDiv = document.getElementById('newHeaderright');
    }
    else
    {
        var mainDiv = document.getElementById('newHeaderleft');
    }

    var newDiv = document.createElement('div');

    var newSpan = document.createElement('div');
    newSpan.setAttribute('id', 'exist' + numherder);
    newSpan.setAttribute('class', 'form-group');

    if (rightcount < leftcount) {
        counttext = 'rightcount';
    }
    else
    {
        counttext = 'leftcount';
    }

    if (column_datatype == 'textarea')
    {
        disable_textbox = '<textarea class="form-control input-sm" readonly="" name="' + counttext + '"></textarea>';
    } else
    {
        disable_textbox = '<input type="text" class="form-control input-sm" readonly="" name="' + counttext + '">';
    }
    onclick_event = "$('#custom_column_id').val('" + numherder + "'); $('#datatype').val('" + column_datatype + "').attr('selected', 'selected');";
    newSpan.innerHTML = '<div class="form-group" id="exist' + numherder + '"><input name="position[]" type="hidden" value="R"><input name="headertablesave[]" type="hidden" value="metadata"><input name="headermandatory[]" type="hidden" value="2"><input name="headercolumnposition[]" type="hidden" value="7"><input name="headerisdelete[]" type="hidden" value="1"><input name="headerdatatype[]" id="datatype' + numherder + '" type="hidden" value="' + column_datatype + '"><div class="col-md-6"><div class="input-group"><div class="input-icon"><i class="fa fa-anchor green"></i><input type="text" name="headercolumn[]" value="' + custom_column_name + '" class="form-control input-sm" maxlength="40" placeholder="Enter label name"></div><span class="input-group-btn"><a class="btn default btn-sm" data-toggle="modal" onclick="' + onclick_event + '" href="#respond"><i class="fa fa-edit"></i></a></span></div></div><div class="col-md-6"><div class="input-group"><div id="divid8">' + disable_textbox + '</div><span class="input-group-addon " id="' + numherder + '" onclick="removedivexist(this.id)"><i class="fa fa-minus-circle"></i></span></div><span class="help-block"></span></div></div>';

    mainDiv.appendChild(newSpan);
}

function AddSocietyParticular() {
    //var x = document.getElementById("particular_table").rows.length;
    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="particularname[]" class="form-control input-sm" placeholder="Add label"></div></td><td><div class="input-icon right"><input type="text" readonly class="form-control input-sm"></div></td><td><input type="text" readonly class="form-control input-sm" ></td><td><input type="text" readonly class="form-control input-sm" readonly></td><td><input type="text" readonly class="form-control input-sm"></td><td><a href="javascript:;" onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}

function AddSchoolParticular() {
    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="particularname[]" class="form-control input-sm" placeholder="Add fee type"></div></td><td><input type="text" readonly class="form-control input-sm"></td><td><input type="text" class="form-control input-sm" readonly ></td><td><input type="text" readonly class="form-control input-sm" ></td><td><a href="javascript:;"  onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}

function AddHotelParticular() {

    /* numherder++;
     while (document.getElementById('exist' + numherder)) {
     numherder = numherder + 1;
     } */

    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    //var newSpan = document.createElement('tr');
    //newSpan.setAttribute('id', 'exist' + numherder);
    //newSpan.setAttribute('class', 'form-group');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="particularname[]" class="form-control input-sm" placeholder="Add product name"></div></td><td><input type="text" readonly class="form-control input-sm" ></td><td><input type="text" readonly class="form-control input-sm" ></td><td><input type="text" class="form-control input-sm" readonly></td><td><a href="javascript:;"  onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';

    mainDiv.appendChild(newDiv);
    //mainDiv.appendChild(newSpan);
}

function AddTax() {
    var mainDiv = document.getElementById('new_tax');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="taxx[]" class="form-control input-sm" placeholder="Add label"></div></td><td><div class="input-icon right"><input type="text" name="defaultValue[]" class="form-control input-sm" placeholder="Add tax %"></div></td><td><input type="text" readonly class="form-control input-sm" ></td><td><input type="text" class="form-control input-sm" readonly></td><td><input type="text" readonly class="form-control input-sm"></td><td><a href="javascript:;" onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}


/* Invoice particular */
function AddSocietyInvoiceParticular() {
    //var x = document.getElementById("particular_table").rows.length;
    try {
        var node_listright = document.getElementsByName("countrow");
        var Numrow = Number(node_listright.length) + 1;
    } catch (o)
    {
        Numrow = 1;
    }

    while (document.getElementById('unitnumber' + Numrow)) {
        Numrow = Numrow + 1;
    }
    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add label"><input type="hidden" name="ids[]" value="P1"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" ' + aamt + '  id="unitprice' + Numrow + '" onblur="calculatecost(' + Numrow + ')"  placeholder="Add unit price"><input type="hidden" name="ids[]" value="P2"></div></td><td><div class="input-icon right"><input type="text" ' + units + ' name="newvalues[]" id="unitnumber' + Numrow + '" onblur="calculatecost(' + Numrow + ')"  class="form-control input-sm" placeholder="Add no of units"><input type="hidden" name="ids[]" value="P3"></div></td><td><input type="text" name="newvalues[]" class="form-control input-sm" id="cost' + Numrow + '" readonly><input type="hidden" name="ids[]" value="P4"></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add narrative"><input type="hidden" name="ids[]" value="P5"></div></td><td><a href="javascript:;" onClick="removeParticular(' + Numrow + ');$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}


function AddHotelInvoiceParticular() {
    //var x = document.getElementById("particular_table").rows.length;
    try {
        var node_listright = document.getElementsByName("countrow");
        var Numrow = Number(node_listright.length) + 1;
    } catch (o)
    {
        Numrow = 1;
    }

    while (document.getElementById('unitnumber' + Numrow)) {
        Numrow = Numrow + 1;
    }

    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="newvalues[]"  class="form-control input-sm" placeholder="Add label"><input type="hidden" name="ids[]" value="P1"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" ' + units + ' id="unitnumber' + Numrow + '" onblur="calculatecost(' + Numrow + ')" placeholder="Add quantity"><input type="hidden" name="ids[]" value="P2"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" ' + aamt + ' id="unitprice' + Numrow + '" onblur="calculatecost(' + Numrow + ')" placeholder="Add unit cost"><input type="hidden" name="ids[]" value="P3"></div></td><td><input type="text" name="newvalues[]" id="cost' + Numrow + '" class="form-control input-sm" readonly><input type="hidden" name="ids[]" value="P4"></td><td><a href="javascript:;" onClick="removeParticular(' + Numrow + ');$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}

function AddSchoolInvoiceParticular() {
    Numrow = 1;
    while (document.getElementById('cost' + Numrow)) {
        Numrow = Numrow + 1;
    }
    //var x = document.getElementById("particular_table").rows.length;
    var mainDiv = document.getElementById('new_particular');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add label"><input type="hidden" name="ids[]" value="P1"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add duration"><input type="hidden" name="ids[]" value="P2"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" ' + aamt + ' id="cost' + Numrow + '" onblur="calculateschoolcost(' + Numrow + ');"  class="form-control input-sm" placeholder="Add amount"><input type="hidden" name="ids[]" value="P3"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add narrative"><input type="hidden" name="ids[]" value="P4"></div></td><td><a href="javascript:;" onClick="$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}

function addevent() {
    numherder++;
    while (document.getElementById('exist' + numherder)) {
        numherder = numherder + 1;
    }

    var mainDiv = document.getElementById('newevent');

    var newDiv = document.createElement('div');

    var newSpan = document.createElement('div');
    newSpan.setAttribute('id', 'exist' + numherder);
    newSpan.setAttribute('class', 'form-group');
    newSpan.innerHTML = '<input type="hidden" name="position[]" value="-1" /><input type="hidden" name="is_mandatory[]" value="2" /> <input type="hidden" name="datatype[]" value="text" /><div class="col-md-1"></div><div class="col-md-3"><input name="column[]" class="form-control form-control-inline input-sm" type="text" required placeholder="column name" value=""/></div><div class="col-md-8"><div class="input-group"><input name="columnvalue[]" required class="form-control form-control-inline input-sm" type="text" value=""/><span class="input-group-addon " id="' + numherder + '" onclick="removedivexist(this.id)"><i class="fa fa-minus-circle"></i></span></div> <span class="help-block"></span></div>';

    mainDiv.appendChild(newSpan);

}

function AddInvoiceTax() {

    try {
        var node_listright = document.getElementsByName("countrowtax");
        var Numrow = Number(node_listright.length) + 1;
    } catch (o)
    {
        Numrow = 1;
    }

    while (document.getElementById('taxin' + Numrow)) {
        Numrow = Numrow + 1;
    }

    var mainDiv = document.getElementById('new_tax');
    var newDiv = document.createElement('tr');

    newDiv.innerHTML = '<input type="hidden" name="countrowtax"/><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add label"><input type="hidden" name="ids[]" value="T1"></div></td><td><div class="input-icon right"><input type="number" step="0.01" max="100" name="newvalues[]" ' + ptax + ' id="taxin' + Numrow + '" onblur="calculatetax(' + Numrow + ')"  class="form-control input-sm" placeholder="Add tax %"><input type="hidden" name="ids[]" value="T2"></div></td><td><div class="input-icon right"><input type="text" name="newvalues[]" ' + aamt + ' id="applicableamount' + Numrow + '" onblur="calculatetax(' + Numrow + ')"  class="form-control input-sm" placeholder="Add applicable on"><input type="hidden" name="ids[]" value="T3"></div></td><td><input type="text" name="newvalues[]" class="form-control input-sm" id="totaltax' + Numrow + '" readonly><input type="hidden" name="ids[]" value="T4"></td><td><div class="input-icon right"><input type="text" name="newvalues[]" class="form-control input-sm" placeholder="Add narrative"><input type="hidden" name="ids[]" value="T5"></div></td><td><a href="javascript:;" onClick="removetax(' + Numrow + ');$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
    mainDiv.appendChild(newDiv);
}



function calculatecost(p) {
    try {
        d = document.getElementById("unitnumber" + p).value;
        if (d > 0)
        {

        } else
        {
            document.getElementById("unitnumber" + p).value = '1';
            d = 1;
        }
        var m = document.getElementById("unitprice" + p).value, d = document.getElementById("unitnumber" + p).value;

        if ("" == d && (document.getElementById("unitnumber" + p).value = "1", d = 1), m > 0) {
            var r = m * d;
            document.getElementById("cost" + p).value = r > 0 ? Math.round(100 * r) / 100 : 0;
        } else {
            document.getElementById("cost" + p).value = '0';
        }
    } catch (o) {
    }
    particularcount = 1;
    while (document.getElementById('cost' + particularcount)) {
        particularcount = particularcount + 1;
    }
    for (var c = 0, g = 0, v = 1; particularcount > v; v++)
        try {
            c += Number(document.getElementById("cost" + v).value);
        } catch (o) {
        }

    document.getElementById("totalcostamt").value = Math.round(100 * c) / 100;
    //document.getElementById("totalunit").innerHTML = Math.round(100 * g) / 100, document.getElementById("totalcost").value = Math.round(100 * c) / 100, document.getElementById("totalcostamt").value = Math.round(100 * c) / 100, calculategrandtotal(a, n, u, o, l)
    calculategrandtotal();

}

function calculateschoolcost(p) {
    try {
        particularcount = 1;
        while (document.getElementById('cost' + particularcount)) {
            particularcount = particularcount + 1;
        }

        for (var c = 0, g = 0, v = 1; particularcount > v; v++)
            try {
                c += Number(document.getElementById("cost" + v).value);
            } catch (o) {
            }

        document.getElementById("totalcostamt").value = Math.round(100 * c) / 100;
        calculategrandtotal();
    } catch (o) {
    }
}

function calculatetax(p) {
    try {
        var d = document.getElementById("taxin" + p).value, r = document.getElementById("applicableamount" + p).value;
        if ("" == r && (r = 0), d > 0) {
            totalcost = d * r / 100, document.getElementById("totaltax" + p).value = totalcost > 0 ? Math.round(100 * totalcost) / 100 : 0;
        } else {
            document.getElementById("totaltax" + p).value = '0';
        }
    } catch (o) {
    }
    taxcount = 1;
    while (document.getElementById('totaltax' + taxcount)) {
        taxcount = taxcount + 1;
    }

    for (var c = 0, g = 0, v = 1; taxcount > v; v++)
        try {
            c += Number(document.getElementById("totaltax" + v).value);
        } catch (o) {
        }

    document.getElementById("totaltaxcost").value = Math.round(100 * c) / 100;
    calculategrandtotal();
}

function calculategrandtotal() {
    try {
        previous_dues = document.getElementById("previous_dues").value;
    } catch (o) {
        previous_dues = 0;
    }
    try {
        document.getElementById("previous_duesclone").value = previous_dues;
    } catch (o) {
    }
    try {
        amount = document.getElementById("totalcostamt").value;
    } catch (o) {
        amount = 0
    }
    try {
        tax_amount = document.getElementById("totaltaxcost").value;
    } catch (o) {
        tax_amount = 0
    }

    if (previous_dues >= 0) {
        grandtotal = Number(amount) + Number(tax_amount) + Number(previous_dues);

    } else {
        grandtotal = Number(amount) + Number(tax_amount);
        try
        {
            if (previous_dues < 0) {
                grandtotal = grandtotal + Number(previous_dues);
            }
        }
        catch (o) {
        }
    }




    var l = 0;
    if (grandtotal > 0) {
        var m = 0;
        if (t == "P")
        {
            var m = (Number(e) * Number(grandtotal)) / 100;

        } else
        {
            var m = Number(e);
        }
        // m = "P" == t ? e * grandtotal / 100 : e;

        var d = 0;
        "P" == a ? (l = Number(grandtotal) + Number(m), d = n * l / 100) : d = n, stapply = u * d / 100, document.getElementById("totalamount").value = Math.round(100 * grandtotal) / 100, grandtotal = Number(grandtotal) + Number(m) + Number(d) + Number(stapply), document.getElementById("grandtotal").value = Math.round(100 * grandtotal) / 100
    } else {
        document.getElementById("grandtotal").value = 0;
        document.getElementById("totalamount").value = 0;
    }
}

function calculatesimplegrandtotal() {
    try {
        grandtotal = document.getElementById("amount").value;
    } catch (o) {
        grandtotal = 0
    }
    document.getElementById("totalamount").value = grandtotal;

    var l = 0;
    if (grandtotal > 0) {
        var m = 0;
        if (t == "P")
        {
            var m = (Number(e) * Number(grandtotal)) / 100;

        } else
        {
            var m = Number(e);
        }
        // m = "P" == t ? e * grandtotal / 100 : e;

        var d = 0;
        "P" == a ? (l = Number(grandtotal) + Number(m), d = n * l / 100) : d = n, stapply = u * d / 100, document.getElementById("totalamount").value = Math.round(100 * grandtotal) / 100, grandtotal = Number(grandtotal) + Number(m) + Number(d) + Number(stapply), document.getElementById("grandtotal").value = Math.round(100 * grandtotal) / 100
    } else {
        document.getElementById("grandtotal").value = 0;
        document.getElementById("totalamount").value = 0;
    }
}

function removeParticular(id)
{
    try {
        removecount = removecount + 1;
        var total = Number(document.getElementById("totalcostamt").value);
        var cost = Number(document.getElementById("cost" + id).value);
        var c = total - cost;
        document.getElementById("totalcostamt").value = Math.round(100 * c) / 100;
        calculategrandtotal();
    } catch (o) {
    }
}

function removetax(id)
{
    try {
        removetaxcount = removetaxcount + 1;
        var total = Number(document.getElementById("totaltaxcost").value);
        var cost = Number(document.getElementById("totaltax" + id).value);
        var c = total - cost;
        document.getElementById("totaltaxcost").value = Math.round(100 * c) / 100;
        calculategrandtotal();
    } catch (o) {
    }
}

function calculateEventgrandtotal() {
    try {
        grandtotal = document.getElementById("unitcost").value;
    } catch (o) {
        grandtotal = 0
    }
    var l = 0;
    if (grandtotal > 0) {
        var m = 0;
        if (t == "P")
        {
            var m = (Number(e) * Number(grandtotal)) / 100;

        } else
        {
            var m = Number(e);
        }
        // m = "P" == t ? e * grandtotal / 100 : e;

        var d = 0;
        "P" == a ? (l = Number(grandtotal) + Number(m), d = n * l / 100) : d = n, stapply = u * d / 100, grandtotal = Number(grandtotal) + Number(m) + Number(d) + Number(stapply), document.getElementById("grandtotal").value = Math.round(100 * grandtotal) / 100
    } else {
        document.getElementById("grandtotal").value = 0;

    }
}

function addrange()
{
    document.getElementById("range_todate").className = "col-md-7 open";
}

function removerange()
{
    document.getElementById("range_todate").className = "col-md-7 collapse";
}

function setrange()
{
    var status = document.getElementById("range_todate").className;
    var from_date = document.getElementById("from_date").value;
    var to_date = document.getElementById("to_date").value;
    if (status == 'col-md-7 open' && to_date != '')
    {
        document.getElementById("daterange").value = from_date + ' to ' + to_date;
    } else {
        document.getElementById("daterange").value = from_date;
    }

}



function removesupplier(id)
{
    document.getElementById("spid" + id).checked = false;
}

function AddsupplierRow(id) {
    if ($('#spid' + id).is(':checked')) {
        var name = document.getElementById('spname' + id).innerHTML;
        var contact = document.getElementById('spcontact' + id).innerHTML;
        var mobile = document.getElementById('spmobile' + id).innerHTML;
        var sptype = document.getElementById('sptype' + id).innerHTML;
        var spemail = document.getElementById('spemail' + id).innerHTML;

        NumOfRow = id + 4544;
        var mainDiv = document.getElementById('new_supplier');
        var newDiv = document.createElement('tr');
        newDiv.setAttribute('id', 'row' + id);
        newDiv.innerHTML = '<td class="td-c"><input type="hidden" name="supplier[]" value="' + id + '">' + name + '</td><td class="td-c">' + contact + '</td><td class="td-c">' + mobile + '</td><td class="td-c">' + sptype + '</td><td class="td-c"><a href="javascript:;" id="' + id + '" onclick="removesupplier(this.id);$(this).closest(' + "'tr'" + ').remove();" class="btn btn-sm red"> <i class="fa fa-times"> </i> Delete row </a></td>';
        mainDiv.appendChild(newDiv);
    }
    else
    {
        removediv('row' + id);
    }
}

function removediv(id)
{
    var elem = document.getElementById(id);
    elem.parentNode.removeChild(elem);


}