function refillFormReg(){
  document.getElementById("collapseReg").classList.add("show");
  document.getElementById("usernameReg").value=getCookie("username");
  document.getElementById("mailReg").value=getCookie("mail").replace("%40", "@");
  document.getElementById("usernameReg").classList.add("is-invalid");
  deleteCookie("mail");
  deleteCookie("usernameReg");
}

function refillFormLogin(){
  if(getCookie("pw")!==undefined) {
    document.getElementById("usernameLogin").value=getCookie("username");
    document.getElementById("pwLogin").value=getCookie("pw");
    document.getElementById("pwLogin").classList.add("is-invalid");
  }
  //deleteCookie("username");
  //deleteCookie("pw");
}

if(getCookie("pw")!==undefined) refillFormLogin();
if(getCookie("mail")!==undefined) refillFormReg();

document.getElementById("usernameReg").oninput=function(){
  document.getElementById("usernameReg").classList.remove("is-invalid");
}

document.getElementById("pwLogin").oninput=function(){
  document.getElementById("pwLogin").classList.remove("is-invalid");
}

function mostraPw(flag) {
  if(flag==1) {
    var pw=document.getElementById("pwLogin");
    var icona=document.getElementById("iconaPwLogin");
    if(pw.type=="password") {
      pw.type="text";
      icona.className="far fa-eye-slash";
    }else {
      pw.type="password";
      icona.className="far fa-eye";
    }
  } else {
    var pw=document.getElementById("pwRegistrazione");
    var cpw=document.getElementById("CpwRegistrazione");
    var icona1=document.getElementById("icona1");
    //var icona2=document.getElementById("icona2");
    if(pw.type=="password") {
      pw.type="text";
      cpw.type="text";
      icona1.className="far fa-eye-slash";
    } else {
      pw.type="password";
      cpw.type="password";
      icona1.className="far fa-eye";
    }
  }
}

function attivaBottoneLogin(){
  if(document.getElementById("usernameLogin").value!="" && document.getElementById("pwLogin").value!="") document.getElementById("bottoneLogin").disabled=false;
  else document.getElementById("bottoneLogin").disabled=true;
}

function attivaBottoneReg(){
  var user=document.getElementById("usernameReg");
  var mail=document.getElementById("mailReg");
  var pw=document.getElementById("pwRegistrazione");
  var cpw=document.getElementById("CpwRegistrazione");
  var privacy=document.getElementById("privacy");
  var pattMail=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$|(^$)/;
  var pattPw=/^(((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])))(?=.{8,})|(^$)/;
  // regexp mail
  if(!pattMail.test(mail.value)) mail.classList.add("is-invalid");
  else mail.classList.remove("is-invalid");
  // regexp password
  if(!pattPw.test(pw.value)) pw.classList.add("is-invalid");
  else pw.classList.remove("is-invalid");
  if(cpw.value!=pw.value) cpw.classList.add("is-invalid");
  else cpw.classList.remove("is-invalid");
  // attivazione bottone registrazione
  if(mail.value!="" && pw.value!="" && cpw.value==pw.value && user!="" && privacy.checked && pattMail.test(mail.value) && pattPw.test(pw.value)) document.getElementById("bottoneReg").disabled=false;
  else document.getElementById("bottoneReg").disabled=true;
}

// funzioni attivazione bottoni
setInterval(attivaBottoneLogin, 500);
setInterval(attivaBottoneReg, 500);
