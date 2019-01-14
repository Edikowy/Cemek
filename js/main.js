var myVar = setInterval(myTimer, 1000);

function myTimer() {
   var d = new Date();
   var r = d.toLocaleDateString();
   var t = d.toLocaleTimeString();
   document.getElementById("czas").innerHTML = t;
   document.getElementById("data").innerHTML = r;
 }
