jQuery(document).ready(function($) {
    let close_icon ='<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10 0C4.47 0 0 4.47 0 10C0 15.53 4.47 20 10 20C15.53 20 20 15.53 20 10C20 4.47 15.53 0 10 0ZM15 13.59L13.59 15L10 11.41L6.41 15L5 13.59L8.59 10L5 6.41L6.41 5L10 8.59L13.59 5L15 6.41L11.41 10L15 13.59Z" fill="black" fill-opacity="0.23"/> </svg>';
    $('#industry-select').select2({
        placeholder: 'Search Industries',
        minimumInputLength: 2,
        ajax: {
            url: ajax_object.ajax_url,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    action: 'search_taxonomy_terms',
                    search: params.term,
                    taxonomy: 'industry', // Specify which taxonomy to search (e.g., category or tag)
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('#profession-select').select2({
        placeholder: 'Search Profession',
        minimumInputLength: 2,
        ajax: {
            url: ajax_object.ajax_url,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    action: 'search_taxonomy_terms',
                    search: params.term,
                    taxonomy: 'profession', // Specify which taxonomy to search (e.g., category or tag)
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });


    // $('#industry-select').select2();

//initialize a global array to store the selected options
    let selectedOptionsArray = [];

//select2 event to capture the selected value
    $('#industry-select').on('select2:select', function(e) {
        let selectedOption = e.params.data;
        console.log(selectedOption);
        let optionText = selectedOption.text;

        //check if option already exists in the array


        //else, add the option value to the array
        selectedOptionsArray.push(optionText);
        //append the option to the desired element
        $('ul#industry-suggestion').append(`<li>
            <div class="remove-option"  title="Remove item">
            ${optionText}
            </div>
            ${close_icon} 
          </li>`);
    });
    let selectedOptionsArray2 = [];

//select2 event to capture the selected value
    $('#profession-select').on('select2:select', function(e) {
        let selectedOption = e.params.data;
        console.log(selectedOption);
        let optionText = selectedOption.text;

        //check if option already exists in the array


        //else, add the option value to the array
        selectedOptionsArray2.push(optionText);

        //append the option to the desired element
        $('ul#profession-suggestion').append(`<li>
            <div class="remove-option"  title="Remove item">
            ${optionText}
            </div>
            ${close_icon} 
          </li>`);



//click event listener on the appended to remove it
        $('ul#profession-suggestion').on('click', '.remove-option', function() {
            //remove the option from global array
            let findIndex = selectedOptionsArray2.indexOf($(this).attr('data-value'));
            if (findIndex !== -1) {
                selectedOptionsArray2.splice(findIndex, 1);
            }

            //remove the option element
            $(this).parent().remove();        //here, parent() refers to the li
        });


    });



    document.getElementById("clear-filter").addEventListener("click", function() {
        console.log('cleared Filter');
        const professionSelect = document.getElementById("profession-suggestion");
        const industrySelect = document.getElementById("industry-suggestion");
        if (industrySelect) {
            industrySelect.innerHTML = ""; // Clears all list items
        }
        if (professionSelect) {
            professionSelect.innerHTML = ""; // Clears all list items
        }
    });


    document.getElementById("filter-content-close").addEventListener("click", function() {
        console.log('filter-content-close');
        document.getElementById("filter-popup").style.display = 'none';
    });


    document.getElementById("apply-filter").addEventListener("click", function() {
        const searchTerm = document.getElementById("podcast-search").value;

        // Get selected industries (assumes industries are checkboxes)
        const selectedIndustries = [];
        const industryListItems = document.querySelectorAll("#industry-suggestion li button");

        industryListItems.forEach(item => {
            selectedIndustries.push(item.textContent.trim());
        });
        const selectedProfession = [];
        const professionListItems = document.querySelectorAll("#profession-suggestion li button");

        professionListItems.forEach(item => {
            selectedProfession.push(item.textContent.trim());
        });
        // Get the selected profession from a select dropdown

        // Alternatively, if profession is selected via radio buttons:
        // const profession = document.querySelector("input[name='profession']:checked").value;

        // Gathered data
        const gatheredData = {
            searchTerm: searchTerm,
            industries: selectedIndustries,
            profession: selectedProfession
        };

        console.log(gatheredData);

// Create a new URL object using the current page URL
        let searchUrl = new URL(window.location.href);

// Clear existing search parameters to avoid duplication
        searchUrl.searchParams.delete('searchTerm');
        searchUrl.searchParams.delete('industries');
        searchUrl.searchParams.delete('profession');

// Add searchTerm as a query parameter if it exists
        if (gatheredData.searchTerm) {
            searchUrl.searchParams.append('searchTerm', gatheredData.searchTerm);
        }

// Add industries as a query parameter (assuming selectedIndustries is an array)
        if (gatheredData.industries && gatheredData.industries.length > 0) {
            searchUrl.searchParams.append('industries', gatheredData.industries.join(','));
        }

// Add profession as a query parameter if it exists
        if (gatheredData.profession) {
            searchUrl.searchParams.append('profession', gatheredData.profession);
        }

// Update the URL on the same page without reloading (if needed)
        history.replaceState(null, '', searchUrl.toString());

// Optionally reload the page to trigger the search based on the new URL
        window.location.search = searchUrl.search;



    });



//click event listener on the appended to remove it
    $(document).on('click', '.remove-option', function() {
        //remove the option from global array
        let findIndex = selectedOptionsArray.indexOf($(this).attr('data-value'));
        if (findIndex !== -1) {
            selectedOptionsArray.splice(findIndex, 1);
        }

        //remove the option element
        $(this).parent().remove();        //here, parent() refers to the li
    });






});
