fetch('restaurant.php')
    .then(function(response) {
        return response.json();
    })
    .then(function(jsondata) {
        console.log(jsondata);
        const myDisplayData = new DisplayData();
        myDisplayData.display(jsondata);
        console.log("done");
        const mySearchBar = new SearchBar(myDisplayData.placesNames);
        mySearchBar.search();
    })
    .catch(function(error) {
        console.error('Fetch error: ', error);
    });
