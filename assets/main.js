function login() {
	swal("努力抓取中……", {
		button: false,
		icon: "info"
	});
	let formData = new FormData();
	formData.append("accountNUM", document.getElementsByName("accountNUM")[0].value);
	formData.append("password", document.getElementsByName("password")[0].value);
	fetch("/core/app.php", {
		method: "POST",
		body: formData
	}).then((response) => {
		return response.json()
	}).then((data) => {
		if (data.success == true) {
			swal.close();
			document.getElementById("accountNUM").innerHTML = document.getElementsByName("accountNUM")[0].value;
			document.getElementById("accountId").innerHTML = data.content.accountId;
			document.getElementById("dt_count").innerHTML = data.content.dt_count + 9;
			document.getElementById("form").style.display = "none";
			document.getElementById("result").style.display = "block";
		} else {
			swal("哪里出错了……", {
				icon: "error"
			});
		}
	})
}