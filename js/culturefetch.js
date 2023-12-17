

fetch('culture.php')
    .then(function(response) {
        return response.json();
    })
    .then(function(jsondata) {
        console.log(jsondata);
        const myDisplayData = new DisplayData();
        myDisplayData.display(jsondata,'culture');
        console.log("done");
        //DisplayData.setCallerScript('culture');
        console.log(myDisplayData.placesNames);
        const mySearchBar = new SearchBar(myDisplayData.placesNames);
        mySearchBar.search();
    })
    .catch(function(error) {
        console.error('Fetch error: ', error);
    });

    