function Validate(){
    var password = document.getElementById("myInput");
    if(password.value==""){
        alert("Please fill the password")
        return false;
    }
    else if(password.value.length<8)
    {
    alert("password should have more than 8 chars");
    return false;
    }
    else{
        true;
    }
}