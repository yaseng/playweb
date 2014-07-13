var isScanning=0;
$(function() {

    $('input[name=radio-targets]').on('ifChecked',
    function(event) {

});

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green',
        increaseArea: '20%'
    });

    $('input[name="node[1]"],input[name="moudle[port]"],input[name="moudle[crawler]"],input[name="moudle[sqli]"],input[name="moudle[xss]"],input[name="moudle[lfi]"],input[name="moudle[ftp-brute]"]').iCheck('check');

    $.fn.wizard.logging = true;
    var wizard = $("#project-wizard").wizard();
    $("#btn-scanner").click(function() {
        wizard.reset();
        wizard.show();
    });

    wizard.on("submit",
    function(wizard) {

        data = wizard.serialize();
        $('input[name=wd]').attr("value", $('input[name=target]').val());
        $('input[name=wd]').attr("disabled", 'disabled');
        isScanning = 1;
 
       $("#container-onfo").hide();
        $("#container-result").slideDown(555);

        $.post("http://w/uauc/playweb/index.php?m=project&a=test", data,
        function(d) {

            //	console.log(d);
            var str1 = '<tr><td>1</td><td>' + d.target + '</td><td>100%</td><td><a href="?m=report&a=view&id=' + d.id + '" target="_blank" ><button type="button" class="btn btn-small btn-success"   ><i class=" icon-zoom-in"></i>报告</button></a> <button type="button" class="btn btn-small btn-danger"  onclick=setting()><i class=" icon-stop"></i>停止</button></td><tr>';
            $("#project-list").append(str1);

        });

        wizard.reset().close();
        $("#loader").show();

    });
    setTimeout(getOnlineNode, 2000);

});

function hacking() {

    var wd = $('input[name=wd]').val();
    $('input[name=wd]').attr("disabled", 'disabled');
    // var type=$('select[name=type]').val();
    $("#loader").show();

    return false;

    if (wd) {

        isScanning = 1;
        setting.target = wd;
        $("#container-onfo").hide();
        $("#container-result").slideDown(555);

        $.post("?m=project&a=on_add", setting,
        function(d) {

            var str1 = '<tr><td>1</td><td>' + d.target + '</td><td>100%</td><td><a href="?m=report&a=view&id=' + d.id + '" target="_blank" ><button type="button" class="btn btn-small btn-success"   ><i class=" icon-zoom-in"></i>报告</button></a> <button type="button" class="btn btn-small btn-danger"  onclick=setting()><i class=" icon-stop"></i>停止</button></td><tr>';
            $("#project-list").append(str1);

        });

    }

    return false;

}

function getOnlineNode() {

    if (isScanning == 0) {

        setTimeout(getOnlineNode, 2000);
        $.get("?m=node&a=listing",
        function(nodes) {

            node_list_html = "";
            node_icon = ""
            for (i in nodes) {

                if (nodes[i].os == "Windows") {

                    node_icon = '<img src="static/img/windows.png"  width="2%" height="2%" > ';

                } else if (nodes[i].os == "Linux") {

                    node_icon = '<img src="static/img/linux.png"  width="2%" height="2%" > ';
                }
                node_list_html += node_icon + "<b>" + nodes[i].ip + "</b>   ";

            }

            $("#node_list").html(node_list_html);

        });

    }

}

function  check_target(el){
	
	var val = el.val();
	ret = {status: true};
	if(val==""){
		ret.status = false;
		ret.msg = "错误的ip或url";
	}

	return  ret;
	
}








