// sessionStorage.getItem(_SESSION);
const _Regex_Identifiant = /^[a-zA-Z0-9._-]{5,20}$/;
const _Regex_NP = /^[a-zA-Z ]+$/;
const _Regex_Email = /^[a-zA-Z0-9._-]{5,20}\@[a-zA-Z0-9-]{3,15}\.[a-zA-Z]{2,4}$/;
// 
document.getElementById('form-btn-sec').addEventListener('click', () => {
    let inputs = document.getElementsByClassName('form-row-input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].value = "";
    }
});
document.getElementById('form-btn-main').addEventListener('click', () => {
    const _VALUES = document.getElementsByClassName('form-row-input');
    // FIELDS ARE VALIDE BY DEFAULT
    let valide = true;
    // 
    for (let i = 0; i < _VALUES.length; i++) {
        // if (!_VALUES[i].value) {
        // if (_VALUES[i].value.length == 0) {
        if (_VALUES[i].value == '') {
            showErrMsg("empty");
            inscriptionError("one or more fields are empty");
            valide = false;
            break;
        }
    }
    // 
    // if(valide){
    if (valide == true) {
        const _Regex_Identifiant = /^[a-zA-Z0-9._-]{5,20}$/;
        const _Regex_NP = /^[a-zA-Z ]+$/;
        const _Regex_Email = /^[a-zA-Z0-9._-]{5,20}\@[a-zA-Z0-9-]{3,15}\.[a-zA-Z]{2,4}$/;
        // 
        if (_Regex_Identifiant.test(_VALUES[0].value) == false) {
            valide = false;
            showErrMsg("Identifiant non valide");
            inscriptionError("Identifiant non valide");
        }
        if (_Regex_NP.test(_VALUES[1].value) == false) {
            valide = false;
            showErrMsg("Nom & Prenom non valide");
            inscriptionError("Nom & Prenom non valide");
        }
        if (_Regex_Email.test(_VALUES[2].value) == false) {
            valide = false;
            showErrMsg("Email non valide");
            inscriptionError("Email non valide");
        }
        // 
        if (_VALUES[3].value.length >= 6) {
            if (_VALUES[3].value != _VALUES[4].value) {
                valide = false;
                showErrMsg("Password doesn't match");
                inscriptionError("Password doesn't match");
            }
        } else {
            valide = false;
            showErrMsg("Password must be 6 characters and above");
            inscriptionError("Password must be 6 characters and above");
        }
        // 
        // 
        if (valide == true) {
            // alert('SHOW A SUCCES MESSAGE / POP UP HERE');
            alert('Compte cree avec succes');
            sessionStorage.setItem("user-auth-np", _VALUES[1].value);
            sessionStorage.setItem("user-auth-email", _VALUES[2].value);
            // 
            document.getElementById('form-res-row-data-np').value = sessionStorage.getItem("user-auth-np");
            document.getElementById('form-res-row-data-em').value = sessionStorage.getItem("user-auth-email");
            // 
            document.getElementById('content').scrollTo(0, 0);
        }
    }
});
// 
function showErrMsg(msg) {
    // alert(msg);
    console.log(`%c${msg}`, "background:red;color:white;padding:5px;border-radius:5px;");
}
// 
function inscriptionError(msg) {
    document.getElementById('section3-alerts').style.display = "flex";
    document.getElementById('section3-msgs').style.display = "flex";
    // 

    // `<i class="gg-danger"></i><span>${msg}</span>`
    document.getElementById('section3-msgs').innerHTML = "";
    let tempItem = document.createElement('i');
    tempItem.setAttribute('class', 'gg-danger');
    document.getElementById('section3-msgs').appendChild(tempItem);
    tempItem = document.createElement('span');
    tempItem.appendChild(document.createTextNode(msg));
    document.getElementById('section3-msgs').appendChild(tempItem);
    // 
    setTimeout(() => {
        document.getElementById('section3-msgs').style.display = "none";
    }, 2000);
}