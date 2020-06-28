let images = document.getElementsByClassName('galerie-images-img');
let lorem = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis, amet! Quis eius consequatur, natus quam illum sunt ad. Eum placeat itaque enim distinctio? Suscipit neque ad atque blanditiis officia nemo omnis ratione eveniet cupiditate fugit voluptatum odit eius, fuga maiores.";

const _PLANETS = [{
        path: "earth",
        name: "The Earth",
        description: lorem,
        population: "3 bil",
        polution: "80%",
        price: "1000 dh"
    },
    {
        path: "moon",
        name: "The Moon",
        description: lorem,
        population: "0 Person",
        polution: "0%",
        price: "500000 dh"
    },
    {
        path: "404",
        name: "Unknown",
        description: lorem,
        population: "???",
        polution: "???",
        price: "99 dh"
    },
    {
        path: "mars",
        name: "Mars",
        description: lorem,
        population: "0",
        polution: "??",
        price: "500000 dh"
    },
    {
        path: "namek-flip",
        name: "Namek",
        description: lorem,
        population: "100 person",
        polution: "0%",
        price: "420000 dh"
    }
]
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
    price += parseInt(_PLANETS[pos].price.slice(0, _PLANETS[pos].price.search(" ")));
    // 
    console.log(document.getElementsByClassName('form-res-row-data')[5].value);
    price = parseInt(document.getElementsByClassName('form-res-row-data')[5].value * price);
    // 
    if (price == 0)
        price = "0000";
    document.getElementsByClassName('form-res-price')[0].innerText = `${price}-DH`;
}
// 
// 
function switchData() {
    document.getElementById('galerie-preview-planet').style.backgroundImage = `url("./app/img/${_PLANETS[pos].path}.png")`;
    //Clear previous style 
    for (let i = 0; i < images.length; i++) {
        if (i != pos) {
            images[i].style.backgroundSize = "";
            images[i].style.filter = "";
        }
    }
    // Apply style
    images[pos].style.backgroundSize = "270%";
    images[pos].style.filter = "brightness(0.85)";
    // 
    // CHANGE DISPLAYED TEXT
    document.getElementById('galerie-desc-title').innerText = _PLANETS[pos].name;
    document.getElementById('galerie-desc-txt').innerText = _PLANETS[pos].description;
    document.getElementsByClassName('galerie-desc-det')[0].lastElementChild.innerText = _PLANETS[pos].population;
    document.getElementsByClassName('galerie-desc-det')[1].lastElementChild.innerText = _PLANETS[pos].polution;
    document.getElementsByClassName('galerie-desc-det')[2].lastElementChild.innerText = _PLANETS[pos].price;
    //
    //
    document.getElementsByClassName('form-res-row-preview')[0].style.backgroundImage = `url("./app/img/${_PLANETS[pos].path}.png")`;
    document.getElementsByClassName('section2-confirmation-form-value')[0].innerText = _PLANETS[pos].name;
    // 
    if (_PLANETS[pos].path == "earth") {
        for (let i = 0; i < 2; i++) {
            document.getElementsByClassName('form-res-row-log-element-price')[i].innerText = 3000 * (i + 1) + "-DH";
            document.getElementsByClassName('form-res-row-log-element-img')[i].style.backgroundImage = `url("./app/img/earth/log${i+1}.jpg")`;
        }
    } else {
        for (let i = 0; i < 2; i++) {
            document.getElementsByClassName('form-res-row-log-element-price')[i].innerText = 40000 * (i + 1) + "-DH";
            document.getElementsByClassName('form-res-row-log-element-img')[i].style.backgroundImage = `url("./app/img/other/log${i+1}.jpg")`;
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