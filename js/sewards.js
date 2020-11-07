window.onload = function() {
  //$("a[href*='" + location.pathname.substring(8, -1) + "']").addClass("active"); //SET RIBBON

  $("#primary, #secondary").click(function() { //TAB NAVIGATION
    var hasClass = $(this).hasClass("active");
    $("#primary, #secondary").removeClass("active");
    if(!hasClass) $(this).addClass("active");
  });

  $("[name='show-password']").click(function() { //SHOW PASSWORD
    if($(this).val() == "Show") $(this).val("Hide").prev().attr("type", "text");
    else $(this).val("Show").prev().attr("type", "password");
  });


  $('.slideshow').each(function() { //SLIDESHOW
    setInterval(function() {
      var clone = $(this).find("> figure > figcaption").remove();
      //var source = $(this).find('img:first-child').attr('src');
      //var alt = $(this).find('img:first-child').attr('alt');
      //$(this).find("> figure").append("<img src='" + source + "' alt='" + alt + "'></img>").find('img:first-child').remove();
      //$(this).find("> figure").prepend(clone);
    }, 5000);
  });

  $(".accordion").each(function() {
    var accordion = $(this), index = 1;
    $(this).find("> p").each(function() {
      $(this).addClass("accordion-" + index);
      index++;
    });

    index = 1;
    $(this).find("> div").each(function() {
      $(this).addClass("accordion-" + index);
      index++;
    });

    $(accordion).find("> p").click(function() {
      var listItemClasses = $(this).attr('class');
      $(accordion).find('> p, > div').removeClass('active').each(function() {
        if($(this).hasClass(listItemClasses)) $(this).addClass('active');
      });
    });
  });


  $('.tabs').each(function() { //TABS
    var tabs = $(this), index = 1;
    $(this).find('> ol, > ul').addClass('tab-options').find('> li').each(function() {
      $(this).addClass('tab-' + index);
      index++;
    });

    index = 1;
    $(tabs).find('> div').each(function() {
      $(this).addClass('tab-' + index);
      index++;
    });

    $(tabs).find('> ol > li, > ul > li').click(function() {
      var listItemClasses = $(this).attr('class');
      $(tabs).find('> ol > li, > ul > li, > div').removeClass('active').each(function() {
        if($(this).hasClass(listItemClasses)) $(this).addClass('active');
      });
    });
  });
}

/*
$('main a').mouseenter(function(){ //ANCHOR PREVIEW
  var con = $(this).text();
  var src = $(this).attr('href');
  $(this).append('<div class="preview"><p>' + con + '</p><img src="media/img/land.jpg"></img><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p></div>')
});
$('main a').mouseleave(function(){
  $('div.preview').remove();
});


//CACHE API
//INDEXED DB
//STORAGE MANAGE API

  //Custom Media Player
  $('button[name=playback]').click(function(){
    if (pl == false) {
      $(this).text("Pause");
      $('video').get(0).play();
    } else {
      $(this).text("Play");
      $('video').get(0).pause();
    }
    pl = !pl;
  });
  $('button[name=sound]').click(function(){
  if (so == false) {
    $(this).text("Unmute");
  } else {
    $(this).text("Mute");
  }
    so = !so;
  });
  $('button[name=window]').click(function(){
  if (wi == false) {
    $(this).text("Default screen");
  } else {
    $(this).text("Full screen");
  }
    wi = !wi;
  });
  $('button[name=download]').click(function(){});



  #AMAZON
  https://aws.amazon.com/documentation/gettingstarted/
  https://affiliate-program.amazon.com/gp/advertising/api/detail/main.html
  Access Key AKIAIR5LWKDN2GVFVQEQ

  $('nav li', 'button', 'a', 'audio', 'img', 'video').each(function() { //ACCESSIBILITY
    $(this).href('wai-aria', num)
    num += 1;
  });


  $(function(){
    var uni = "http://teaching.ehustudent.co.uk/add-my-comment/22918078";
    $('#getHere').get(uni, {/*JSLN},function(){
      alert(data +  status);
    });
  });

  var xhr = new XMLHttpRequest();

  $(function(){
    var formData = $('#login').serialize;
    $.post("test.php", "user=scott", proData).error(proError);
    //$.postJSON(url, formData{
    //  "first": "value",
    //  "second": "value"
    //}, proData).error(proError);
  });

  function proData(data, status){
    alert(status);
    $(this).append('<p>' + data.firstName + '</p>')
  }

  function proError(data){
    var msg = $(this).text("There was an error.");
  }






    /*$('aside.toc ul').append('<li class="bold" id="stt">Scroll to Top</li>');
    var h1Count = $('h1').length;
    var num = 1;
    while (num < h1Count + 1) {
      $('h1').each(function(){
        var context = $(this).text()
        $(this).attr('id', 'h1-' + num);
        $('aside.toc ul').append('<li><a href="#h1-' + num + '">' + num + '. ' + context + '</a></li>');
        num = num + 1;
      });
      $('aside.toc ul').append('<li class="bold" id="stb">Scroll to Bottom</li>');
    }

    $('li#stt').click(function(){
      window.scrollTo(0, 0);
    });
    $('li#stb').click(function(){
      window.scrollTo(0, $(document).height());
    });

    $('button[name=contrast]').click(function(){
      if (con == true) {
        $('link#contrast').attr('href', 'css/color.css');
        con = false;
      } else {
        $('link#contrast').attr('href', 'css/contrast.css');
        con = true;
      }
    });

    $('button[name*=font-]').click(function(){
      var temp = $(this).attr('name');
      if (temp == 'font-xs') {
        $('body').removeClass().addClass('font-xs');
      } else if (temp == 'font-s') {
        $('body').removeClass().addClass('font-s');
      } else if (temp == 'font-m') {
        $('body').removeClass().addClass('font-m');
      } else if (temp == 'font-l') {
        $('body').removeClass().addClass('font-l');
      } else {
        $('body').removeClass().addClass('font-xl');
      }
    });

    $('img.tog').click(function(){
      var img = $(this).attr('src');
      if (img == 'media/icon/google/expand-arrow.svg') {
        $(this).attr('src', 'media/icon/google/expand-button.svg');
      } else {
        $(this).attr('src', 'media/icon/google/expand-arrow.svg');
      }
      $(this).parent().next().toggle();
    });
  });

var node = {
  id: null,
  forename: "",
  middle: "",
  surname: "",
  maiden: "",
  sex: null,
  born: {

  },
  bornCity: null,
  died: {

  },
  diedCity: null,
  fatherFather: null, //GET FROM FATHER
  fatherMother: null,
  father: null,
  motherFather: null, //GET FROM MOTHER
  motherMother: null,
  mother: null,
  siblings: {

  }, //GET FROM FATHER, THEN MOTHER
  children: {

  }
}
*/
