let images = document.getElementsByClassName('galerie-images-img');
let lorem = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis, amet! Quis eius consequatur, natus quam illum sunt ad. Eum placeat itaque enim distinctio? Suscipit neque ad atque blanditiis officia nemo omnis ratione eveniet cupiditate fugit voluptatum odit eius, fuga maiores.";

let _PLANETS = [];
$.post('/getAll', {
    table: 'Planet'
}, (response) => {
    _PLANETS = JSON.parse(response);
    // console.log(_PLANETS);
    // 
    for (let i = 0; i < _PLANETS.length; i++) {
        var img = document.createElement('div');
        img.setAttribute('id', _PLANETS[i].id);
        img.setAttribute('class', 'galerie-images-img');
        img.style.backgroundImage = `url('app/img/${_PLANETS[i].imgName}.png')`;
        // 
        document.getElementById('galerie-images').appendChild(img);
    }
    // 
    document.getElementsByClassName('galerie-images-img')[0].setAttribute('class', 'galerie-images-img selectionHighlited');
    // document.getElementsByClassName('galerie-images-img')[0].style.backgroundSize = "270%";
    // document.getElementsByClassName('galerie-images-img')[0].style.filter = "brightness(0.85)";
    // 
    document.getElementById('galerie-preview-planet').style.backgroundImage = `url('app/img/${_PLANETS[0].imgName}.png')`;
});
// 
// 

// const _PLANETS = [{
//         path: "earth",
//         name: "The Earth",
//         description: lorem,
//         population: "3 bil",
//         polution: "80%",
//         price: "1000 dh"
//     },
//     {
//         path: "moon",
//         name: "The Moon",
//         description: lorem,
//         population: "0 Person",
//         polution: "0%",
//         price: "500000 dh"
//     },
//     {
//         path: "404",
//         name: "Unknown",
//         description: lorem,
//         population: "???",
//         polution: "???",
//         price: "99 dh"
//     },
//     {
//         path: "mars",
//         name: "Mars",
//         description: lorem,
//         population: "0",
//         polution: "??",
//         price: "500000 dh"
//     },
//     {
//         path: "namek-flip",
//         name: "Namek",
//         description: lorem,
//         population: "100 person",
//         polution: "0%",
//         price: "420000 dh"
//     }
// ]
let pos = 0;


