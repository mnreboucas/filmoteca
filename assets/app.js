/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

//importando jquery
// const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

require('../node_modules/jquery/dist/jquery.min.js')
// require('@popperjs/core/dist/umd/popper.min.js');

require('./bootstrap');
// require('../node_modules/bootstrap/dist/css/bootstrap.min.css');
// require('../node_modules/bootstrap/dist/js/bootstrap.min.js');

require('@fortawesome/fontawesome-free/css/all.min.css');

require('../node_modules/bootstrap-table/dist/bootstrap-table.min.css');
require('../node_modules/bootstrap-table/dist/bootstrap-table.min.js');
require('../node_modules/bootstrap-table/dist/locale/bootstrap-table-pt-BR');


require('@fortawesome/fontawesome-free/js/all');

require('bootstrap-icons/font/bootstrap-icons.css')


// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
