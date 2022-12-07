function find(e) {
    const q = e.target.value;
    const xhr = new XMLHttpRequest();

    xhr.open("GET", "./getSearch.php?q=" + q, true);
    xhr.onreadystatechange = () => {
        /*if (this.readyState === XMLHttpRequest.DONE && xhr.status === 0
            || (xhr.status >= 200 && xhr.status < 400)) {*/
        document.getElementById("output").innerHTML = xhr.responseText;
        console.log(xhr.responseText);
        /*} else {
            console.log("Error!");
        }*/
    };
    xhr.send();
}