

var setting={"plugin":"1,4,6","node":"70a1527626a1393,68bc1fd5938fc99","web_port":"80,8080,81,8081,8181,8088","cookie":"sdafaf","target":""}


$(function() {

  
  $('.selectpicker').selectpicker();
  $("#lable-setting").html(JSON.stringify(setting));
  //setTimeout(getOnlineNode,2000);
  

});
 




function  viewReport(){
	
	
}

function  log(str){

	$("#log").show();
	//$("#log").append(str);

}
function  loading(){

	$("#dbtable").hide(555);
	$("#retable").hide(200);
	//$("tbody").empty();
	$("#retable").show(555);


}





