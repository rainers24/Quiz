<?php


?>

<div class="container">
    <h1>Hello</h1>
    <h2>This is quiz</h2>

    <form id="user-form" method="POST" action="ajax/saveUser">

        <label><input type="text" name="fname"></label><br>
        <button type="submit" form="user-form" value="Submit">Go to Ajax Method</button>


    </form>


</div>

<script type="text/javascript" charset="utf-8">
    (function () {
        let form = document.querySelector('user-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            let formData = new FormData;
            formData.append('name', 'Rainers');
            let xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {

                }

            };
            xhr.send(formData);
        });

    })();
</script>
