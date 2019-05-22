function loadTab(str) {
    if (str == "aktualne") {
        document.getElementById("outputAjax").innerHTML = document.getElementById('aktualneAjaxOutput').innerHTML;
        return;
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (document.getElementById("outputAjax").innerHTML = "") {
                document.getElementById("outputAjax").innerHTML = "<p><img src='images/loading.gif'></p>";
              }
                document.getElementById("outputAjax").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","views/home/" + str + ".phtml",true);
        xmlhttp.send();
    }
}
