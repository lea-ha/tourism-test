class DisplayData {

    count = 0;
    placesNames = [];
    districts = new Set();
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
           
            const district = element.district;
            this.districts.add(district);

            const districtDOM = document.createElement('p');
            districtDOM.textContent = "district : " + district;

            //const placePic = element.picture; <-- need to take care of this to be displayed on DOM once we have pics in db
            // Having an error when i am inserting image in db.
            this.placesNames[this.count] = placeName;
            this.count++;
            const placeNameDOM = document.createElement('p');
            placeNameDOM.textContent = "Place: " + placeName;
            placeNameDOM.className = "placeName";

            placeNameDOM.appendChild(districtDOM);
            place.appendChild(placeNameDOM);
            this.parentContainer.appendChild(place);
        });
    }

    displayTrip(jsonArray){
      //Need to implement js codes for DOM content of Trips
      const parentContainer2 = document.querySelector('#container-trip');
      jsonArray.forEach(element =>{
        const tripdiv = document.createElement('div');
        tripdiv.className="trip";
        tripdiv.innerText = "Trip: " +  element.trip_name;

        const guideName = document.createElement('p');
        guideName.innerText = "Guide Name : " + element.first_name + " " + element.last_name;

        const resto = document.createElement('p');
        resto.innerText =  "Restaurant : " + element.restaurant_name;

        const tripdate = document.createElement('p');
        tripdate.innerText = element.date;

        const activity = document.createElement('p');
        activity.innerText = "Activity: " + element.activity_name;

        const culture = document.createElement('p');
        culture.innerText = "Culture: " + element.culture_name;

        tripdiv.appendChild(activity);
        tripdiv.appendChild(culture);
        tripdiv.appendChild(resto);
        tripdiv.appendChild(guideName);
        tripdiv.appendChild(tripdate);
        parentContainer2.appendChild(tripdiv);
      })
    }
  }
  
  