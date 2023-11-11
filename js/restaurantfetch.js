fetch('restaurant.php')
    .then(function(response) {
        return response.json();
    })
    .then(function(jsondata) {
        console.log(jsondata);
        const myDisplayData = new DisplayData();
        myDisplayData.display(jsondata);
        console.log("done");
    })
    .catch(function(error) {
        console.error('Fetch error: ', error);
    });
