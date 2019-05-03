

// Function for showing what kind of buttons to be displayed on the 
// application. The options can be added depending on what kind of 
// buttons are needed by the user
var buttonsForDatatables = {

    // Show all the three buttons
    displayAll: function (args) {
        let viewUrl = args.baseUrl + '/' + args.callback.id;
        let editUrl = args.baseUrl + '/' + args.callback.id + '/edit';
        let removeUrl  = args.baseUrl + '/' + args.callback.id;
        let buttons = buttonsForDatatables.view(typeof args.view !== 'undefined' ? args.view.url : viewUrl) + 
            buttonsForDatatables.edit(typeof args.edit !== 'undefined' ? args.edit.url : editUrl) + 
            buttonsForDatatables.remove(typeof args.remove.url !== 'undefined' ? args.remove.url : removeUrl, args.remove.authorization);

        return buttons;
    },

    // Create button
    create: function (url) {

        return $('<a />', {
            'id': 'create',
            'href': url,
            class: "btn btn-primary text-light",
            text: 'Create'
        }).prepend(
            $('<i />', { class: 'fas fa-plus mr-2', 'aria-hidden': 'true' })
        ).prop('outerHTML');
    },

    // Button for viewing a certain resource
    // This will redirect to the page of the
    // Specific resource
    view: function(url) {

        return $('<a />', {
            'id': 'view',
            'href': url,
            class: "btn btn-outline-secondary my-1 mx-1",
            text: 'View'
        }).prepend(
            $('<i />', { class: 'fas fa-folder mr-2', 'aria-hidden': 'true' })
        ).prop('outerHTML');
    },

    // Button for updating a certain resource
    // This will redirect to the form page where
    // the certain resource can be updated
    edit: function(url) {

        return $('<a />', {
            'id': 'edit',
            'href': url,
            class: "btn btn-outline-warning my-1 mx-1",
            text: 'Edit'
        }).prepend(
            $('<i />', { class: 'fas fa-pend mr-2', 'aria-hidden': 'true' })
        ).prop('outerHTML');
    },
    
    // Button for removing the resource from the system
    // This will trigger the remove function
    remove: function(url, authorization) {

        return $('<button />', {
            'id': 'remove',
            'type': 'button',
            'data-authorization': authorization,
            'data-remove-url': url,
            class: "btn btn-remove btn-outline-danger my-1 mx-1",
            text: 'Remove'
        }).prepend(
            $('<i />', { class: 'fas fa-trash mr-2', 'aria-hidden': 'true' })
        ).prop('outerHTML');
    },

    // Functionality for remove button when clicked
    removeEventListener: function ($this, table, confirmationTitle, confirmationMessage) {
        let removeUrl = $this.data('remove-url');
        let authorization = $this.data('authorization');
        let loadingText = $('<span />').append(
            $('<i />', { 
                class: 'fas fa-circle-o-notch fa-spin pr-1', 
                'aria-hidden': 'true' 
            }),

            $('<span />', {
                text: 'Processing...'
            })
        )
        
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
                notification.alert.delete(removeUrl, authorization, function() {
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