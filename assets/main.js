// function login() {
// 	swal("努力抓取中……", {
// 		button: false,
// 		icon: "info"
// 	});
// 	let formData = new FormData();
// 	formData.append("accountNUM", document.getElementsByName("accountNUM")[0].value);
// 	formData.append("password", document.getElementsByName("password")[0].value);
// 	fetch("/core/app.php", {
// 		method: "POST",
// 		body: formData
// 	}).then((response) => {
// 		try {
// 			return response.json()
// 		} catch (err) {
// 			swal("哪里出错了……", {
// 				icon: "error"
// 			});
// 		}
		
// 	}).then((data) => {
// 		if (data.success == true) {
// 			swal.close();
// 			document.getElementById("accountNUM").innerHTML = document.getElementsByName("accountNUM")[0].value;
// 			document.getElementById("accountId").innerHTML = data.content.accountId;
// 			document.getElementById("dt_count").innerHTML = data.content.dt_count + 9;
// 			document.getElementById("form").style.display = "none";
// 			document.getElementById("result").style.display = "block";
// 		} else {
// 			swal("哪里出错了……", {
// 				icon: "error"
// 			});
// 		}
// 	})
// }


function query() {
	return false;
	
}

$(function(){

	$("#submit").click(function(){

		swal("努力抓取中……", {
	 		button: false,
	 		icon: "info"
		});

		$.ajax({
			type: "POST",
			url: "https://cxxy-app.smartgslb.com/core/app.php",
			data: {
				accountNUM: $("input[name='accountNUM']").val(),
				password: $("input[name='password']").val()
			},
			dataType: "json",
			success: function(data) {
				swal.close();
				console.log(data);
			},
			error: function(jqXHR) {
 				switch(jqXHR.status)
 				{
 				case 403:
 					msg = "账号密码好像哪里不对哦……？";
 					break;
 				case 500:
 					msg = "教务系统的服务器好像爆炸了……？";
 					break;
 				default:
 					msg = "我也不知道哪里出错了呢……";
 				}
 				swal(msg, {
 					icon: "error"
 				});
			}
		});


	});




});
