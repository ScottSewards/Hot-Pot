/*
var element = Find("#search");
element.addEventListener("click", function(){
var classes = GetClasses(element);
console.log(classes);
});

var tabs = Find('.tabs');
for (var i = 0; i < tabs.length; i++) {
AddClass(tabs[i], "test");
}

function Find(identifier){
  var denominator = identifier.charAt(0);
  var split = identifier.slice(1, identifier.length);

  if (denominator == "<") {
    return document.getElementsByTagName(split);
  }
  else if (denominator == ".") {
    return document.getElementsByClassName(split);
  }
  else if (denominator == "#") {
    return document.getElementById(split);
  }
  else {
    return document.getElementsByName(identifier)
  }
}

function AddClass(element, set){
  element.classList.add(set);
}

function CheckClass(element, set){
  return element.classList.contains(set);
}

function GetClasses(element){
  return element.className.split(' ');
}

function RemoveClass(element, set){
  element.classList.remove(set);
}

function ToggleClass(element, set){
  element.classList.toggle(set);
}

function CreateElement(){

}

function RemoveElement(){

}

function GetID(element){
  return element.id;
}

function SetID(element, set){
  element.id = set;
}

function AddTabs(element){
  console.log(element);
}

function GetText(element){
  return element.innerHTML;
}

function SetText(element, set){
  element.innerHTML = set;
}
*/
