//https://dev.to/mrahmadawais/use-instead-of-document-queryselector-all-in-javascript-without-jquery-3ef1
const $ = document.querySelector.bind(document);
//const $$ = document.querySelectorAll.bind(document);

var animateThemeColour = false;
var themeColourHue = getCookie('themeColourHue');
if(animateThemeColour) {
  var hue = getComputedStyle(document.documentElement).getPropertyValue('--col-theme-hue');
  setInterval(function() {
    hue = parseInt(hue) + 1;
    document.documentElement.style.setProperty('--col-theme-hue', hue + '');
    console.log(hue);
  }, 50);
} else if(themeColourHue !== null) document.documentElement.style.setProperty('--col-theme-hue', themeColourHue);

window.onload = function() {
  setRibbon();
}

function getCookie(name) {
  var cookies = document.cookie.split('; ');
  for(var i = 0; i < cookies.length; i++) {
    var split = cookies[i].split('=');
    var key = split[0];
    var value = split[1];
    if(name === key) return value;
  }
  return null;
}

function setCookie(name, value) {
  document.cookie = name + '=' + value;
  console.log(name + ' cookie was set.');
}

function setRibbon() {
  try {
    var pathname = window.location.pathname.substring(1).split('/');
    var link = pathname[window.location.hostname === 'localhost' ? 1 : 0].split('.');
    $('#' + link[0] + '-link').classList.add('active');
  } catch (e) {
    console.log(e);
  }
}
