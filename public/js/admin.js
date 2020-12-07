// espoire de créé un enregistrement d'ip dans un fichier .txt
// // REUSSI :) passage par les cookies ( methode non asynchrone )
// et par la suite un enregistrement des commandes dans autre fichier .txt

function ajax() {
    let xhr = new XMLHttpRequest()
    xhr.open("GET", "js/nbConnect.txt")
    xhr.responseType = "json"

    xhr.onreadystatechange = function () {
        let somme = 0
        if (this.readyState === 4 && this.status === 200) {
            let personne = this.response.personne
            for (let i = 0; i < personne.length; i++) {
                somme += 1
            }
        }
        document.getElementById("nbConnect").innerHTML = "Nombre d'utilisateurs actifs : "+somme
    }
    xhr.send()
    nbcommande()
    maxCommande()
}


function newconnect(ip) {
    let person = {"ip": ip}
    let xhr = new XMLHttpRequest()
    let formtext = ""
    let bool = 0
    xhr.open("GET", "js/nbConnect.txt", true)
    xhr.responseType = "json"
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let personne = this.response.personne
            for (const k in personne) {
                if (personne[k].ip === ip) {
                    bool = 1
                }
            }
            if (bool === 0){
                personne.push(person)
            }
            formtext = JSON.stringify(personne)
            sendResponce('{ "personne":'+formtext+'}')
        }
    }
    xhr.send()
}
function deconnect(ip){
    let xhr = new XMLHttpRequest()
    let formtext = ""
    xhr.open("GET", "js/nbConnect.txt", true)
    xhr.responseType = "json"
    xhr.onreadystatechange = function (){
        if (this.readyState === 4 && this.status === 200) {
            let personne = this.response.personne
            personne.splice( personne.find(element => element.ip === ip), 1)
        }
        formtext = JSON.stringify(personne)
        sendResponce('{ "personne":['+formtext+']}')
    }
    xhr.send()
}

function sendResponce(text){
    let date = new Date(Date.now() + 86400000)
    date = date.toUTCString()
    document.cookie = 'user='+text+'; path=/; expires=' + date
}
