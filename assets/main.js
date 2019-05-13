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
		console.log(data["content"]);
		console.log(data["content"]["accountId"]);
		document.getElementById("accountNUM").innerHTML = document.getElementsByName("accountNUM")[0].value;
		document.getElementById("accountId").innerHTML = data.content.accountId;
		document.getElementById("dt_count").innerHTML = data.content.dt_count;
		document.getElementById("form").style.display = "none";
		document.getElementById("result").style.display = " ";
	})
}