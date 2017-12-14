var status = 1;
function sameaddress()
{
    if (status == 2) {
        document.getElementById("current_address").value = '';
        document.getElementById("current_city").value = '';
        document.getElementById("current_zip").value = '';
        document.getElementById("current_state").value = '';
        document.getElementById("current_country").value = '';
        status = 1;
    }
    else
    {
        document.getElementById("current_city").value = document.getElementById("city").value;
        document.getElementById("current_zip").value = document.getElementById("zip").value;
        document.getElementById("current_state").value = document.getElementById("state").value;
        document.getElementById("current_country").value = document.getElementById("country").value;
        document.getElementById("current_address").value = document.getElementById("address").value;
        status = 2;
    }
}