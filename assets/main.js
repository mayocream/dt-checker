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


function fforeach(object, callback) {
	// if (object.constructor === Array) {
	// 	object.forEach(v=>{
	// 		callback(v);
	// 	});
	// } else {
		for (let index in object) {
			callback(index);
		}
	// }
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
				// 处理数据
				// 每学期

				// fforeach(data.content.period, function(school_yaer) {
				// 	fforeach(school_yaer, function(school_period) {
				// 		period_count = school_period.length;
				// 		// html
				// 		html = '<tr><td>'+school_yaer+' 第 '+school_period+' 学期</td><td>'+period_count+'</td></tr>';
				// 		$("#result-period").append(html);
				// 	})
				// });

				for (let index in data.content.period) {
					for (let index2 in data.content.period[index]) {
						console.log(index2);
						console.log(data.content.period[index][index2]);
						//console.log(Object.keys(data.content.period[index][index2])[0]);
					
					 // console.log(index);
					 // console.log(data.content.period[index]);
					 // console.log(Object.keys(data.content.period[index])[0]);
						school_yaer = index;
						school_period = index2;
						period_count = data.content.period[index][index2].length;
					 	// html
					 	html = '<tr><td>'+school_yaer+' 第 '+school_period+' 学期</td><td>'+period_count+'</td></tr>';
					 	$("#result-period").append(html);
					}
				}



				// data.content.period.forEach(school_yaer=>{
				// 	school_yaer.forEach(school_period=>{
				// 		period_count = school_period.length;
				// 		// html
				// 		html = '<tr><td>'+school_yaer+' 第 '+school_period+' 学期</td><td>'+period_count+'</td></tr>';
				// 		$("#result-period").append(html);
				// 	});
				// });
				$("#result-period").append('<tr><td>故障补偿</td><td>11</td></tr>');
				// 总共
				$("#result-countAll").append(data.content.dt_count+11);
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
