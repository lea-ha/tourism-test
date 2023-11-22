class DisplayData {

    count = 0;
    placesNames = []; //this is used for the search bar
    districts = new Set(); //this can be used for filtering by districts
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

            const buttonFav = document.createElement('button');
            //buttonFav.innerText("View More"); ha ma aam temshe
            placeNameDOM.appendChild(buttonFav);
            

        });

    }

    displayTrip(jsonArray){
      //Need to implement js codes for DOM content of Trips. To view how the trips are saved in the array, 
      //go to console on index.php page.
      const parentContainer2 = document.querySelector('#container-trip');
      jsonArray.forEach(element =>{
        
        const tripdiv = document.createElement('div');
        tripdiv.className="trip";
        tripdiv.innerText = "Trip: " +  element.trip_name;

        const guideName = document.createElement('p');
        guideName.innerText = "Guide Name : " + element.guideName;

        const resto = document.createElement('p');
        resto.innerText =  "Restaurant : " + element.restaurants;

        const tripdate = document.createElement('p');
        tripdate.innerText = element.date;

        const activity = document.createElement('p');
        activity.innerText = "Activity: " + element.activities;

        const culture = document.createElement('p');
        culture.innerText = "Culture: " + element.cultures;

        const tripID = element.tripID;
        //console.log(tripID);

        tripdiv.appendChild(activity);
        tripdiv.appendChild(culture);
        tripdiv.appendChild(resto);
        tripdiv.appendChild(guideName);
        tripdiv.appendChild(tripdate);
        parentContainer2.appendChild(tripdiv);

        const buttonView = document.createElement('button');
        const buttonBook = document.createElement('button');

        const iconBooking = document.createElement('i');
        const iconDetails = document.createElement('i');
        iconBooking.className = "fa-solid fa-map";
        iconDetails.className = "fa-solid fa-circle-info";

        buttonView.innerText = "View Details  ";
        buttonBook.innerText = "Book a Seat  ";
        buttonBook.appendChild(iconBooking);
        buttonBook.addEventListener('click', function () {
          console.log("Button Book clicked for trip: " + element.trip_name);
          buttonBook.addEventListener('click', function () {
            // Make an AJAX request to the PHP file
            var xhr = new XMLHttpRequest();
    
            xhr.open('GET', 'sendToUserTrip.php?tripID='+tripID, true);
    
            // Define the function to handle the response from the server
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from the server
                    console.log(xhr.responseText);
                    alert(xhr.responseText);

                    // You can do something with the response here, if needed
                }
            };
    
            // Send the request
            xhr.send();
        });
        });
        buttonView.appendChild(iconDetails);
        //maybe should make a method for both trip and bus booking

        tripdiv.appendChild(buttonView);
        tripdiv.appendChild(buttonBook);
      })

    }  

    displayUserDetails($userID){

    }

    displayAdminDetails($guideID){
      
    }
  }

  

  
  