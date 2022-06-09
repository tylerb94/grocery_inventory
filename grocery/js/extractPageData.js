javascript:
var jsonstring = document.querySelector("script").innerText;
var data = JSON.parse(jsonstring);
var upc = data["gtin13"];
var name = data["name"];
var description = document.getElementsByClassName("dangerous-html mb3").valueOf()[0].innerText;
var image = data["image"];

window.open("http://tydev.net/grocery/externalUpload.php?upc=" + upc + "&name=" + name + "&description=" + description + "&image=" + image , "_blank");

location.load();