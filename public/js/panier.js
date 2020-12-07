let user = 0

function userid(id){
    if (id !== 0) {
        user = id
    }
}

function ajoutPanier(product_Id,name,price,stockmax) {
    let panier = []
    if (JSON.parse(localStorage.getItem('panier')) !== null) {
        panier = JSON.parse(localStorage.getItem('panier'))
        let exist = 0
        for (const item in panier) {
            if (panier[item].id === product_Id && panier[item].user === user) {
                if (panier[item].stock < panier[item].stockmax) {
                    panier[item].stock += 1
                    alert('La quantité de '+name+' a été mise à jour dans le panier')
                    exist = 1
                }
                else {
                    panier.push({'id':product_Id,'stock':1,'price':price,'name':name,'stockmax':stockmax,'user':user})
                    alert('Vous ne pouvez pas acheter plus de '+panier[item].stockmax+', '+panier[item].name)
                    exist = 1
                }
            }
        }
        if ( exist === 0){
            panier.push({'id':product_Id,'stock':1,'price':price,'name':name,'stockmax':stockmax,'user':user})
            alert('Le produit '+name+' a été ajouté au panier')
        }
    }
    else {
        panier.push({'id':product_Id,'stock':1,'price':price,'name':name,'stockmax':stockmax,'user':user})
        alert('Le produit '+name+' a été ajouté au panier')
    }
    localStorage.setItem("panier", JSON.stringify(panier))
    countProduct()

}

function modifiPanier(product_Id,newStock) {
    let panier = JSON.parse(localStorage.getItem('panier'))
    for (const item in panier) {
        if (panier[item].id === product_Id && panier[item].user === user) {
            if (panier[item].stock !== panier[item].stockmax || newStock === -1) {
                panier[item].stock += newStock
            }
            if (panier[item].stock === panier[item].stockmax && newStock === 1){
                alert('notre limite est de:'+panier[item].stockmax+' pour '+panier[item].name)
            }
            if (panier[item].stock === 0){
                panier.splice(item, 1)
            }
        }
    }
    localStorage.setItem("panier", JSON.stringify(panier))
    displayPanier()
}

function totalObjet(product_id){
    let panier = JSON.parse(localStorage.getItem('panier'))
    let prix = 0
    for (const item in panier){
        if (panier[item].id === product_id && panier[item].user === user){
            prix = panier[item].stock * panier[item].price
            return prix
        }
    }
    localStorage.setItem("panier", JSON.stringify(panier))
}

function totalPanier(){
    let somme = 0
    let panier = JSON.parse(localStorage.getItem('panier'))
    for (const item in panier) {
        if (panier[item].user === user) {
            somme += totalObjet(panier[item].id)
        }
    }
    return somme
}

function displayPanier() {
    let panier = JSON.parse(localStorage.getItem('panier'))
    let chaine =''
    for (const item in panier) {
        if (panier[item].user === user) {
            chaine += "<tr><td>" + panier[item].name + '</td><td><button onclick=\"modifiPanier(' + panier[item].id + ',-1)\">-</button> ' + panier[item].stock + ' <button onclick=\"modifiPanier(' + panier[item].id + ',1)\">+</button></td><td>' + panier[item].price + "€</td><td>" + totalObjet(panier[item].id) + "€</td>"
            chaine += "</tr>"
        }
    }
    localStorage.setItem("panier", JSON.stringify(panier))
    document.getElementById("panier").innerHTML = chaine
    document.getElementById("total").innerHTML = "Total du Panier TTC : "+totalPanier()+" €"
    countProduct()
}

function countProduct(){
    let panier = JSON.parse(localStorage.getItem('panier'))
    let nbTotal = 0
    for (const item in panier) {
        if (panier[item].user === user) {
            nbTotal += panier[item].stock
        }
    }
    if (!user){
        nbTotal = 0
    }
    document.getElementById("nbPanier").innerHTML ="Mon Panier (" + nbTotal + ")"
}

function usecookie(){
    if (!localStorage['cookie']){
        if (confirm("Êtes-vous d'accord pour accélérer le site avec vos cookies ?")) {
            localStorage.setItem("cookie", 'I am your cookie')
        }
        else {
            location.reload()
        }
    }
}

function commande(){
    let date = new Date().getDate()
    let xhr3 = new XMLHttpRequest()
    xhr3.open("GET", "../js/Commandes.txt", true)
    xhr3.responseType = "json"
    let article = []
    xhr3.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let commande = this.response.commande
            if (JSON.parse(localStorage.getItem('panier')) !== null) {
                let panier = JSON.parse(localStorage.getItem('panier'))
                for (const item in panier) {
                    if (panier[item].user === user) {
                        article.push({"item": panier[item]})
                    }
                }
                commande.push({"article":article,"date": date, "user": user,"total":totalPanier()})
                if (confirm('Voulez-vous commander pour '+totalPanier()+"€ d'articles sur notre site ?"))
                {
                    localStorage.clear()
                    localStorage.setItem("cookie", 'I am your cookie')
                    //panier.slice(index[0],index.length)
                    formtext = JSON.stringify(commande)
                    console.log(formtext)
                    sendResponceCommande('{ "commande":' + formtext + '}')
                    location.reload()
                }
            } else {
                alert('Votre panier est vide')
            }
        }
    }
    xhr3.send()
}

function sendResponceCommande(text){
    let date = new Date(Date.now() + 86400000)
    date = date.toUTCString()
    document.cookie = 'commande='+text+'; path=/; expires=' + date
}

function nbcommande() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "js/Commandes.txt")
    xhr.responseType = "json"
    xhr.onreadystatechange = function () {
        let commande = this.response.commande
        document.getElementById("nbCommandes").innerHTML = "Nombre de commandes : "+commande.length
    }
    xhr.send()
}

function maxCommande() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "js/Commandes.txt")
    xhr.responseType = "json"
    xhr.onreadystatechange = function () {
        let total = 0
        if (this.readyState === 4 && this.status === 200) {
            let commande = this.response.commande
            for (let i = 0; i < commande.length; i++) {
                if (commande[i].total > total) {
                    total = commande[i].total
                }
            }
        }
        document.getElementById("maxCommandes").innerHTML = "Plus grande commande : "+total+"€"
    }
    xhr.send()
}