document.getElementsByClassName('form-res-row-data')[5].addEventListener('change', (e) => {
    // e.target.value = ;
    if (e.target.value <= 0)
        e.target.value = 0;
    // 
    document.getElementsByClassName('section2-confirmation-form-value')[3].innerText = e.target.value;
    priceUpdate(radioSwitch);
});
document.getElementById('form-btn-res-order').addEventListener('click', () => {
    const _RES_INPUTS = document.getElementsByClassName('form-res-row-data');
    let valide = true;
    // check for changes compared to session
    if (_RES_INPUTS[0].value != sessionStorage.getItem("user-auth-np")) {
        showErrMsg("don't change default values");
        showError("Please sign in");
        valide = false;
    } else {
        if (_RES_INPUTS[1].value != sessionStorage.getItem("user-auth-email")) {
            showErrMsg("don't change default values");
            showError("Please sign in");
            valide = false;
        } else {
            let currentDate = new Date(Date.now());
            // Date check
            if (_RES_INPUTS[2].value.length > 0) {
                let dateN = new Date(_RES_INPUTS[2].value);
                if (currentDate.getFullYear() - dateN.getFullYear() < 20) {
                    showErrMsg("Too young");
                    valide = false;
                }
            }
            if (_RES_INPUTS[3].value.length > 0 && _RES_INPUTS[4].value.length > 0) {
                let resrevDate1 = new Date(_RES_INPUTS[3].value);
                let resrevDate2 = new Date(_RES_INPUTS[4].value);
                // Check with current Date
                if (currentDate - resrevDate1 > 0) {

                    showErrMsg("Date error");
                } else {
                    // If ordering date is bigger than staying date value
                    if (resrevDate1 - resrevDate2 > 0) {
                        showErrMsg("Date error");
                        valide = false;
                    } else {
                        document.getElementsByClassName('section2-confirmation-form-value')[2].innerText = (resrevDate2 - resrevDate1) / (1000 * 3600 * 24);
                    }
                }
            } else {
                showErrMsg("Fill in a Date");
                valide = false;
            }
            if (!valide) {
                showError("Date Error");
                // 
            } else {
                // credit card number
                let regexCCN = /^\d{19}$/;
                if (regexCCN.test(_RES_INPUTS[6].value) == false) {
                    showErrMsg("Credit card number errror");
                    showError("Credit card number error");
                    valide = false;
                } else {
                    //CCV check 
                    let regexCCv = /^\d{4}$/;
                    if (regexCCv.test(_RES_INPUTS[7].value) == false) {
                        showErrMsg("CCV erreur");
                        showError("CCV erreur");
                        valide = false;
                    }
                }
            }
        }
    }
    // 
    // Check Validity 1234567890123456789

    if (valide) {
        // console.log("%cIS GOOD", "background:green;color:white;padding:5px;border-radius:5px;");
        // document.getElementsByClassName('sections')[1]
        document.getElementById('section2-alerts').style.display = "flex";
        document.getElementById('section2-alerts').style.pointerEvents = "all";
        document.getElementById('section2-alerts').style.backgroundColor = "rgba(0, 0, 0, 0.5);";
        document.getElementById('section2-confirmation').style.display = "flex";
        // 
        // 
        document.getElementsByClassName('section2-confirmation-form-value')[4].innerText = document.getElementsByClassName('form-res-price')[0].innerText;
        // 
        // 
        document.getElementById('section2-confirmation-valide').addEventListener('click', () => {
            $.post('/save', {
                type: "Reservation",
                data: {
                    idUser: sessionStorage.getItem("user-id"),
                    idPlanet: document.getElementsByClassName('selectionHighlited')[0].id,
                    logement: getSelectedLogment(),
                    dateN: new Date(_RES_INPUTS[2].value),
                    dateD: new Date(_RES_INPUTS[3].value),
                    dateF: new Date(_RES_INPUTS[4].value),
                    nbPersones: _RES_INPUTS[5].value,
                    price: document.getElementsByClassName('form-res-price')[0].innerText,
                    carteB: _RES_INPUTS[6].value,
                    ccv: _RES_INPUTS[7].value
                }
            }, (response) => {
                if (response) {

                    document.getElementById('section2-alerts').style.display = "none";
                    // document.getElementById('section2-alerts').style.backgroundColor = "transparent";
                    document.getElementById('section2-confirmation').style.display = "none";
                    console.log("%cIS GOOD", "background:green;color:white;padding:5px;border-radius:5px;");
                    // 
                    alert("Planet Reservée");
                    getAllReservations();
                }
            });
        });
        document.getElementById('section2-confirmation-cancel').addEventListener('click', () => {
            document.getElementById('section2-alerts').style.display = "none";
            // document.getElementById('section2-alerts').style.backgroundColor = "transparent";
            document.getElementById('section2-confirmation').style.display = "none";
            // console.log("%cIS GOOD", "background:green;color:white;padding:5px;border-radius:5px;");
        });
    }
});
// 
document.getElementById('form-btn-res-cancell').addEventListener('click', () => {
    let inputs = document.getElementsByClassName('form-res-row-data');
    for (let i = 2; i < inputs.length; i++) {
        inputs[i].value = "";
    }
});
// 
let radioSwitch = 1;
document.getElementsByName('logement')[0].addEventListener('change', () => {
    radioSwitch = 0;
    document.getElementsByClassName('section2-confirmation-form-value')[1].innerText = "Type-1";
    priceUpdate(radioSwitch);
});
document.getElementsByName('logement')[1].addEventListener('change', () => {
    radioSwitch = 1;
    document.getElementsByClassName('section2-confirmation-form-value')[1].innerText = "Type-2";
    priceUpdate(radioSwitch);
});
// 
// 
// 
// 
function showError(msg) {
    document.getElementById('section2-alerts').style.display = "flex";
    document.getElementById('section2-alerts').style.pointerEvents = "none";
    document.getElementById('section2-alerts').style.backgroundColor = "transparent";
    document.getElementById('section2-msgs').style.display = "flex";
    // 

    // `<i class="gg-danger"></i><span>${msg}</span>`
    document.getElementById('section2-msgs').innerHTML = "";
    let tempItem = document.createElement('i');
    tempItem.setAttribute('class', 'gg-danger');
    document.getElementById('section2-msgs').appendChild(tempItem);
    tempItem = document.createElement('span');
    tempItem.appendChild(document.createTextNode(msg));
    document.getElementById('section2-msgs').appendChild(tempItem);
    // 
    setTimeout(() => {
        document.getElementById('section2-msgs').style.display = "none";
    }, 2000);
}



// 
function getSelectedLogment() {
    var radios = document.getElementsByName('logement');
    for (let i = 0; i < radios.length; i++) {
        if (radios[i].checked)
            return document.getElementsByClassName('form-res-row-log-element-price')[i].innerText;
    }
}