document.getElementById('navigation-next').addEventListener('click', () => {
    if (pos < images.length - 1)
        pos++;
    else if (pos == images.length - 1)
        pos = 0;
    switchData();
});
document.getElementById('navigation-back').addEventListener('click', () => {
    if (pos > 0)
        pos--;
    else if (pos == 0)
        pos = images.length - 1;
    switchData();
});
// Reservé
document.getElementById('galerie-reserve-btn').addEventListener('click', () => {
    let scrollW = document.getElementById('content').scrollWidth / 3;
    if (sessionStorage.getItem("user-auth-np")) {
        document.getElementById('content').scrollTo((scrollW * 2) - (scrollW / 2), 0);
        // 
        document.getElementById('form-res-row-data-np').value = sessionStorage.getItem("user-auth-np");
        document.getElementById('form-res-row-data-em').value = sessionStorage.getItem("user-auth-email");
        // 
        // Second radio btn is selected by default
        priceUpdate(1);

    } else
        document.getElementById('content').scrollTo(scrollW * 3, 0);
});
// 
function priceUpdate(index) {
    let price = document.getElementsByClassName('form-res-row-log-element-price')[index].innerText;
    price = parseInt(price.slice(0, price.search("-")));
    // 
    price += parseInt(_PLANETS[pos].price);
    // 
    price = parseInt(document.getElementsByClassName('form-res-row-data')[5].value * price);
    // 
    if (price == 0)
        price = "0000";
    document.getElementsByClassName('form-res-price')[0].innerText = `${price}-DH`;
}
// 
// 
function switchData() {
    document.getElementById('galerie-preview-planet').style.backgroundImage = `url("app/img/${_PLANETS[pos].imgName}.png")`;
    //Clear previous style 
    for (let i = 0; i < images.length; i++) {
        if (i != pos) {
            images[i].setAttribute('class', 'galerie-images-img');
            // images[i].style.backgroundSize = "";
            // images[i].style.filter = "";
        }
    }
    // Apply style
    images[pos].setAttribute('class', 'galerie-images-img selectionHighlited');
    // images[pos].style.backgroundSize = "270%";
    // images[pos].style.filter = "brightness(0.85)";
    // 
    // CHANGE DISPLAYED TEXT
    document.getElementById('galerie-desc-title').innerText = _PLANETS[pos].name;
    document.getElementById('galerie-desc-txt').innerText = _PLANETS[pos].description;
    document.getElementsByClassName('galerie-desc-det')[0].lastElementChild.innerText = _PLANETS[pos].population;
    document.getElementsByClassName('galerie-desc-det')[1].lastElementChild.innerText = _PLANETS[pos].polution;
    document.getElementsByClassName('galerie-desc-det')[2].lastElementChild.innerText = _PLANETS[pos].price + "-DH";
    //
    //
    document.getElementsByClassName('form-res-row-preview')[0].style.backgroundImage = `url("app/img/${_PLANETS[pos].imgName}.png")`;
    document.getElementsByClassName('section2-confirmation-form-value')[0].innerText = _PLANETS[pos].name;
    // 
    if (_PLANETS[pos].imgName == "earth") {
        for (let i = 0; i < 2; i++) {
            document.getElementsByClassName('form-res-row-log-element-price')[i].innerText = 3000 * (i + 1) + "-DH";
            document.getElementsByClassName('form-res-row-log-element-img')[i].style.backgroundImage = `url("app/img/earth/log${i+1}.jpg")`;
        }
    } else {
        for (let i = 0; i < 2; i++) {
            document.getElementsByClassName('form-res-row-log-element-price')[i].innerText = 40000 * (i + 1) + "-DH";
            document.getElementsByClassName('form-res-row-log-element-img')[i].style.backgroundImage = `url("app/img/other/log${i+1}.jpg")`;
        }
    }
}
// 
// 
// 
// Lowercase to Uppercase
const _INPUTS = document.querySelectorAll('input[type="text"]');
for (let i = 0; i < _INPUTS.length; i++) {
    _INPUTS[i].onkeyup = () => {
        _INPUTS[i].value = _INPUTS[i].value.toUpperCase();
    }
}
// 
// 
// SHOW/HIDE PASS UPDATE FORM
document.getElementById('updatePassword').addEventListener('click', () => {
    document.getElementById('updatePassFormCont').style.display = "flex";
});
// 
document.getElementById('updatePassFormCont').addEventListener('click', (e) => {
    if (e.target == document.getElementById('updatePassFormCont'))
        document.getElementById('updatePassFormCont').style.display = "none";
});
// 
document.addEventListener('keyup', (e) => {
    if (e.key == "Escape")
        document.getElementById('updatePassFormCont').style.display = "none";
});
// 
// 
// UPDATE PASSWORD
document.getElementById('updatePassForm-btn').addEventListener('click', async () => {
    var inputs = Array.from(document.getElementById('updatePassForm').children).filter((element) => {
        return element.getAttribute('type') == 'password';
    });
    // 
    var validation = {
        filled: true,
        oldpass: true,
        newpass: true
    }
    // CHECK IF INPUTS ARE EMPTY
    inputs.forEach(element => {
        if (element.value == "")
            validation.filled = false;
    });
    // COMPARE OLD PASS WITH DATABASE VALUE
    await Promise.resolve($.post('/getUserData', {
        userId: sessionStorage.getItem("user-id")
    }, (response) => {
        response = JSON.parse(response);
        validation.oldpass = (response.pass == inputs[0].value);
    }));
    // NEW PASS
    if (inputs[1].value != inputs[2].value)
        validation.newpass = false;
    // 
    // CHECK VALIDATIONS
    let msg = '';
    if (!validation.filled)
        msg += '* : Some Fields are not filled. \n';
    if (!validation.oldpass)
        msg += '* : Old password entred is not correct. \n'
    if (!validation.newpass)
        msg += '* : Password confirmation does not match with the new password. \n';
    // 
    if (msg != '')
        alert(msg);
    else { // THIS MEANS THAT THERE WAS NO ERROR THERFORE SAVE THE NEW DATA INTO THE DB
        $.post('/updatePass', {
            data: {
                id: sessionStorage.getItem("user-id"),
                password: inputs[1].value
            }
        }, (response) => {
            if (!response)
                alert('Error saving in DB');
            else
                alert('Password changed with success');
        });
    }
});