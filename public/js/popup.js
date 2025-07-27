// popup div
function openpopup(id,h) {
  //Make the background div tag visible...

  var divobj = document.getElementById(id);
  var divbg = document.getElementById('popup-backgroung');  
  if(! divbg){
    var node = document.createElement("div");  
    node.setAttribute("id", "popup-backgroung");
    node.setAttribute("class", "popup_bg");
    divobj.parentNode.appendChild(node);
    divbg = node;
  }  
  if (typeof h != 'undefined') {
    $(divobj).css({
        height: h+'px'        
    });
  }
  if($(window).scrollTop()>250){
   $(divobj).css({
        top: $(window).scrollTop()-250+'px'        
    }); 
  }else{
    $(divobj).css({
        top: 0        
    }); 
  }
  divbg.style.visibility = "visible";   
  divobj.style.visibility = "visible";
  //Put a Close button for closing the popped up Div tag
  //if(divobj.innerHTML.indexOf("closepopup('" + id +"')") < 0 )
  //divobj.innerHTML = "<a href=\"#\" onclick=\"closepopup('" + id +"')\"><span class=\"close_button\">X</span></a>" + divobj.innerHTML;
  //"<a id=\"popup-closebtn\" href=\"#\")><span class=\"close_button\">X</span></a>"

  var closeBtn = document.getElementById('popup-closebtn');
  if(! closeBtn){
    var closeBtnLink = document.createElement("div");
    var closeBtnSpan = document.createElement("span");
    closeBtnLink.setAttribute("id", "popup-closebtn");
    closeBtnLink.setAttribute("onclick", "closepopup('" + id +"');");
    closeBtnSpan.setAttribute("class", "close_button");
    closeBtnSpan.innerHTML = "X";
    closeBtnLink.appendChild(closeBtnSpan);
    divobj.appendChild(closeBtnLink);    
  }
}

  function closepopup(id){
    var divbg = document.getElementById('popup-backgroung');
    divbg.style.visibility = "hidden";
    var divobj = document.getElementById(id);
    divobj.style.visibility = "hidden";
  }

/*
$(document).ready(function(){
  alert(1);
  $("#popup-closebtn").click(function(){
    alert(1);
    var divbg = document.getElementById('popup-backgroung');
    divbg.style.visibility = "hidden";
    var divobj = jQuery(this).parent();
    divobj.style.visibility = "hidden";   
  });

});
*/