console.log("running");

if (document.getElementById("createPostModal")) {
		document.getElementById("createPostModal").addEventListener("click", function() {
			
			document.getElementById("createPostForm").click();
		});
}

if(document.querySelectorAll(".btnModal")) {
	for(let i=0; i < document.querySelectorAll(".btnModal").length; i++){
		document.querySelectorAll(".btnModal")[i].addEventListener("click", () => {
			let getValue = document.querySelectorAll(".btnModal")[i].nextElementSibling.value;
			console.log(getValue);

			document.getElementById("modalValue").value = getValue; 
		});
	}

	document.querySelector(".btnDeleteModal").addEventListener("click", () => {
		let getButton = document.getElementById("modalValue").value;
		console.log(getButton);
    	console.log(document.querySelector(`.${getButton}`));
		document.querySelector(`.${getButton}`).click();
	});
}