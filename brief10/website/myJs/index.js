$(document).ready(() => {
    $.post('functions.php', {
        onLoadClientEmail: localStorage.getItem('clientEmail')
    }, response => {
        console.log(response);
        $(".cartProductsNb").each((i, elem) => {
            elem.innerText = response;
        });
    });
    // 
    $('#sort-srch-input').on('keyup', (e) => {
        $('.prodBox').each((i, element) => {
            if ($(element).attr('data-nom').toLowerCase().indexOf(e.target.value.toLowerCase()) > -1) {
                $(element).animate({
                    opacity: "1"
                }, 100, () => {
                    $(element).css("display", "block")
                });
            } else {
                $(element).animate({
                    opacity: "0"
                }, 100, () => {
                    $(element).css("display", "none")
                });
            }
        });
    });
    // 
});

function addToBasket(value) {
    $.post('functions.php', {
        prodId: value,
        clientEmail: localStorage.getItem('clientEmail')
    }, async response => {
        var params = {
            content: "",
            type: "error",
            behavior: {
                type: "normal"
            },
            duration: 3000
        }
        // 
        switch (response) {
            case "100":
                params.content = "Utilisateur n'existe pas! Merci de se connecter";
                break;
            case "101":
                params.content = "Le stock est epuisé";
                break;
            case "102":
                params.content = "Vous aves déja ajouter cette produit a votre panier";
                params.type = "warning";
                break;
            default:
                $(".cartProductsNb").each((i, elem) => {
                    var nb = Number($(elem).text()) + 1;
                    elem.innerText = nb;
                });
                params.content = "Produit ajouté avec success";
                params.type = "success";
        }
        // 
        await toast(params);
    });
}
// 
function addPackToBasket(idPack) {
    $.post('functions.php', {
        packId: idPack,
        clientEmail: localStorage.getItem('clientEmail')
    }, async response => {
        console.log(response);
        var params = {
            content: "",
            type: "error",
            behavior: {
                type: "normal"
            },
            duration: 3000
        }
        // 
        switch (response) {
            case "100":
                params.content = "Utilisateur n'existe pas! Merci de se connecter";
                break;
            case "101":
                params.content = "Vous ne pouvez acheter que 3 packs par jour";
                break;
            case "102":
                params.content = "Vous avez dépassé le nombre maximum autorisé";
                params.type = "warning";
                break;
            default:
                $(".cartProductsNb").each((i, elem) => {
                    var nb = Number($(elem).text()) + 1;
                    elem.innerText = nb;
                });
                params.content = "Pack ajouté avec success";
                params.type = "success";
        }
        // 
        await toast(params);
    });

}