function login() {
	let formData = new FormData();
	formData.append("accountNUM", document.getElementsByName("accountNUM")[0].value);
	formData.append("password", document.getElementsByName("password")[0].value);
	fetch("/core/app.php", {
		method: "POST",
		body: formData
	}).then((response) => {
		let data = response.json();
		console.log(data);
		document.getElementsById("accountNUM").innerHTML = document.getElementsByName("accountNUM")[0].value;
		document.getElementsById("accountId").innerHTML = data.content.accountId;
		document.getElementsById("dt_count").innerHTML = data.content.dt_count;
		document.getElementsById("form").style.display = "none";
		document.getElementsById("result").style.display = " ";
	})
}