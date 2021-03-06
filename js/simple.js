//https://dev.to/mrahmadawais/use-instead-of-document-queryselector-all-in-javascript-without-jquery-3ef1
const $ = (css, parent = document) => parent.querySelector(css);
const $$ = (css, parent = document) => Array.from(parent.querySelectorAll(css));

var themeColourHue = getCookie('themeColourHue');
if(themeColourHue !== null) document.documentElement.style.setProperty('--col-theme-hue', themeColourHue);

var colourScheme = getCookie('colourScheme');
if(colourScheme !== null) setColourScheme(colourScheme);

window.onload = function() {
  addRibbon();
  addShowPassword();

  window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', (e) => {
    setColourScheme(getCookie('colourScheme'));
  });

  endPreloader();
}

window.onbeforeunload = function(){
  startPreloader();
};

function startPreloader() {
  fade("body", "out");
  //ADD ELEMENT
}

function endPreloader() {
  fade("body", "in");
}

function addShowPassword() {
  $$("[type='password']").forEach((item, i) => {
    var show = false;
    var name = "[name='show-" + item.name + "']";
    $(name).addEventListener("click", function(e) {
      show = !show;
      $("[name='show-" + item.name + "']").value = show ? "Hide" : "Show";
      $("[name='" + item.name + "']").type = show ? "text" : "password";
    });
  });
}

function setColourScheme(colourScheme) {
  switch(parseInt(colourScheme)) {
    case 1:
      $(':root').classList.add('dark');
      break;
    case 2:
      if(window.matchMedia('(prefers-color-scheme: light)').matches == true) $(':root').classList.remove('dark');
      else $(':root').classList.add('dark');
      break;
    default:
      $(':root').classList.remove('dark');
  }
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
}

function addRibbon() {
  try {
    var pathname = window.location.pathname.substring(1).split('/');
    var link = pathname[window.location.hostname === 'localhost' ? 1 : 0].split('.');
    $('#' + link[0] + '-link').classList.add('active');
  } catch (e) {
    //console.log(e);
  }
}

function fade(element, state) {
  $(element).style.opacity = state == "in" ? 1 : 0;
}

/*
//https://developer.mozilla.org/en-US/docs/Web/API/Navigator/clipboard
//https://developer.mozilla.org/en-US/docs/Web/API/Clipboard/writeText
function copyToClipboard() {
  //navigator.clipboard.writeText().then(e => alert(e));
}

*/
