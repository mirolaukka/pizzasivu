window.onload = function myFunction(){
    if(!(sessionStorage.getItem('cart'))){ // Jos ei ole cart itemiä sessionStoragessa
        sessionStorage.setItem('cart', '{"pizzat":[]}')
    }
};

function uusiPizza(nimi, hinta, taytteet){
    var hintaEl = document.getElementById(taytteet+"Hinta")
    var taytteet = document.getElementById(taytteet+'Sisaltaa').innerHTML
    hinta2 = hintaEl.innerHTML.replace(/[^0-9]/g, "")
    hinta2 = parseInt(hinta2)

    swal("Pizza Lisätty Koriin", " ", "success");

    l = {
        "nimi": nimi,
        "hinta": hinta2,
        "taytteet": taytteet.split(', ')
    }
    addToCart(l)
}

function addToCart(t) { // Function jotta voidaan tehdä kori johon käyttäjä voi lisätä pizzoja. Me tallennetaan pizzojen tiedot
    x = JSON.parse(sessionStorage.getItem('cart'))
    pizzat = x.pizzat;

    pizzat.push(l)

    // Takasiin
    sessionStorage.setItem('cart', JSON.stringify(x))
}

var pizzat2 = []
hinta = 0

function showItems(){

    x = JSON.parse(sessionStorage.getItem('cart'))
    pizzat = x.pizzat;
    var myTable = document.getElementById('myTable');
    for(var i = 0; i < pizzat.length; i++){ // Käydään jokainen pizza läpi
        let pizza = pizzat[i]
        if(!(pizza['nimi'] === undefined)){
            pizzat2.push(pizza["nimi"])
            hinta += parseInt(pizza['hinta'])
            // Uloin Div missä kaikki tiedot on
            var outerRowDiv = document.createElement('div')
            outerRowDiv.classList.add('row')
            outerRowDiv.classList.add('pizzaRow')
            outerRowDiv.style.paddingTop = "20px"
            // Pizza Image Div
            var col1 = document.createElement('div')
            col1.classList.add('col-md-4')
            var col1Img = document.createElement('img')
            col1Img.src = `./images/${pizza["nimi"]}.jpg`
            col1Img.width = "140"
            col1Img.height = "100"
            col1.appendChild(col1Img);

            // Nimi ja hinta div
            var col2 = document.createElement('div')
            col2.classList.add('col-md-2')
            var h3E = document.createElement('h3')

            h3E.innerHTML = pizza["nimi"].charAt(0).toUpperCase() + pizza["nimi"].slice(1) // Ensimmäinen kirjain iso
            var h4E = document.createElement('h4')
            h4E.innerHTML = `Hinta: ${pizza['hinta']}€`
            col2.appendChild(h3E)
            col2.appendChild(h4E)

            // Sisältää Div
            var col3 = document.createElement('div')
            col3.classList.add('col-md-6')
            var textDiv = document.createElement('div')
            textDiv.classList.add('textBox')
            var h3E2 = document.createElement('h3')
            h3E2.innerHTML = "Sisältää:"
            var pE = document.createElement('p')
            pE.name = "taytteet"
            pE.innerHTML = `${pizza["taytteet"].join(', ')}`
            textDiv.appendChild(h3E2)
            textDiv.appendChild(pE)
            col3.appendChild(textDiv)


            // Laitetaan kaikki yhteen
            outerRowDiv.appendChild(col1)
            outerRowDiv.appendChild(col2)
            outerRowDiv.appendChild(col3)
            myTable.appendChild(outerRowDiv)
        }else{
        }
    }
    document.getElementById('hinta').innerHTML = `Maksettava summa: ${hinta}€`
}


function processOrder(){
    document.getElementById('pizzat').value = pizzat2.join(", ")
    document.getElementById('hinta5').value = hinta
    sessionStorage.clear();
}
