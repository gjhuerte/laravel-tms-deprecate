

// Function for showing what kind of buttons to be displayed on the 
// application. The options can be added depending on what kind of 
// buttons are needed by the user
var buttonsForDatatables = {

    // Show all the three buttons
    displayAll: function (baseUrl, callback) {
        let viewUrl = baseUrl + '/' + callback.id;
        let editUrl = baseUrl + '/' + callback.id + '/edit';
        let removeUrl  = baseUrl + '/' + callback.id;
        let buttons = buttonsForDatatables.view(viewUrl) + 
            buttonsForDatatables.edit(editUrl) + 
            buttonsForDatatables.remove(removeUrl);

        return buttons;
    },

    // Button for viewing a certain resource
    // This will redirect to the page of the
    // Specific resource
    view: function(url) {

        return `
            <a 
                href="` + url + `" 
                class="btn btn-outline-secondary my-1" >
                <i class="fas fa-folder" aria-hidden="true"></i> View
            </a>
        `;
    },

    // Button for updating a certain resource
    // This will redirect to the form page where
    // the certain resource can be updated
    edit: function(url) {
        
        return `
            <a 
                href="` + url + `" 
                class="btn btn-outline-warning my-1" >
                <i class="fas fa-pen" aria-hidden="true"></i> Edit
            </a>
        `;
    },
    
    // Button for removing the resource from the system
    // This will trigger the remove function
    remove: function(url) {

        return `
            <button 
                type="button" data-remove-url="` + url + `" 
                class="btn-remove btn btn-outline-danger my-1" >
                <i class="fas fa-trash" aria-hidden="true"></i> Remove
            </button>
        `;
    },

    // Functionality for remove button when clicked
    removeEventListener: function ($this) {
        let removeUrl = $this.data('remove-url');
        let loadingText = $('<i />', { class: 'fas fa-circle-o-notch fa-spin', 'aria-hidden': 'true' }).append(' Loading...');
        
        // Sets the button to loading when the
        // function is triggered
        if ($this.html() !== loadingText) {
            $this.data('original-text', $this.html());
            $this.html(loadingText);
        }

        // Create a confirmation alert before processing the data sent 
        // by the user to the server
        notification.alert.confirmation(confirmationTitle, confirmationMessage, function(result) {
        
            // Triggers when the user clicks the confirm button
            if (result.value) {

                // use the method delete of the ajax to create
                // a http header with the delete method using ajax
                ajax.delete(removeUrl, function() {
                    $this.html($this.data('original-text'));
                    table.ajax.reload();
                });
            } 

            // Triggers when the user click another button
            // in the form    
            else {
                $this.html($this.data('original-text'));
                notification.cancelled();
            }
        });
    }
};