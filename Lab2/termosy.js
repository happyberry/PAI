var rp = require('request-promise');
const jsdom = require("jsdom");
const { JSDOM } = jsdom;

function collectData () {
  return new Promise(function(resolve, reject) {
    rp('https://www.campingshop.pl/kuchnia/termosy-i-kubki-termiczne/termosy-turystyczne')
    .then(async function (htmlString) {
        const dom = new JSDOM(htmlString);
        var products = dom.window.document.getElementsByClassName("name");
        var productBoxes = dom.window.document.getElementsByClassName("product-box  ");
        var links = [];

        for (var i = products.length - 48; i < products.length; i++) {
          links.push('' + productBoxes[i].getElementsByTagName('a')[0].href);
        }
        var promises = [];
        for (var i = 0; i < links.length; i++) {
          promises.push(rp(links[i]).then(function (htmlString) {
            const dom = new JSDOM(htmlString);
            var name = dom.window.document.getElementsByTagName("h1")[0].textContent;
            var specification = dom.window.document.getElementsByClassName("table-product-features")[0];
            var capacity;
            for (var j = 0; j < specification.rows.length; j++) {
              if (specification.rows[j].cells[0].textContent.includes("pojemno")) {
                capacity = specification.rows[j].cells[1].textContent;
                break;
              }
              if (j == specification.rows.length - 1) {
                var words = name.split(" ");
                for (var k = 0; k < words.length; k++) {
                  for (var l = 0; l < words[k].length; l++) {
                    if (!"0123456789,mL".includes(words[k][l])) break;
                    if (l == words[k].length - 1) capacity = words[k];
                  }
                }
              }
            }
            capacity = capacity.replace(",", ".");
            capacity = parseFloat(capacity);
            if (capacity > 10) capacity /= 1000;
            var price = dom.window.document.getElementById("prCurrent").textContent;
            price = price.replace(",", ".");
            price = parseFloat(price);
            var info = {
              productName: name,
              capacity: capacity,
              price: price,
              pricePerLiter: Math.round(100 * price / capacity) / 100
            }
            return info;
          }));
        }
        await Promise.all(promises).then(function (vals) {
          resolve(vals);
        });
    });
  });
}

collectData().then(function (data) {
  data = data.sort(function(a, b) {return b.pricePerLiter - a.pricePerLiter;});
  for (var i = 0; i < data.length; i++) {
    console.log("Nazwa: " + data[i].productName);
    console.log("Pojemność: " + data[i].capacity + "L Cena: " + data[i].price.toFixed(2) + "zł\nCena za litr: " + data[i].pricePerLiter.toFixed(2) + "zł\n");
  }
});