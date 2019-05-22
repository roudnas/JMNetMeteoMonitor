function handler(clicked_id) {
    if (clicked_id == "aktualneLi") {
        aktualne.style.display = "block";
        dennisouhrn.style.display = "none";
        mesicnisouhrn.style.display = "none";
        rokysouhrn.style.display = "none";
    } else if(clicked_id == "denniLi") {
      aktualne.style.display = "none";
      dennisouhrn.style.display = "block";
      mesicnisouhrn.style.display = "none";
      rokysouhrn.style.display = "none";
      dennisouhrn.classList.toggle("active")
    } else if(clicked_id == "mesicniLi") {
      aktualne.style.display = "none";
      dennisouhrn.style.display = "none";
      mesicnisouhrn.style.display = "block";
      rokysouhrn.style.display = "none";
    } else if(clicked_id == "rokyLi") {
      aktualne.style.display = "none";
      dennisouhrn.style.display = "none";
      mesicnisouhrn.style.display = "none";
      rokysouhrn.style.display = "block";
    }
}
