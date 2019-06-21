
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.swal = require('sweetalert2'); 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
	'single-ticket-table', 
	require('./components/tables/tickets/SingleTicket.vue').default
);

Vue.component(
	'ticket-list-table', 
	require('./components/tables/tickets/MyTicketList.vue').default
);

Vue.component(
	'button-loading', 
	require('./components/buttons/Processing.vue').default
);

Vue.component(
	'remove-button-loading-i', 
	require('./components/tables/partials/RemoveButtonViaAjax.vue').default
);

Vue.component(
	'a-button-loading', 
	require('./components/buttons/AnchorProcessing.vue').default
);

Vue.component(
	'wysiwyg-textarea', 
	require('./components/Textarea.vue').default
);

Vue.component(
	'multi-select',
	require('./components/MultiSelect.vue').default
);

Vue.component(
	'table-ajax', 
	require('./components/tables/BaseTemplate.vue').default
);

Vue.component(
	'button-confirmation', 
	require('./components/buttons/Confirmation.vue').default
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


const app = new Vue({
    el: '#app'
});

