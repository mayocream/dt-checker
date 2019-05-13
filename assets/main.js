function login() {
	let formData = new FormData();
	formData.append("accountNUM", document.getElementsByName("accountNUM")[0].value);
	formData.append("password", document.getElementsByName("password")[0].value);
	fetch("/core/app.php", {
		method: "POST",
		body: formData
	}).then((response) => {
		let data = response.json();
	})
}