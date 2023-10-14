const query = document.querySelector("#search");

query.addEventListener("keyup", function (e) {
    e.preventDefault();

    console.log(query.value);
});
