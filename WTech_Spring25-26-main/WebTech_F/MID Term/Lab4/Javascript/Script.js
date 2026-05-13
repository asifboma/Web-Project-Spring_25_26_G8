console.log("Connect HTML Page");
var a = ["ABC", "DEF"];

let clickcount=0;

a.forEach((item, index)=>{
    console.log("Index: ",index, "Item:", item);
})
a.map((item, index)=>{
    console.log("Index: ",index, "Item:", item);
})

function collect_data()
{
    let name = document.getElementById("PatientName").value;
    console.log(name);
    document.getElementById("PatientName").style.color="red";

    return false;
}

function get_textarea()
{
    let patientAdd= document.getElementById("Address").value;
    console.log(patientAdd);
    return false;
}

function submit_key()
{
    clickcount++;
    let submitdata = document.getElementById("keysubmit").value;
    document.getElementById("keysubmit").style.color="green";
    document.getElementById("keysubmit").innerHTML="Again Submit" + clickcount;
    return false;
}