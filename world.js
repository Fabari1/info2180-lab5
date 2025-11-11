window.onload = function() {
    var countryInput;

    document.getElementById("lookup").onclick = function(event) {

        event.preventDefault();

        countryInput = document.getElementById("country").value.trim().replace(/(<\/?[^>]+>)/gi, "");
        console.log("Country input: " + countryInput);
        const httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                document.getElementById("result").innerHTML = httpRequest.responseText;
                } else {
                document.getElementById("result").innerHTML = "There was a problem with the request.";
                }
            }
        };
        httpRequest.open("GET", "http://localhost/info2180-lab5/world.php?country=" + encodeURIComponent(countryInput));
        httpRequest.send();
    };

    document.getElementById("citylookup").onclick = function(event) {

        event.preventDefault();
        
        countryInput = document.getElementById("country").value.trim().replace(/(<\/?[^>]+>)/gi, "");
        console.log("Country input: " + countryInput);
        const httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                document.getElementById("result").innerHTML = httpRequest.responseText;
                } else {
                document.getElementById("result").innerHTML = "There was a problem with the request.";
                }
            }
        };
        httpRequest.open("GET", "http://localhost/info2180-lab5/world.php?country=" + encodeURIComponent(countryInput) + "&lookup=cities");
        httpRequest.send();
    };


}