//Needs adjustments


document.addEventListener("DOMContentLoaded", function () {
    const districtSelect = document.getElementById("district");
    const filteredResults = document.getElementById("filteredResults");
    const boxes = document.querySelectorAll(".place");

    // Function to render the initial content
    function renderAllResults() {
      // Clear previous results
      filteredResults.innerHTML = "";

      // Append all boxes to the filteredResults
      boxes.forEach((box) => {
        const clonedBox = box.cloneNode(true);
        filteredResults.appendChild(clonedBox);
      });
    }

    // Filter function
    function filterResults(selectedDistrict) {
      // Clear previous results
      filteredResults.innerHTML = "";

      // Filter boxes based on the selected district
      boxes.forEach((box) => {
        const boxDistrict = box.getAttribute("data-district");
        const boxName = box.getAttribute("data-name");

        if (
          //selectedDistrict === "All" ||
          selectedDistrict === boxDistrict
        ) {
          const clonedBox = box.cloneNode(true);
          console.log(`Name: ${boxName}`);
        } else {
          // Hide non-matching items
          box.style.display = "none";
        }
        // Check if the box matches the selected district
        const matchesDistrict =
          selectedDistrict === "All" || selectedDistrict === boxDistrict;

        // Show or hide the box based on the match
        box.style.display = matchesDistrict ? "block" : "none";

        if (matchesDistrict) {
          console.log(`Name: ${boxName}`);
        }
      });
    }

    // Add event listener to the select element
    districtSelect.addEventListener("change", function () {
      const selectedDistrict = districtSelect.value;
      filterResults(selectedDistrict);
    });
  });