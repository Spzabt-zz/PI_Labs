let delayTimer;

function find(e) {
    /*clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        //document.querySelector(".output").style.display = "block";
        document.getElementById("output").innerHTML = "";
        const q = e.target.value;
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `./getSearch?q=${q}`);
        xhr.send();
        xhr.onload = function() {
            document.getElementById("output").innerHTML = xhr.responseText;
            //document.querySelector(".loader").style.display = "none";
        }
        /!*xhr.onerror = function() {
            document.querySelector(".loader").style.display = "none";
        }*!/
    }, 1000);*/
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function () {

        const q = e.target.value;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", "./getSearch.php?q=" + q, true);
        //xhr.open("GET", "https://stoida.herokuapp.com/Lab7/getSearch.php?q=" + q, true);
        xhr.onreadystatechange = () => {
            if (this.readyState === XMLHttpRequest.DONE && xhr.status === 0
                || (xhr.status >= 200 && xhr.status < 400)) {
                document.getElementById("output").innerHTML = xhr.responseText;
                console.log(xhr.responseText);
                console.log(q);
            } else {
                console.log("Error!");
            }
        };
        xhr.send();
    }, 1000);
}