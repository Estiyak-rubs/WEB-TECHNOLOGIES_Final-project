
document.addEventListener("DOMContentLoaded", function(){
    var btn = document.getElementById("viewUserBtn");
    if(btn){
        btn.addEventListener("click", viewuserF);
    } else {
        console.error("View User Button not found!");
    }

    var ccpBtn = document.getElementById("EditSave");
    if(ccpBtn){
        ccpBtn.addEventListener("click", function(e) {
            // Run your "ccp" functionality here
            console.log("CCP button clicked");
            // Call the viewuserF function if needed

            updateUser(e);

            viewuserF(e);
        });
    } else {
        console.error("CCP Button not found!");
    }


    var insertBTN = document.getElementById("SubmitBtn");
    if(insertBTN){
        insertBTN.addEventListener("click", function(e) {
            // Run your "ccp" functionality here
            console.log("insertBTN button clicked");
            // Call the viewuserF function if needed
            insertUser(e);
        });
    } else {
        console.error("insertBTN Button not found!");
    }
});

function insertUser(e){
    e.preventDefault();

    let nm = document.getElementById("uname");
    let em = document.getElementById("uemail");
    let ps = document.getElementById("upassword");
    let tp = document.getElementById("uutype");
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "../controller/insertUserController.php");
    
    xhr.onload = function(){
        if(this.status === 200){
            document.getElementById("showInsertMsg").innerHTML = this.responseText;
        }
        else document.getElementById("showInsertMsg").innerHTML = "Problem occured";
    }
    const mydata = { unm : nm.value, uemail : em.value, ups : ps.value, utp : tp.value};
    const data = JSON.stringify(mydata);
    xhr.send(data);

}
function updateUser(e){
    e.preventDefault();
    let nm = document.getElementById("editFormName");
    let em = document.getElementById("editFormEmail");
    let ps = document.getElementById("editFormPassWord");
    let id = document.getElementById("editFormID").value;
    console.log('in updateuser');
    console.log(nm.value);
    console.log(em.value);
    console.log(ps.value);
    console.log(id);

    const xhr = new XMLHttpRequest();

    xhr.open("POST", "../controller/updateUserController.php");
    
    xhr.onload = function(){
        if(this.status === 200){
            document.getElementById("showEditMsg").innerHTML = this.responseText;
        }
        else document.getElementById("showEditMsg").innerHTML = "Problem occured";
    }
    const mydata = {uid : id, unm : nm.value, uemail : em.value, ups : ps.value};
    const data = JSON.stringify(mydata);
    xhr.send(data);
}

function viewuserF(e) {
    e.preventDefault();
    const user_type = document.getElementById("user_type").value;
    console.log('working ', user_type); // working good
    const xhr = new XMLHttpRequest();
    xhr.responseType = "json";

    xhr.open("POST", "../controller/showUserController.php", true);
    xhr.setRequestHeader("Content-type", "application/json");

    xhr.onload = function() {
        if (this.status === 200) {
            const response = this.response;
            if (response && response.length > 0) {
                let text = "<table style='text-align: center;'>";
                text += "<tr>";
                text += "<th>Id<hr></th><th>Name<hr></th><th colspan='3'>email<hr></th>";
                text += "</tr>";

                for (let i = 0; i < response.length; i++) {
                    text += "<tr>";
                    text += "<td>" + response[i].user_id + "</td><td>" + response[i].username + "</td><td>" + response[i].email + "</td>";
                    text += "<td><button class='btn-del' data-sid=" + response[i].user_id + ">Delete</button> </td>";
                    text += "<td><button class='btn-edit' data-sid=" + response[i].user_id + ">Edit</button> </td>";
                    text += "</tr>";
                }
                text += "</table>";
                document.getElementById("showUserlist").innerHTML = text;
                // Assuming setDelBtn() and setEditBtn() handle event delegation properly
                setDelBtn();
                setEditBtn();
            } else {
                document.getElementById("showUserlist").innerHTML = "No user found";
            }
        } else {
            console.log("Error: " + xhr.statusText);
        }
    };

    xhr.onerror = function() {
        console.log("Request failed");
    };

    const mydata = { type: user_type };
    const data = JSON.stringify(mydata);
    xhr.send(data);
}

function setDelBtn(){
    //e.preventDefault();
    var x = document.getElementsByClassName("btn-del");
    console.log("setdel called");
    //console.log(x);
    for(let i=0; i<x.length; i++){
        /*
        1. we will add event listener in every button
        2. we get event id from data-sid value;
        3. then we generate a request to delete.php file to delete the id
        4. in response we send the response text to view page
        */
        x[i].addEventListener("click", function(e){
            let id = x[i].getAttribute("data-sid");
            document.getElementById("deltemsg").innerHTML="";
            document.getElementById("showEditMsg").innerHTML = "";
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../controller/deleteUserController.php", true);
            xhr.setRequestHeader("Content-type", "application/json");
            xhr.onload = function(){
                if(this.status === 200){
                    document.getElementById("deltemsg").innerHTML = this.responseText;
                    console.log("found this ", this.responseText);
                    viewuserF(e);
                }
                else  {
                    //document.getElementById("showmsg").innerHTML = "Can not delete";
                    console.log("not found here");
                }
            };
            const mydata = {sid: id};
            const data = JSON.stringify(mydata);
            xhr.send(data);
            
        } );
    }
}

function setEditBtn(){
    // e.preventDefault();
   var x = document.getElementsByClassName("btn-edit");
   console.log("setEdit called");
   //console.log(x);
   for(let i=0; i<x.length; i++){
       /*
       1. we will add event listener in every button
       2. we get event id from data-sid value;
       3. then we generate a request to edit.php file 
       4. in the request we will send the id of the use to be edited
       */
      let nm = document.getElementById("editFormName");
      let em = document.getElementById("editFormEmail");
      let pass = document.getElementById("editFormPassWord");
      let uid = document.getElementById("editFormID");
      console.log(x[i].getAttribute('data-sid'));

       x[i].addEventListener("click", function(){
           let id = x[i].getAttribute("data-sid");
           document.getElementById("deltemsg").innerHTML="";
           document.getElementById("showEditMsg").innerHTML = "";
           console.log("where is ", id);
           const xhr = new XMLHttpRequest();
           xhr.open("POST", "../controller/editUserController.php", true);
           xhr.responseType = "json";
           xhr.setRequestHeader("Content-type", "application/json");
           xhr.onload = function(){
               if(this.status === 200){
                   nm.value = this.response.username;
                   em.value = this.response.email;
                   pass.value = this.response.PASSWORD;
                   uid.value = this.response.user_id;
                   if(this.response==null){
                    console.log("found null");
                   }
                   else console.log(this.response);
               }
               else  {
                   //document.getElementById("showmsg").innerHTML = "Can not delete";
                   console.log("not found here");
               }
           };
           const mydata = {sid: id};
           const data = JSON.stringify(mydata);
           xhr.send(data);
           
       } ); 
   }


}