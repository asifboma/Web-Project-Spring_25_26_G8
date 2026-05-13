console.log("JS Connected With HTML");
var a = ["ABC", "DEF"];

let clickcount = 0;


a.forEach((item, index)=>{
    console.log("Index:", index, "Item: ", item);
})

a.map((item, index)=>{
    console.log("Index:", index, "Item: ", item);
})

function collect_data()
{
    let pname = document.getElementById("PatientName").value;
    document.getElementById("PatientName").style.color="red";
    console.log(pname);
    return false;    
}
function collect_name()
{
    let pname = document.getElementById("PatientName").value;
    console.log(pname);
    return false;    
}
function collect_age()
{
    let page = document.getElementById("Age").value;
    console.log(page);
    return false;    
}
function get_textarea()
{
    let paddress = document.getElementById("Address").value;
    console.log(paddress);
    return false;
}

function submit_data()
{
    clickcount++;
    let submit= document.getElementById("submitdata").value;
    document.getElementById("submitdata").style.color="green";
    document.getElementById("submitdata").innerHTML="Clicked Button: "+clickcount;
    return false;
}
