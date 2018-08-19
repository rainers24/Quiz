<div class="container">
    <h1>Hello <?= $user->name; ?></h1>
    <form id="user-form" method="POST" action="<?= "ajax/saveUserAction"; ?>">
        <label for="name">Vārds</label>
        <input type="text" id="name" name="name">
        <button type="submit">Save</button>
    </form>
</div>

<script type="text/javascript" charset="utf-8">
    (function () {
        let form = document.querySelector('#user-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            let formData = new FormData;
            let inputs = form.querySelectorAll('input');
            for (let i = 0; i < inputs.length; i++) {
                formData.append(inputs[i].name, inputs[i].value);
            }
            let xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.response);
                }
            };
            xhr.send(formData);
        });
    })();
</script>