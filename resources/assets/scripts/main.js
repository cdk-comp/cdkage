// import external dependencies
window.$ = window.jQuery = require("jquery");
import objectFitImages from 'object-fit-images';

//Get scripts from all modules
const requireModules = require.context('../../modules/', true, /\.js$/);

// On Load Events
$(window).on('load', () => {
  if (typeof Promise === 'undefined') {
    window.Promise = require('es6-promise').Promise;
  }

  objectFitImages();
});

$(document).ready(() => {
  requireModules.keys().forEach(requireModules);
});

