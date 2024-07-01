function unhide(license_plate, daily_price, start_date, end_date) {
    document.getElementById("userdata").style.display="flex";
    let days = (new Date(end_date)-new Date(start_date))/(1000*60*60*24);
    days++;
    document.getElementById("numberOdays").value=days;
    document.getElementById("price").value=days*daily_price;
    document.getElementById("start_date").value=start_date;
    document.getElementById("end_date").value=end_date;
    document.getElementById("license_plate").value=license_plate;
    document.getElementById("form-head").innerText=`Renting ${license_plate} from ${start_date} until ${end_date}`;
}
function hide() {
    document.getElementById("userdata").style.display="none";
}
