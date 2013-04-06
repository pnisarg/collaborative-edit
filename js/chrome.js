define(function(require, exports, module) {

exports.isDark = false;
exports.cssClass = "ace-chrome";
exports.cssText = require("/CSS/chrome.css");

var dom = require("../lib/dom");
dom.importCssString(exports.cssText, exports.cssClass);
});