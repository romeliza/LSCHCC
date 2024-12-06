<script>
    let regions = {}; // Define a global variable for regions

    document.addEventListener('DOMContentLoaded', function() {
        fetch('/MIM/locations')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data); // Debugging

            if (data && typeof data === 'object') {
                regions = data; // Assign data to global variable
                populateRegions(data);
            } else {
                console.error('Invalid data structure:', data);
            }
        })
        .catch(error => console.error('Error fetching location data:', error));

    function populateRegions(regions) {
        const regionSelect = document.getElementById('region');
        regionSelect.innerHTML = '<option value="">Select Region</option>'; // Clear previous options

        Object.keys(regions).forEach(regionKey => {
            const region = regions[regionKey];
            const option = document.createElement('option');
            option.value = regionKey;
            option.textContent = region.region_name;
            regionSelect.appendChild(option);
        });

        regionSelect.addEventListener('change', function() {
            const selectedRegion = regionSelect.value;
            if (selectedRegion) {
                populateProvinces(regions[selectedRegion].province_list || {});
            } else {
                populateProvinces({});
                populateMunicipalities([]);
                populateBarangays([]);
            }
        });
    }

    function populateProvinces(provinces) {
        const provinceSelect = document.getElementById('province');
        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        
        if (Object.keys(provinces).length === 0) {
            console.warn('No provinces available for this region.');
            return; // No provinces to show
        }

        Object.keys(provinces).forEach(provinceKey => {
            const province = provinces[provinceKey];
            const option = document.createElement('option');
            option.value = provinceKey;
            option.textContent = province.province_name || provinceKey; // Fallback if province_name is undefined
            provinceSelect.appendChild(option);
        });

        // Clear municipalities and barangays when changing province
        provinceSelect.addEventListener('change', function() {
            const selectedProvince = provinceSelect.value;
            const selectedRegion = document.getElementById('region').value;
            if (selectedProvince) {
                const municipalityList = regions[selectedRegion].province_list[selectedProvince]?.municipality_list || {};
                populateMunicipalities(Object.keys(municipalityList));
                populateBarangays([]);
            } else {
                populateMunicipalities([]);
                populateBarangays([]);
            }
        });
    }

    function populateMunicipalities(municipalities) {
        const municipalitySelect = document.getElementById('municipality');
        municipalitySelect.innerHTML = '<option value="">Select Municipality/City</option>';

        municipalities.forEach(municipalityKey => {
            const option = document.createElement('option');
            option.value = municipalityKey;
            option.textContent = municipalityKey; // Update as needed for actual name
            municipalitySelect.appendChild(option);
        });

        municipalitySelect.addEventListener('change', function() {
            const selectedMunicipality = municipalitySelect.value;
            const selectedProvince = document.getElementById('province').value;
            const selectedRegion = document.getElementById('region').value;
            if (selectedMunicipality) {
                const barangayList = regions[selectedRegion].province_list[selectedProvince]?.municipality_list[selectedMunicipality]?.barangay_list || [];
                populateBarangays(barangayList);
            } else {
                populateBarangays([]);
            }
        });
    }

    function populateBarangays(barangays) {
        const barangaySelect = document.getElementById('barangay');
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay; // Update as needed for actual name
            barangaySelect.appendChild(option);
        });
    }
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/MIM/locations')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data); // Debugging

            if (data && typeof data === 'object') {
                regions = data; // Assign data to global variable
                populateRegions(data);
                
                // Set initial values if editing
                setInitialValues();
            } else {
                console.error('Invalid data structure:', data);
            }
        })
        .catch(error => console.error('Error fetching location data:', error));

    function populateRegions(regions) {
        const regionSelect = document.getElementById('region');
        regionSelect.innerHTML = '<option value="">Select Region</option>'; // Clear previous options

        Object.keys(regions).forEach(regionKey => {
            const region = regions[regionKey];
            const option = document.createElement('option');
            option.value = regionKey;
            option.textContent = region.region_name;
            regionSelect.appendChild(option);
        });

        regionSelect.addEventListener('change', function() {
            const selectedRegion = regionSelect.value;
            if (selectedRegion) {
                populateProvinces(regions[selectedRegion].province_list || {});
            } else {
                // Clear the subsequent selects if no region is selected
                populateProvinces({});
                populateMunicipalities([]);
                populateBarangays([]);
            }
        });
    }

    function populateProvinces(provinces) {
        const provinceSelect = document.getElementById('province');
        provinceSelect.innerHTML = '<option value="">Select Province</option>';

        Object.keys(provinces).forEach(provinceKey => {
            const province = provinces[provinceKey];
            const option = document.createElement('option');
            option.value = provinceKey;
            option.textContent = provinceKey;
            provinceSelect.appendChild(option);
        });

        provinceSelect.addEventListener('change', function() {
            const selectedProvince = provinceSelect.value;
            const selectedRegion = document.getElementById('region').value;
            if (selectedProvince) {
                populateMunicipalities(
                    Object.keys(regions[selectedRegion].province_list[selectedProvince]?.municipality_list || {})
                );
                populateBarangays([]);
            } else {
                // Clear the subsequent selects if no province is selected
                populateMunicipalities([]);
                populateBarangays([]);
            }
        });
    }

    function populateMunicipalities(municipalities) {
        const municipalitySelect = document.getElementById('municipality');
        municipalitySelect.innerHTML = '<option value="">Select Municipality/City</option>';

        municipalities.forEach(municipalityKey => {
            const option = document.createElement('option');
            option.value = municipalityKey;
            option.textContent = municipalityKey;
            municipalitySelect.appendChild(option);
        });

        municipalitySelect.addEventListener('change', function() {
            const selectedMunicipality = municipalitySelect.value;
            const selectedProvince = document.getElementById('province').value;
            const selectedRegion = document.getElementById('region').value;
            if (selectedMunicipality) {
                populateBarangays(
                    regions[selectedRegion].province_list[selectedProvince]?.municipality_list[selectedMunicipality]?.barangay_list || []
                );
            } else {
                // Clear the subsequent selects if no municipality is selected
                populateBarangays([]);
            }
        });
    }

    function populateBarangays(barangays) {
        const barangaySelect = document.getElementById('Barangay');
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        });
    }

    function setInitialValues() {
        const initialRegion = document.getElementById('region').dataset.initialValue;
        const initialProvince = document.getElementById('province').dataset.initialValue;
        const initialMunicipality = document.getElementById('municipality').dataset.initialValue;
        const initialBarangay = document.getElementById('Barangay').dataset.initialValue;

        if (initialRegion) {
            document.getElementById('region').value = initialRegion;
            document.getElementById('region').dispatchEvent(new Event('change')); // Trigger change event to populate provinces
        }
        if (initialProvince) {
            document.getElementById('province').value = initialProvince;
            document.getElementById('province').dispatchEvent(new Event('change')); // Trigger change event to populate municipalities
        }
        if (initialMunicipality) {
            document.getElementById('municipality').value = initialMunicipality;
            document.getElementById('municipality').dispatchEvent(new Event('change')); // Trigger change event to populate barangays
        }
        if (initialBarangay) {
            document.getElementById('Barangay').value = initialBarangay;
        }
    }
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all input fields that need to be uppercase
        const uppercaseInputs = document.querySelectorAll(' input[type="search"], textarea');

        uppercaseInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    });
</script>