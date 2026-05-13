// console.log("HTML Page are Connected"); 



// let _a = 10;  
// var b = 20.56667;
// var c = _a+b;
// console.log("Sum of A +B", c);
// if(_a<0)
// {
//     _a++;
//     console.log(_a);
// }
// else if(_a>0 && _a<=10)
// {
//     b = _a;
//     console.log(b); 
//     c= b+_a;
//     console.log(c);
// }

// var name = "AIUB";
// //var name;
// var name ='BUET';
// console.log(name);

// var para1 = document.getElementById("demo");
//     para1.innerHTML="Hello World";

function collect_data()
{
    let isnamevalid = collect_name();
    let isagevalid = collect_Age();
    

    
    //console.log(AgeShow);



    

    return false;
    
}

function collect_name()
{
    let Patient_Name = document.getElementById("PatientName").value;
    console.log(Patient_Name);
    if(Patient_Name=="")
    {
        document.getElementById("NameError").innerHTML="Name Can Not be Empty";
        return false;
    }
    // var pname = document.getElementById("demo");
    // pname.innerHTML="Patient Name: " + Patient_Name.value;
}
function collect_Age()
{
    let P_age= document.getElementById("Age").value;
    console.log(P_age);
    if(P_age=="")
    {
        document.getElementById("AgeError").innerHTML="Age Can Not be Empty";
        return false;
    }



    // let P_age= document.getElementById("Age");
    // let AgeShow = document.getElementById("PAge");
    // AgeShow.innerHTML="Patient Age: " + P_age.value; 
}