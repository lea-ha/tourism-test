class SearchBar{

    constructor(namesArray) {
      this.searchbarID = document.getElementById('search');
      this.namesArray = namesArray;
    }

    search(){
        this.searchbarID.addEventListener("input", e => {

            const names = document.querySelectorAll('.placeName'); 
            //console.log(names);
            for(let y=0; y<names.length; y=y+1){
              const value = e.target.value.toLowerCase();
              const isVisible = this.namesArray[y].toLowerCase().includes(value);
              names[y].classList.toggle("hide", !isVisible);
            }
        })
    }


}