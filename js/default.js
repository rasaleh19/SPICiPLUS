
	
// for popover

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});

// for tooltip

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// for back to top button
// Only enable if the document has a long scroll bar
// Note the window height + offset

if ( ($(window).height() + 100) < $(document).height() ) {
    $('#top-link-block').removeClass('hidden').affix({
        // how far to scroll down before link "slides" into view
        offset: {top:100}
    });
}

// for static menu

$('#nav').affix({
      offset: {
        top: $('header').height()
      }
}); 

//  for slider

$('.carousel').carousel({
  interval: 11000
})


// for upload form ----


  function showinputmethod(){
    var radio=document.getElementsByName("input_method");
  }

  function fileinput(){
    document.getElementById('show-data').style.display='block' ;
    document.getElementById('show-url').style.display='none' ;
    document.getElementById('show-text').style.display='none' ;
  }

  function urlinput(){
    document.getElementById('show-data').style.display='none' ;
    document.getElementById('show-url').style.display='block' ;
    document.getElementById('show-text').style.display='none' ;
  } 
  function textinput(){
    document.getElementById('show-data').style.display='none' ;
    document.getElementById('show-url').style.display='none' ;
    document.getElementById('show-text').style.display='block' ;
  } 

  function example1(){
    fetch('example1.txt')
    .then(function(response){
      return response.text();
    })
    .then(function(data){
      document.getElementById('input_text').value= data;  
    })
    
  }
  function example2(){
    fetch('example2.txt')
    .then(function(response){
      return response.text();
    })
    .then(function(data){
      document.getElementById('input_text').value= data;  
    })
    
  }
  function example3(){
    fetch('example3.txt')
    .then(function(response){
      return response.text();
    })
    .then(function(data){
      document.getElementById('input_text').value= data;  
    })
    
  }

// for upload history guest login check

function hideuploadhistory(){
  document.getElementById("upload-history").style.display = "none";
}
