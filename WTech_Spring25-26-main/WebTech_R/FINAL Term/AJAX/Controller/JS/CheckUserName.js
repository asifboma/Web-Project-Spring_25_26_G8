function CheckUserName()
{
    let username = document.getElementById("name").value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200)
        {
            document.getElementById("userresponse").innerHTML=this.responseText;
        }
        else{
            document.getElementById("userresponse").innerHTML=this.status;
        }  
    }
        xhttp.open("POST", "../Controller/CheckUserName.php", true);
        xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhttp.send("username="+username);
}