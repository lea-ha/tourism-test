class DisplayData {

    count = 0;
    placesNames = [];
    parentContainer = document.querySelector('.place-container');

    constructor() {
      
    }
  
    display(jsonArray) {
      //This method is responsible for creating the DOM elements for activities, restaurants, cultural places alone, 
      //after these elements have been fetched from their respective php files and returned an object array.
        jsonArray.forEach(element => {
            const place = document.createElement('div');
            place.className = "place";
            const placeName = element.name;
            //const placePic = element.image; <-- need to take care of this to be displayed on DOM once we have pics in db
            this.placesNames[this.count] = placeName;
            this.count++;
            const placeNameDOM = document.createElement('p')
            placeNameDOM.textContent = placeName;
            placeNameDOM.className = "placeName";
            place.appendChild(placeNameDOM);
            this.parentContainer.appendChild(place);
        });
     
    }
  }
  
  