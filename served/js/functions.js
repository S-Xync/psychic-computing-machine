function submit_btn_submit( year, country, manufacturer, processor_generation, architecture, segment, interconnect_family, accelerator, operating_system_family, rank_from, rank_to ){
  if(rank_from.length==0 || rank_to.length==0){
    alert("Fields need to be filled!");
  }else{
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("result_table").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","results_table.php?year=" + year + "&country=" + country + "&manufacturer=" + manufacturer + "&processor_generation=" + processor_generation + "&architecture=" + architecture + "&segment=" + segment + "&interconnect_family=" + interconnect_family + "&accelerator=" + accelerator + "&operating_system_family=" + operating_system_family + "&rank_from=" + rank_from + "&rank_to=" + rank_to, true);
    xmlhttp.send();
  }
  return false;//doesn't let page to refresh
}

function reset_btn_submit(user_form){
  user_form.reset();
  return false;
}
function rank_wise(rank){
  return false;
}
function site_wise(site){
  return false;
}
function country_wise(country){
  return false;
}
function computer_wise(computer){
  return false;
}
function manufacturer_wise(manufacturer){
  return false;
}
