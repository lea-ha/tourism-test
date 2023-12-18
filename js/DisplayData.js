class DisplayData {

    //callerScript = 'not set'; //to know if activity, resto or culture
    static callerScript = 'not set';
    count = 0;
    placesNames = []; //this is used for the search bar
    districts = new Set(); //this can be used for filtering by districts
    parentContainer = document.querySelector('.place-container');

    constructor() {
      //this.callerScript = 'not set';
    }

// static setCallerScript(scriptName){
//       DisplayData.callerScript = scriptName;
//       console.log(this.callerScript);
//     }
  
    display(jsonArray,scriptName) {
      // DisplayData.callerScript = scriptName;
      // console.log(DisplayData.callerScript);
      //This method is responsible for creating the DOM elements for activities, restaurants, cultural places alone, 
      //after these elements have been fetched from their respective php files and returned an object array.
      //scriptName is to know from which of activity restaurant and culture I'm calling the method
        jsonArray.forEach(element => {
            const place = document.createElement('div');
            place.className = "place";
            const placeName = element.name;

            //console.log(element.activityID); just checking if working
           
            const district = element.district;
            this.districts.add(district);

            const districtDOM = document.createElement('p');
            districtDOM.textContent = "district : " + district;

            //const placePic = element.picture; <-- need to take care of this to be displayed on DOM once we have pics in db
            // Having an error when i am inserting image in db.
            this.placesNames[this.count] = placeName;
            this.count++;
            const placeNameDOM = document.createElement('h2');
            placeNameDOM.textContent = "Place: " + placeName;
            placeNameDOM.className = "placeName";

            placeNameDOM.appendChild(districtDOM);
            place.appendChild(placeNameDOM);
            this.parentContainer.appendChild(place);

            const buttonOptions = document.createElement('div');
            buttonOptions.className = 'options';
            const buttonViewMore = document.createElement('a');
            buttonViewMore.innerText = "View More";
            const buttonAddFav = document.createElement('a');
            //need to pre set text to what s in db

            this.setFavButtonText(buttonAddFav,scriptName,element);
            //buttonAddFav.innerText = "Add to Favorites";
            


            buttonOptions.appendChild(buttonViewMore);
            buttonOptions.appendChild(buttonAddFav);
            
            placeNameDOM.appendChild(buttonOptions);

            buttonAddFav.addEventListener('click', function(){
              console.log('clicked on button'); //ok
              let addFav = new XMLHttpRequest();

              addFav.onreadystatechange = function () {
                if (addFav.readyState === XMLHttpRequest.DONE) {
                  console.log("ready state done");
                    if (addFav.status === 200) {
                        let response = addFav.responseText;
                        buttonAddFav.innerText = response;
                        console.log("Response from PHP: " + response);
                        //alert(response); 
                    } else {
                        console.error("Error: " + addFav.status);
                    }
                }
            };

            // addFav.open('GET', 'favorites.php?activityID=' + element.activityID, true);
            // addFav.send();

            if(scriptName === 'not set'){
              console.log("not set");
            }

            if(scriptName === 'activity'){
              //console.log('sending to activity');
              addFav.open('GET', 'favorites.php?activityID=' + element.activityID, true);
              addFav.send();
            } 

            if(scriptName === 'restaurant'){
              addFav.open('GET', 'favorites.php?restaurantID=' + element.restaurantID, true);
              addFav.send();
            }

            if(scriptName === 'culture'){
              addFav.open('GET', 'favorites.php?cultureID=' + element.cultureID, true);
              addFav.send();
            }
          

            });

        });

    }

    displayTrip(jsonArray){

    
      //Need to implement js codes for DOM content of Trips. To view how the trips are saved in the array, 
      //go to console on index.php page.
      const parentContainer2 = document.querySelector('#container-trip');
      jsonArray.forEach(element =>{
        
        const tripdiv = document.createElement('div');
        tripdiv.className="trip";
        //tripdiv.innerText = "Trip: " +  element.trip_name;

        const tripdivH2 = document.createElement('h2');
        tripdivH2.innerText = element.trip_name;
        tripdiv.appendChild(tripdivH2);

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

        const buttonOptions = document.createElement('div');
        buttonOptions.className = 'options';

        buttonView.innerText = "View Details  ";
        buttonBook.innerText = "Book a Seat  ";
        buttonBook.appendChild(iconBooking);

        buttonView.appendChild(iconDetails);
        //maybe should make a method for both trip and bus booking

        buttonOptions.appendChild(buttonView);
        buttonOptions.appendChild(buttonBook);
        tripdiv.appendChild(buttonOptions);

        buttonBook.addEventListener('click', function () {
          console.log("Button clicked");

          //To register for trip, send request to php file responsible for
          //registering users in trips

          let xhr = new XMLHttpRequest();

          xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                      var response = xhr.responseText;
                      console.log("Response from PHP: " + response);
                      alert(response); 
                  } else {
                      console.error("Error: " + xhr.status);
                  }
              }
          };

          xhr.open('GET', 'sendToUserTrip.php?tripID=' + tripID, true);
          xhr.send();
      });


        //tripdiv.appendChild(buttonView);
        //tripdiv.appendChild(buttonBook);
      })

    }  

    displayUserDetails($userID){

    }

    displayAdminDetails($guideID){
      
    }

    setFavButtonText(buttonElement, nameOfScript, elementToFetchFrom){

      // addFav.open('GET', 'favorites.php?activityID=' + element.activityID, true);
      // addFav.send();
      if(nameOfScript === 'activity'){
        const url = `checkFavorites.php?activityID=${elementToFetchFrom.activityID}`;
        fetch(url)
        .then(response => response.text())
        .then(text => {
            buttonElement.innerText = text;
        })
        .catch(error => console.error('Error fetching button text:', error));
      }

      if(nameOfScript === 'culture'){
        const url = `checkFavorites.php?cultureID=${elementToFetchFrom.cultureID}`;
        fetch(url)
        .then(response => response.text())
        .then(text => {
            buttonElement.innerText = text;
        })
        .catch(error => console.error('Error fetching button text:', error));
      }

      if(nameOfScript === 'restaurant'){
        const url = `checkFavorites.php?restaurantID=${elementToFetchFrom.restaurantID}`;
        fetch(url)
        .then(response => response.text())
        .then(text => {
            buttonElement.innerText = text;
        })
        .catch(error => console.error('Error fetching button text:', error));
      }

    }
  }

  

  
  