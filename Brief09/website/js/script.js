var itemquantity, appleamount, appletotalamount, bananaamount, bananatotalamount, gtotalfruits, gtotalfruitss

function apple() {
    var itemquantity = document.getElementById("apple");
    var appleamount = document.getElementById("appletotal");
    var appletotalamount = itemquantity.value * 50;
    appleamount.value = appletotalamount;
}

function banana() {
    var itemquantity = document.getElementById("banana");
    var bananaamount = document.getElementById("bananatotal");
    var bananatotalamount = itemquantity.value * 30;
    bananaamount.value = bananatotalamount;
}

function grandtotalfruits() {
    var gtotalfruits = document.getElementById("grandtotalfruitss");
    var gtotalfruitss = appletotalamount + bananatotalamount;
    gtotalfruits.value = gtotalfruitss;
}