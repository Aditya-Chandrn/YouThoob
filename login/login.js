function Validate() {
    var uname = document.getElementById("email");
    var password = document.getElementById("password");
    var mailFormat= /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    if(uname.value==""){
        alert("Please fill the username");
        return false;
    }
    if (password.value == "") 
    {
        alert("Please fill the password")
        return false;
    } else if (password.value.length < 6) 
    {
        alert("password should have more than 6 chars");
        return false;
    }
    if (uname.value.match(mailFormat)) {
     
        return true;
    }
    else{
        alert("Invalid Email");
        return false;
    }
}