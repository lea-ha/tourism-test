fetch('trips.php')
    .then(function(response) {
        return response.json();
    })
    .then(function(jsondata) {
        console.log(jsondata);
        const myDisplayData = new DisplayData();
        myDisplayData.displayTrip(jsondata);
        console.log("done");
    })
    .catch(function(error) {
        console.error('Fetch error: ', error);
    });