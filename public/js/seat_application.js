document.addEventListener("DOMContentLoaded", function () {
    const divisionSelect = document.getElementById("division");
    const districtSelect = document.getElementById("district");

    if (!divisionSelect || !districtSelect) return;

    // Bangladesh divisions and districts data
    const divisionsData = {
        dhaka: [
            "Dhaka",
            "Gazipur",
            "Narayanganj",
            "Tangail",
            "Narsingdi",
            "Kishoreganj",
            "Manikganj",
            "Munshiganj",
            "Rajbari",
            "Madaripur",
            "Gopalganj",
            "Faridpur",
            "Shariatpur",
        ],
        chittagong: [
            "Chittagong",
            "Comilla",
            "Chandpur",
            "Lakshmipur",
            "Noakhali",
            "Feni",
            "Brahmanbaria",
            "Rangamati",
            "Bandarban",
            "Khagrachari",
            "Cox's Bazar",
        ],
        rajshahi: [
            "Rajshahi",
            "Natore",
            "Naogaon",
            "Chapainawabganj",
            "Pabna",
            "Bogura",
            "Sirajganj",
            "Joypurhat",
        ],
        khulna: [
            "Khulna",
            "Bagerhat",
            "Satkhira",
            "Jessore",
            "Magura",
            "Jhenaidah",
            "Narail",
            "Kushtia",
            "Chuadanga",
            "Meherpur",
        ],
        barisal: [
            "Barisal",
            "Bhola",
            "Pirojpur",
            "Patuakhali",
            "Barguna",
            "Jhalokati",
        ],
        sylhet: ["Sylhet", "Moulvibazar", "Habiganj", "Sunamganj"],
        rangpur: [
            "Rangpur",
            "Dinajpur",
            "Kurigram",
            "Gaibandha",
            "Nilphamari",
            "Panchagarh",
            "Thakurgaon",
            "Lalmonirhat",
        ],
        mymensingh: ["Mymensingh", "Jamalpur", "Sherpur", "Netrokona"],
    };

    // Function to populate districts based on selected division
    function populateDistricts(division) {
        // Clear existing options
        districtSelect.innerHTML =
            '<option value="" disabled selected>Select District</option>';

        if (division && divisionsData[division]) {
            divisionsData[division].forEach((district) => {
                const option = document.createElement("option");
                option.value = district.toLowerCase().replace(/\s+/g, "_");
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }

    // Event listener for division change
    divisionSelect.addEventListener("change", function () {
        populateDistricts(this.value);
    });

    // Initialize districts if division is pre-selected (for edit forms)
    if (divisionSelect.value) {
        populateDistricts(divisionSelect.value);

        // If district is also pre-selected, set it
        if (districtSelect.value) {
            const districtOption = districtSelect.querySelector(
                `option[value="${districtSelect.value}"]`
            );
            if (districtOption) {
                districtOption.selected = true;
            }
        }
    }
});
